<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{

    public  function index() {
         $brands = Brand::latest('id');
         $brands = $brands->paginate(10);

        return view('admin.brands.list',compact('brands'));

    }
    public function create(){
         $title="Create Brand";
        $button="Create";
        $create = true;
        $url=url('/brands/create');
        $data=compact('title','button','create');
        
        return view('admin.brands.create',compact('url'))->with($data);
    }

    public  function store(Request $request) {
       $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
            'status' => 'required|in:active,inactive',
       ]);

            $brand = new Brand();
            $brand->name= $request['name'];
            $brand->slug=$request['slug'];
            $brand->status= $request['status'] ;
            if ($brand->save()) {
        return Redirect()->route('brands.create')->with('success', 'Brand created successfully!');
    } else {
        // Redirect back to the previous page
        return Redirect::back()->with('error', 'Failed to create brand');
    }
}

    public function edit($brandId,Request $request){
       $brands  = Brand::find($brandId);
       $create = false;
       if(empty($brands)){
        return redirect()->route('brands.index');
       }
       else{
        $title="Edit Brand";
        $button="Save";
        $url=url('/brands/edit');
        $data = compact('brands','url','title','button','create','brandId');
       return view('admin.brands.create') -> with ($data);
       }

    }

    public function update($brandId, Request $request){
         $brands = Brand::find($brandId);

        $brands->name= $request['name'];
        $brands->slug=$request['slug'];
        $brands->status= $request['status'] ;

        $brands->update();
        return redirect('/brands/list');

    }

    public function destroy($id){
        $brands=Brand::find($id);
    if(!is_null($brands)){
        $brands->delete();
        }
        return redirect('/brands/list');   
    }
}
