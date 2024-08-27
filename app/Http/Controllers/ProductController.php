<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Services\ShopifyService;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class ProductController extends Controller
{

     protected $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

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

public function store(Request $request)
{
     Log::info("Inside store");
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
        $filename = time(). "-shop.". $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/products', $filename);
    }

    if ($request->filled('track_qty') && $request->track_qty == 'Yes') {
        $rules['qty'] = 'required|numeric';
    } else {
        $request->merge(['qty' => null]); // Set qty to null if track_qty is not Yes
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        if (request()->wantsJson()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            return back()->withErrors($validator->errors())->withInput();
        }
    }

    try { 
        $product = new Product;

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->sku = $request->input('sku');
        $product->barcode = $request->input('barcode');
        $product->track_qty = $request->input('track_qty');
        $product->quantity = $request->input('qty')?? 0; // default to 0 if qty is null
        $product->status = $request->input('status');
        $product->category_id = $request->input('category');
        $product->sub_category_id = $request->input('subcategory');
        $product->brand_id = $request->input('brand');
        $product->is_featured = $request->input('featured_product');
        $product->image = $filename;

        if ($product->save()) {
            // Create the product on Shopify
            $shopifyProductData = [
                'title' => $request->input('name'),
                'body_html' => $request->input('description'),
                'vendor' => 'YourVendorName',
                'product_type' => 'YourProductType',
                'tags' => 'YourTags',
                'variants' => [
                    [
                        'price' => $request->input('price'),
                        'sku' => $request->input('sku'),
                        'inventory_management' => 'shopify',
                        'inventory_quantity' => $request->input('qty'),
                    ],
                ],
            ];

            $this->shopifyService->createProduct($shopifyProductData);

            return redirect()->route('products.create')->with('status', 'Product created successfully!');
        }
    } catch (\Exception $e) {

        dd($e);
        return back()->withErrors(['error' => 'Failed to create product: '. $e->getMessage()])->withInput();
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
