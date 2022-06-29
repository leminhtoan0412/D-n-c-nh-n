<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected function fixImage(ProductImage $productImage)
    {
        if (Storage::disk('public')->exists($productImage->path)) {
            $productImage->path = Storage::url($productImage->path);
        } else {
            $productImage->path = '/storage/images/no_image_placehoder.png';
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
            $lstproduct = Product::where('name', 'LIKE', "%$search%")->orWhere('code', 'LIKE', "%$search%")->paginate(5);
        else
            $lstproduct = Product::paginate(5);
        $lstproduct->appends($request->all());
        return view('Products.index', ['product' => $lstproduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstCategory = Category::all();
        $lstSubCategory = SubCategory::all();
        return  view('Products.create', ['category' => $lstCategory, 'sub_category' => $lstSubCategory]);
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
            'name' => ['required', 'unique:products,name', 'max:255'],
            'code' => ['required', 'unique:products,code', 'max:8'],
            'description' => ['required'],
            'category_id' => ['required',],
            'price' => ['required', 'numeric', 'integer', 'min:0'],
            'quantity' => ['required', 'numeric', 'integer', 'min:0'],
            'cpu' => ['required', 'max:255'],
            'ram' => ['required', 'max:255'],
            'storage' => ['required', 'max:255'],
            'vga' => ['required', 'max:255'],
            'screen' => ['required', 'max:255'],
            'battery' => ['required', 'max:255'],
            'os' => ['required', 'max:255'],
        ]);
        $prd = new Product;
        $prd->fill([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'cpu' => $request->input('cpu'),
            'ram' => $request->input('ram'),
            'storage' => $request->input('storage'),
            'vga' => $request->input('vga'),
            'screen' => $request->input('screen'),
            'battery' => $request->input('battery'),
            'operating_system' => $request->input('os'),
        ]);
        $prd->save();
        return Redirect::route('products.show', ['product' => $prd])->with('add', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        foreach ($product->images as $img) {
            $this->fixImage($img);
        }

        return view('Products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        // $this->fixImage($product);
        $lstCategory = Category::all();
        $lstSubCategory = SubCategory::all();
        return view('Products.edit', ['product' => $product, 'category' => $lstCategory, 'sub_category' => $lstSubCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\tRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'price' => ['required', 'numeric', 'integer', 'min:0'],
            'quantity' => ['required', 'numeric', 'integer', 'min:0'],
            'cpu' => ['required', 'max:255'],
            'ram' => ['required', 'max:255'],
            'storage' => ['required', 'max:255'],
            'vga' => ['required', 'max:255'],
            'screen' => ['required', 'max:255'],
            'battery' => ['required', 'max:255'],
            'os' => ['required', 'max:255'],
        ]);
        $product->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'cpu' => $request->input('cpu'),
            'ram' => $request->input('ram'),
            'storage' => $request->input('storage'),
            'vga' => $request->input('vga'),
            'screen' => $request->input('screen'),
            'battery' => $request->input('battery'),
            'operating_system' => $request->input('os'),
        ]);
        $product->save();
        return Redirect::route('products.show', ['product' => $product])->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('products.index')->with('deleted', 'ok');
    }
    public function trash()
    {
        $lstproduct = Product::onlyTrashed()->paginate(5);
        // foreach ($lstproduct as $prd) {
        //     $this->fixImage($prd);
        // }
        return view('Products.trash', ['product' => $lstproduct]);
    }
    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();
        return Redirect::route('products.trash')->with('restored', 'ok');
    }
}
