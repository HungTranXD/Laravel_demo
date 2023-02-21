<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [WebController::class, "home"]);
Route::get('/about-us', [WebController::class, "aboutUs"]);

//--PRODUCT--
Route::get('admin/product', [ProductController::class, "list"]);
Route::get('admin/product/create', [ProductController::class, "create"]);
Route::post('admin/product/create', [ProductController::class, "store"]);
//Route::get('admin/product/edit/{id}', [ProductController::class, "edit"])->name("product_edit"); //{id} la static parameter, ?id= la tham so dong
Route::get('admin/product/edit/{product}', [ProductController::class, "edit"])->name("product_edit"); //{id} la static parameter, ?id= la tham so dong
//Route::post('admin/product/edit/{product}', [ProductController::class, "update"]);
Route::put('admin/product/edit/{product}', [ProductController::class, "update"]); //put ve ban chat html van la post nhung lam API thi hay dung put
Route::delete('admin/product/delete/{product}', [ProductController::class, "delete"])->name("product_delete");

//--CATEGORY--
Route::get('admin/category', [CategoryController::class, "list"]);
Route::get('admin/category/create', [CategoryController::class, "create"]);
Route::post('admin/category/create', [CategoryController::class, "store"]);
Route::get('admin/category/edit/{category}', [CategoryController::class, "edit"]);
Route::put('admin/category/edit/{category}', [CategoryController::class, "update"]);
Route::delete('admin/category/delete/{category}', [CategoryController::class, "delete"]);

//--ORDER--
Route::get('admin/order', [OrderController::class, "list"]);
Route::get('admin/order/detail/{order}', [OrderController::class, "detail"]);
Route::put('admin/order/detail/{order}', [OrderController::class, "updateStatus"]);
