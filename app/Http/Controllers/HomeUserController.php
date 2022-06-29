<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{
    public function index()
    {
        $acc = Account::all()->count();
        $prd = Product::all()->count();
        return view('index', ['account' => $acc, 'product' => $prd]);
    }
}
