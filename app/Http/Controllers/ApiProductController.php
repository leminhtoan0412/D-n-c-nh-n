<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ApiProductController extends Controller
{
    public function getProducts()
    {

        $lstPrd = Product::all();
        foreach ($lstPrd as $item) {
            $resulst[] =  Arr::add($item, "img", ProductImage::where('product_id', $item->id)->get('path'));
        }
        return response()->json($resulst, 200);
    }
    public function getProductByCategory($id)
    {
        $lstPrd = Product::where('category_id', $id)->get();
        foreach ($lstPrd as $item) {
            $resulst[] =  Arr::add($item, "img", ProductImage::where('product_id', $item->id)->get('path'));
        }
        return response()->json($resulst, 200);
    }

    public function getProductBySubCategory($id)
    {
        $lstPrd = Product::where('sub_category_id', $id)->get();
        foreach ($lstPrd as $item) {
            $resulst[] =  Arr::add($item, "img", ProductImage::where('product_id', $item->id)->get('path'));
        }
        return response()->json($resulst, 200);
    }

    public function getNewProduct()
    {
        $lstPrd = Product::orderBy('created_at', 'desc')->take(6)->get();
        foreach ($lstPrd as $item) {
            $resulst[] =  Arr::add($item, "img", ProductImage::where('product_id', $item->id)->get('path'));
        }
        return response()->json($resulst, 200);
    }

    public function getFeaturedProduct()
    {
        $lstPrd = Product::where('featured', 1)->take(6)->get();
        foreach ($lstPrd as $item) {
            $resulst[] =  Arr::add($item, "img", ProductImage::where('product_id', $item->id)->get('path'));
        }
        return response()->json($resulst, 200);
    }


    public function getDetailProduct($id)
    {
        $prd = Product::where('id', $id)->first();
        $img = ProductImage::where('product_id', $prd->id)->first('path');
        $resulst[] =  Arr::add($prd, "img", $img);
        return response()->json($resulst, 200);
    }

    public function rvProduct(Request $request)
    {
        $rv = new Review();
        $rv->fill([
            'account_id' => $request['account_id'],
            'product_id' => $request['product_id'],
            'vote' => $request['vote'],
            'comments' => $request['comments']
        ]);
        $rv->save();

        $inv = Invoice::find($request['id']);
        $inv->fill([
            'status' => 4
        ]);
        $inv->save();
        return response()->json(["Sucssess" => True], 200);
    }
}
