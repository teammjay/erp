<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(10);

        // $data['categories']=$categories;
        return view('admin.category.list',compact('categories'));
    }

    public function create(){
        $title="Create Category";
        $button="Create";
        $create = true;
        $url=url('/categories/create');
        $data=compact('title','button','create');
        return view('admin.category.create',compact('url'))->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:categories',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/category',$filename); 
        //   if ($request->hasFile('image')) {
            //      $image = $request->file('image');
            //      $imageName = $image->getClientOriginalName();
            //      $imagePath = $image->storeAs('images', $imageName);
            //  }
            $category = new Category();
            $category->name= $request['name'];
            $category->slug=$request['slug'];
            $category->status= $request['status'] ;
            $category->image= $filename;
            //  $category->image = $imagePath ?? null; 
            
            
            if ($category->save()) {
        // Category created successfully
        // $request->session()->put('success', 'Category created successfully!');
        return Redirect()->route('categories.create')->with('success', 'Category created successfully!');
    } else {
        // Redirect back to the previous page
        return Redirect::back()->with('error', 'Failed to create category');
    }
}


    public function edit($categoryId, Request $request) {
       $category = Category::find($categoryId);
       $create = false;
       if(empty($category)){
        return redirect()->route('categories.index');
       }
       else{
        $title="Edit Category";
        $button="Save";
        $url=url('/categories/edit');
        $data = compact('category','url','title','button','create','categoryId');
       return view('admin.category.create') -> with ($data);
       }

    }

     public function update($categoryId, Request $request){
        $category = Category::find($categoryId);

        // return json_encode($category);
        // $category = new Category();


        $category->name= $request['name'];
        $category->slug=$request['slug'];
        $category->status= $request['status'] ;
        // $category->image= $filename;

        if ($request->hasFile('image')) {
        $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/category', $filename); 
        $category->image = $filename;
    }

        $category->update();
        return redirect('/categories/list');
    }

     public function destroy($id){
     $categories=Category::find($id);
    if(!is_null($categories)){
        $categories->delete();
        }
        return redirect('/categories/list');   
    }
}
