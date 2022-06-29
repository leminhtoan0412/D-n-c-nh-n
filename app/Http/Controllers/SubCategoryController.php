<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categories.SubCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:sub_categories,name', 'max:255'],
        ]);
        $subCategory = new SubCategory;
        $category = $request->input('category_id');
        $subCategory->fill([
            'name' => $request->input('name'),
            'category_id' => $category
        ]);
        $subCategory->save();
        return Redirect::route('categories.show', ['category' => $category])->with('add', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $category = Category::where('id', $subCategory->category_id)->first();
        return view('Categories.SubCategories.edit', ['sub_category' => $subCategory, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
        ]);
        $subCategory->fill([
            'name' => $request->input('name'),
        ]);
        $subCategory->save();
        return Redirect::route('sub_categories.edit', ['sub_category' => $subCategory])->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        $category = Category::where('id', $subCategory->category_id)->first();
        return Redirect::route('categories.show', ['category' => $category])->with('deleted', 'ok');
    }

    public function trash($id)
    {
        $lstSubCategory = SubCategory::onlyTrashed()->where('category_id', $id)->get();
        $category = Category::where('id', $id)->first();
        return view('Categories.SubCategories.trash', ['sub_category' => $lstSubCategory, 'category' => $category]);
    }


    public function restore($id)
    {
        $sub_category = SubCategory::withTrashed()->where('id', $id)->first();
        $sub_category->restore();
        $category = Category::where('id', $sub_category->category_id)->first();
        return Redirect::route('sub_categories.trash', ['id' => $category->id])->with('restored', 'ok');
    }
}
