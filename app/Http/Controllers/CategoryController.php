<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    protected function fixImage(Category $category)
    {
        if (Storage::disk('public')->exists($category->image)) {
            $category->image = Storage::url($category->image);
        } else {
            $category->image = '/images/no_image_placehoder.png';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? "";
        if (!empty($search))
            $lstCategory = Category::where('name', 'LIKE', "%$search%")->paginate(3);
        else
            $lstCategory = Category::paginate(3);
        $lstCategory->appends($request->all());
        foreach ($lstCategory as $c) {
            $this->fixImage($c);
        }
        return view('Categories.index', ['category' => $lstCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories,name', 'max:255'],
            'image' => ['required', 'mimetypes:image/jpg,image/png']
        ]);
        $category = new Category;
        $category->fill([
            'name' => $request->input('name'),
            'image' => ''
        ]);
        $category->save();
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('images/categories/' . $category->id, 'public');
        }
        $category->save();
        return Redirect::route('categories.index')->with('add', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $lstSub = SubCategory::where('category_id', $category->id)->get();
        return view('categories.show', ['category' => $category, 'sub_category' => $lstSub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->fixImage($category);
        return view('Categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'image' => ['mimetypes:image/jpg,image/png']
        ]);
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('images/categories/' . $category->id, 'public');
        }
        $category->fill([
            'name' => $request->input('name')
        ]);
        $category->save();
        return Redirect::route('categories.edit', ['category' => $category])->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('categories.index')->with('deleted', 'ok');
    }
    public function trash()
    {
        $lstCategory = Category::onlyTrashed()->paginate(3);
        foreach ($lstCategory as $c)
            $this->fixImage($c);
        return view('Categories.trash', ['category' => $lstCategory]);
    }


    public function restore($id)
    {
        $category = Category::withTrashed()->where('id', $id)->first();
        $category->restore();
        return Redirect::route('categories.trash')->with('restored','ok');
    }
}
