<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

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


use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Locations;
use App\Models\Firms;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CustomerController::class, 'getStarted'])->middleware('guest')->name('customer.signup');
Route::post('/signup', [CustomerController::class, 'signUp'])->middleware('guest');
//Route::get('/welcome', [CustomerController::class, 'index']);
Route::put('/proceed1/{customer_id}', [CustomerController::class, 'proceed1'])->middleware('guest');
//Route::get('/banking', [CustomerController::class, 'aboutbus']);
Route::put('/proceed2/{customer_id}', [CustomerController::class, 'proceed2'])->middleware('guest');
//Route::get('/laststep', [CustomerController::class, 'laststep']);
Route::put('/finalstep/{customer_id}', [CustomerController::class, 'finalstep'])->middleware('guest');

Route::get('/goback1/{customer_id}', [CustomerController::class, 'goback1']);
Route::get('/goback2/{customer_id}', [CustomerController::class, 'goback2']);
Route::get('/goback3/{customer_id}', [CustomerController::class, 'goback3']);



Route::get('/login', [CustomerController::class, 'logIn']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');                   //->middleware('auth')
Route::get('sign-in', [SessionsController::class, 'create'])->name('login');                          //->middleware('guest')
Route::post('sign-in', [SessionsController::class, 'store']);                                         //->middleware('guest')
Route::post('verify', [SessionsController::class, 'show']);                                           //->middleware('guest')
Route::post('reset-password', [SessionsController::class, 'update'])->name('password.update');        //->middleware('guest')
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

	Route::get('profile', [CustomerController::class, 'create'])->name('profile');
	Route::resource('user-management', CustomerController::class)
		->missing(function (Request $request) {
			return Redirect::route('user-management.index');
		});
	
	Route::post('user-profile', [CustomerController::class, 'update']);
	Route::get('user-profile', function () {
		return view('pages.users.user-profile');
	})->name('user-profile');
});

Route::resource('product', ProductController::class)
		->missing(function (Request $request) {
			return Redirect::route('product.index');
		});