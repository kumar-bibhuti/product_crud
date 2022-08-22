<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/','login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//products 
Route::get("/products",[ProductsController::class,'index'])->name('products.index');
Route::get("products/create",[ProductsController::class,'create'])->name('products.create');
Route::post("products/store",[ProductsController::class,'store'])->name('products.store');
Route::get("products/edit/{products}",[ProductsController::class,'edit'])->name('products.edit');
Route::put("products/update/{products}",[ProductsController::class,'update'])->name('products.update');
Route::delete("products/delete/{products}",[ProductsController::class,'destroy'])->name('products.delete');
Route::post("deleteallProducts",[ProductsController::class,'deleteAll'])->name('deleteallProducts');
