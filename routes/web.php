<?php

use App\Http\Controllers\CustomerController as ControllersCustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Locations;
use App\Models\Firms;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CustomerController::class, 'getStarted'])->name('customer.signup');
Route::post('/signup', [CustomerController::class, 'signUp']);
//Route::get('/welcome', [CustomerController::class, 'index']);
Route::post('/proceed1/{customer_id}', [CustomerController::class, 'proceed1']);
//Route::get('/banking', [CustomerController::class, 'aboutbus']);
Route::post('/proceed2/{customer_id}', [CustomerController::class, 'proceed2']);
//Route::get('/laststep', [CustomerController::class, 'laststep']);
Route::post('/finalstep/{customer_id}', [CustomerController::class, 'finalstep']);

Route::get('/login', [CustomerController::class, 'logIn']);


//Route::get('get-all-session', function(){
//   $session = session()->all();
//       echo"<pre>";
//       print_r($session);   
//       echo"</pre>";

//});

//Route::get('set-session', function(request $request){
// $request->session()->put('','');
// $request->session()->put('');
// return redirect('get-all-session');
//});

Route::get('/customer', function(){
    $customers = Customers::all();
    echo "<pre>";
    print_r($customers->toArray());
});

