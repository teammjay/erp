<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use App\Models\SubCategory;

class BrandController extends Controller
{

    public  function index() {
            $brands = Brand::select('brands.*', 'sub_categories.name as subcategoryName')
                   ->leftJoin('sub_categories', function ($join) {
                       $join->on('brands.subcategory_id', '=', 'sub_categories.id');
                   })
                   ->latest('id')
                   ->paginate(10);


        return view('pages.brands.index',compact('brands'));

    }
    public function create(){
         $title="Create Brand";
        $button="Create";
        $create = true;
        $url=url('/brands/create');
        $subCategories = SubCategory::orderBy('name','ASC')->get();
        $data=compact('title','button','create','subCategories');
        
        return view('pages.brands.form',compact('url'))->with($data);
    }

    public  function store(Request $request) {
        
       $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
            'status' => 'required|in:active,inactive',
           // 'category' => 'required'
       ]);

       if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }

            $brand = new Brand();
            $brand->name= $request['name'];
            $brand->slug=$request['slug'];
            $brand->status= $request['status'] ;
            $brand['subcategory_id'] = $request['subcategory'];

            if ($brand->save()) {
        return Redirect()->route('brands.create')->with('status', 'Brand created successfully!');
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
        $subCategories = SubCategory::orderBy('name','ASC')->get();
        $data = compact('brands','url','title','button','create','brandId','subCategories');
       return view('pages.brands.form') -> with ($data);
       }

    }

    public function update($brandId, Request $request){
         $brands = Brand::find($brandId);

        $brands->name= $request['name'];
        $brands->slug=$request['slug'];
        $brands->category_id = $request['Category'];
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
