<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{
    public function index()
    {
        
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
                        ->latest('id')
                        ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');
        $subCategories = $subCategories->paginate(10);

        // $data['categories']=$categories;
        return view('admin.sub_category.list',compact('subCategories'));
    }
    public function create(){
    $title = "Create SubCategory";
     $create = true;
    $button = "Create";
    $categories = Category::orderBy('name','ASC')->get();
    $data = compact('title', 'button', 'create','categories');

    
    return view('admin.sub_category.create', $data);

    }

    public function store(request $request){
        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:categories',
            'status' => 'required|in:active,inactive',
        ]);
            $subcategory = new SubCategory();
            $subcategory->name= $request['name'];
            $subcategory->category_id=$request['category'];
            $subcategory->slug=$request['slug'];
            $subcategory->status= $request['status'] ;

            if ($subcategory->save()) {
                return Redirect()->route('subcategories.create')->with('success', 'SubCategory created successfully!');
    }
    else {
        // Redirect back to the previous page
        return Redirect::back()->with('error', 'Failed to create subcategory');;
    }
}

public function edit($subCategoryId, Request $request) {
       $subCategory = SubCategory::find($subCategoryId);
       $create = false;
       if(empty($subCategory)){
        return redirect()->route('subcategories.index');
       }
       else{
        $title="Edit SubCategory";
        $button="Save";
        $url=url('/subcategories/edit');
        $categories = Category::orderBy('name','ASC')->get();
        $data = compact('subCategory','url','title','button','create','subCategoryId','categories');
       return view('admin.sub_category.create') -> with ($data);
       }

    }

    public function update($subCategoryId, Request $request){
        $subCategory = SubCategory::find($subCategoryId);

        // return json_encode($category);
        // $category = new Category();


        $subCategory->name= $request['name'];
        $subCategory->slug=$request['slug'];
        $subCategory->status= $request['status'] ;
        // $category->image= $filename;


        $subCategory->update();
        return redirect('/subcategories/list');
    }

     public function destroy($subCategoryId){
     $subCategories=SubCategory::find($subCategoryId);
    if(!is_null($subCategories)){
        $subCategories->delete();
        }
        return redirect('/subcategories/list');   
    }
}

