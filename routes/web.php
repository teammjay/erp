<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('/categories/list',[CategoryController::class,'index'])->name('categories.index');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

// Route::get('/getSlug', function (Request $request) {
//     $slug = '';
//     if (!empty($request->title)) {
//         $slug = Str::slug($request->title);
//     }
//     return response()->json( [
//         'status' => true,
//         'slug' => $slug
//     ]);
// })->name('getSlug');
Route::get('/subcategories/create',[SubCategoryController::class,'create'])->name('subcategories.create');
Route::post('/subcategories/store',[SubCategoryController::class,'store'])->name('subcategories.store');
Route::get('/subcategories/list',[SubCategoryController::class,'index'])->name('subcategories.index');
Route::get('/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
Route::post('/subcategories/{subcategory}/update', [SubCategoryController::class, 'update'])->name('subcategories.update');
Route::get('/subcategories/{subcategory}/delete', [SubCategoryController::class, 'destroy'])->name('subcategories.delete');

Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
Route::post('/brands/store',[BrandController::class,'store'])->name('brands.store');
Route::get('/brands/list',[BrandController::class,'index'])->name('brands.index');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::post('/brands/{brand}/update', [BrandController::class, 'update'])->name('brands.update');
Route::get('/brands/{brand}/delete', [BrandController::class, 'destroy'])->name('brands.delete');

Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products/store',[ProductController::class,'store'])->name('products.store');
Route::get('/products/list',[ProductController::class,'index'])->name('products.index');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');