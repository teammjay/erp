<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;

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


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::post('sign-out', [SessionsController::class, 'destroy'])->name('logout');

	Route::get('profile', [ProfileController::class, 'create'])->name('profile');
	Route::resource('user-management', UserController::class)
		->missing(function (Request $request) {
			return Redirect::route('user-management.index');
		});
	Route::resource('product', ProductController::class)
		->missing(function (Request $request) {
			return Redirect::route('product.index');
		});
	Route::post('user-profile', [ProfileController::class, 'update']);
	Route::get('user-profile', function () {
		return view('pages.users.user-profile');
	})->name('user-profile');
});

Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('/categories/list',[CategoryController::class,'index'])->name('categories.index');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

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



Route::get('categories/{categoryId}/subcategories', 'ProductController@getSubcategories');
Route::get('categories/{categoryId}/brands', 'ProductController@getBrands');
