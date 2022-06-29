<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ApiCategoryController extends Controller
{
    public function getCategories()
    {
        $lstCtg = Category::get(['id', 'name', 'image']);
        foreach ($lstCtg as $item) {
            $result[] = Arr::add($item, 'sub', SubCategory::where('category_id', $item->id)->get(['id', 'name']));
        }
        return response()->json($result, 200);
    }

    public function getSubCategories($id)
    {
        $lstSubCtg = SubCategory::where('category_id', $id)->get(['id', 'name']);
        if (empty($lstSubCtg)) {
            return json_encode([
                'success' => false,
                'message'  =>  "không tìm thấy"
            ]);
        } else {
            return json_encode([
                'success' => true,
                'data'  =>  $lstSubCtg,
            ]);
        };
    }
}
