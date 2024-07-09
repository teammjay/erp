<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){

        $products = Product::latest()->paginate(10);
        return view('pages.products.index',compact('products'));

    }
    public function create(){
        $title="Create Product";
        $button="Create";
        $create = true;
        $url=url('/products/create');
        $categories = Category::orderBy('name','ASC')->get();
        $subCategories = SubCategory::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        $data=compact( 'categories', 'subCategories','brands','title','button','create');
        return view('pages.products.form',compact('url'))->with($data);
    }

    public function store(Request $request){
        $filename = '';
           $rules = [
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required|numeric',
            // 'featured_product' => 'required|in:Yes,No'
           ];
           if ($request->hasFile('image')) {
        $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/products', $filename);
    }
           
            if ($request->filled('track_qty') && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
            } else {
                $request->merge(['qty' => null]); // Set qty to null if track_qty is not Yes
            }
           
           $validator=Validator::make($request->all(),$rules);
           
           if ($validator->passes()) {
               
               
               $product = new Product;
               
               $product->name = $request->name;
               $product->slug = $request->slug;
               $product->description = $request->description;
               $product->price = $request->price;
               $product->compare_price = $request->compare_price;
               $product->sku = $request->sku;
               $product->barcode = $request->barcode;
               $product->track_qty = $request->track_qty;
               $product->quantity = $request->qty;
               $product->status = $request->status;
               $product->category_id = $request->category;
               $product->sub_category_id = $request->subcategory;
               $product->brand_id = $request->brand;
               $product->is_featured = $request->featured_product;
               $product->image= $filename;
               
               if ($product->save()) {
        // Category created successfully
        // $request->session()->put('success', 'Category created successfully!');
        return Redirect()->route('products.create')->with('status', 'Product created successfully!');
    } else {
        // Redirect back to the previous page
        return Redirect::back()->with('error', 'Failed to create product');
    }
    }
}
public function edit($productId, Request $request){

    $product = Product::find($productId);
    $categories = Category::orderBy('name','ASC')->get();
        $subCategories = SubCategory::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
       $create = false;
       if(empty($product)){
        return redirect()->route('products.index');
       }
       else{
        $title="Edit Product";
        $button="Save";
        $url=url('/products/edit');
        $data = compact('product','url','title','button','create','productId','categories', 'subCategories','brands');
       return view('pages.products.form') -> with ($data);
       }

}

public function update($productId, Request $request){
     $product = Product::find($productId);

     $product->name = $request->name;
               $product->slug = $request->slug;
               $product->description = $request->description;
               $product->price = $request->price;
               $product->compare_price = $request->compare_price;
               $product->sku = $request->sku;
               $product->barcode = $request->barcode;
               $product->track_qty = $request->track_qty;
               $product->quantity = $request->qty;
               $product->status = $request->status;
               $product->category_id = $request->category;
               $product->sub_category_id = $request->sub_category;
               $product->brand_id = $request->brand;
               $product->is_featured = $request->featured_product;

                if ($request->hasFile('image')) {
        $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/products', $filename); 
        $product->image = $filename;
    }
        $product->update();
        return redirect('/products/list');
}

public function destroy($id){
    $products=Product::find($id);
    if(!is_null($products)){
        $products->delete();
        }
        return redirect('/products/list'); 

}
    public function getSubcategories($id)
    {
        $category = Category::with(['subcategories', 'brands'])->find($id);

        return response()->json([
            'subcategories' => $category->subcategories,
            'brands' => $category->brands,
        ]);
    }
}
