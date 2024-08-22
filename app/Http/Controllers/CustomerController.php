<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Locations;
use App\Models\Bankings;
use App\Models\Firms;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function getStarted(){
        return view('register.getStarted');
    }

    public function logIn(){
        return view('pages.users.login');
    }



    public function signUp(Request $request){

        $request->validate(
            [
                'name' => 'required',
                'email'=> 'required|email',
                'password'=> 'required|confirmed',
                'password_confirmation'=> 'required' //same:password for a different name.
                 
              ]
        );
                
        $customer = new Customers;
        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->phone = $request['phone'];
        $customer->password = md5($request['password']);
        $customer->save();

        $customer_id = $customer->customer_id;

        return view('pages.users.form',['customer_id' => $customer_id]);

    }

    public function index(){
        return view('pages.users.form');
    }

    public function goback1(Request $request, $id){

        $customer = Customers::findorFail($id);
        return view('register.getStarted', ['custom' => $customer]);

    }


    public function proceed1(Request $request, $id){
       
        $customer = Customers::findOrFail($id);

        $location = new Locations();
        $location->customer_id = $customer->customer_id;
        $location->bus_address = $request['bus_address'];
        $location->country = $request['country'];
        $location->state = $request['state'];
        $location->city = $request['city'];
        $location->zipcode = $request['zipcode'];
        $location->save();


        $customer_id = $customer->customer_id;

        return view('pages.users.banking',['customer_id' => $customer_id]);
        
    }

   
    public function aboutbus(){
        return view('pages.users.banking');
    }


    public function goback2(Request $request, $id){

        $customer = Customers::findorFail($id);
        return view('pages.users.form', ['custom' => $customer,'customer_id' => $customer->id]);

    }


    public function proceed2(Request $request, $id){
        
        $customer = Customers::findorFail($id);

        $banking = new Bankings();
        $banking->customer_id = $customer->customer_id;
        $banking->gstin = $request['gstin'];
        $banking->pan = $request['pan'];
        $banking->bank = $request['bank'];
        $banking->account = $request['account'];
        $banking->save();

        $customer_id = $customer->customer_id;

        return view('pages.users.firm',["customer_id" => $customer_id]);
    }

    public function laststep(){
        return view('pages.users.firm');
    }


    public function goback3(Request $request, $id){

        $customer = Customers::findorFail($id);
        return view('pages.users.banking', ['custom' => $customer, 'customer_id' => $customer->id]);
       
    }


    public function finalstep(Request $request, $id){

        $customer = Customers::findorFail($id);

        $firm = new Firms();
        $firm->customer_id = $customer->customer_id;
        $firm->business = $request['business'];
        $firm->pws = isset($request['pws']) ? 1 : 0;
        $firm->inperson = isset($request['inperson']) ? 1: 0;
        $firm->social = isset($request['social']) ? 1 : 0;
        $firm->onlinemarket = isset($request['onlinemarket']) ? 1: 0;
        $firm->status = $request['status'];
        $firm->primary = $request['primary'];
        $firm->secondary= $request['secondary'];
        $firm->region = $request['region'];

        $firm->save();

        $customer_id = $customer->customer_id;
        $customer_name = $customer->name;
        return view('pages.users.dashboard',["customer_id" => $customer_id], ["customer_name"=>$customer_name]);

 }


}
