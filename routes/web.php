<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductImageController;
//use App\Http\Controllers\HomeUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('accounts/trash', [AccountController::class, 'trash'])->name('accounts.trash');
    Route::get('accounts/restore/{id}', [AccountController::class, 'restore'])->name('accounts.restore');
    Route::resource('accounts', AccountController::class);

    Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::resource('products', ProductController::class);

    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::resource('categories', CategoryController::class);

    Route::get('sub_categories/trash/{id}', [SubCategoryController::class, 'trash'])->name('sub_categories.trash');
    Route::get('sub_categories/restore/{id}', [SubCategoryController::class, 'restore'])->name('sub_categories.restore');
    Route::resource('sub_categories', SubCategoryController::class);

    Route::get('product_images/trash', [ProductImageController::class, 'trash'])->name('product_images.trash');
    Route::get('product_images/restore/{id}', [ProductImageController::class, 'restore'])->name('product_images.restore');
    Route::resource('product_images', ProductImageController::class);

    Route::get('shippings/trash', [ShippingController::class, 'trash'])->name('shippings.trash');
    Route::get('shippings/restore/{id}', [ShippingController::class, 'restore'])->name('shippings.restore');
    Route::resource('shippings', ShippingController::class);

    Route::get('invoices/processing', [InvoiceController::class, 'processing'])->name('invoices.processing');
    Route::get('invoices/being_transported', [InvoiceController::class, 'being_transported'])->name('invoices.being_transported');
    Route::get('invoices/completed', [InvoiceController::class, 'completed'])->name('invoices.completed');
    Route::get('invoices/cancelled', [InvoiceController::class, 'cancelled'])->name('invoices.cancelled');
    Route::get('invoices/confirm/{id}', [InvoiceController::class, 'confirm'])->name('invoices.confirm');
    Route::get('invoices/complete/{id}', [InvoiceController::class, 'complete'])->name('invoices.complete');
    Route::resource('invoices', InvoiceController::class);

    Route::get('reviews/trash', [ReviewController::class, 'trash'])->name('reviews.trash');
    Route::get('reviews/restore/{id}', [ReviewController::class, 'restore'])->name('reviews.restore');
    Route::resource('reviews', ReviewController::class);
});
Route::get('login', [LoginController::class, 'showForm'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//Route::get('/', [HomeUserController::class, 'index']);

