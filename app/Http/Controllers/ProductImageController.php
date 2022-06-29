<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductImageController extends Controller
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
    public function index()
    {

        $lstImg = ProductImage::paginate(5);
        foreach ($lstImg as $img) {
            $this->fixImage($img);
        }
        return view('ProductImages.index', ['images' => $lstImg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstProduct = Product::all();
        return view('ProductImages.create', ['product' => $lstProduct]);
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
            'product_id' => ['required'],
            'image' => ['required']
        ]);
        $imgPrd = new ProductImage;
        $imgPrd->fill([
            'product_id' => $request->input('product_id'),
            'path' => ''
        ]);
        $imgPrd->save();
        if ($request->hasFile('image')) {
            $imgPrd->path = $request->file('image')->store('images/products/' .  $imgPrd->id, 'public');
        }
        $imgPrd->save();
        return Redirect::route('product_images.index')->with('add', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        $lstProduct = Product::all();
        $this->fixImage($productImage);
        return view('ProductImages.edit', ['product' => $lstProduct, 'images' => $productImage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //dd($request->file('image'));
        // $validated = $request->validate([
        //     'image' => ['mimetypes:image/jpg,image/png']
        // ]);
        if ($request->hasFile('image')) {
            $productImage->path = $request->file('image')->store('images/products/' . $productImage->id, 'public');
        }
        $productImage->save();
        return Redirect::route('product_images.index')->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        $productImage->delete();
        return Redirect::route('product_images.index')->with('deleted', 'ok');
    }

    public function trash()
    {
        $lstImg = ProductImage::onlyTrashed()->paginate(5);
        foreach ($lstImg as $img) {
            $this->fixImage($img);
        }
        return view('ProductImages.trash', ['images' => $lstImg]);
    }


    public function restore($id)
    {
        $lstImg = ProductImage::withTrashed()->where('id', $id)->first();
        $lstImg->restore();
        return Redirect::route('product_images.trash')->with('restored', 'ok');
    }
}
