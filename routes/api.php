<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShippingController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ApiProductController::class, 'getProducts']);

Route::get('products/get-new-product', [ApiProductController::class, 'getNewProduct']);
Route::get('products/get-featured-product', [ApiProductController::class, 'getFeaturedProduct']);
Route::get('products/{id}', [ApiProductController::class, 'getDetailProduct']);

Route::get('products/get-by-category/{id}', [ApiProductController::class, 'getProductByCategory']);
Route::get('products/get-by-sub-category/{id}', [ApiProductController::class, 'getProductBySubCategory']);
Route::get('products/get-review-product/{id}', [ApiProductController::class, 'getReviewProduct']);

Route::get('categories', [ApiCategoryController::class, 'getCategories']);
Route::get('invoices/cancel/{id}', [InvoiceController::class, 'isCancel']);
Route::get('invoices/{id}/{status}', [InvoiceController::class, 'getInvoice']);

Route::get('invoices/get-invoice-detail/{id}', [InvoiceController::class, 'getInvoiceDetail']);

Route::post('invoices/createInv', [InvoiceController::class, 'createInv']);


Route::get('shipping', [ShippingController::class, 'getShippings']);

Route::post('review', [ApiProductController::class, 'rvProduct']);
Route::get('review/{id}', [ReviewController::class, 'getReview']);

Route::post('login', [AccountController::class, 'apiLogin']);
Route::get('user/{id}', [AccountController::class, 'getAccount']);

Route::post('user/edit', [AccountController::class, 'edituser']);
Route::post('signin', [AccountController::class, 'signin']);