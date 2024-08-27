<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShopifyService;
use App\Models\Product; // Ensure the Product model is imported
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ShopifyProductController extends Controller
{
    protected $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function store(Request $request)
    {
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

        $validator = Validator::make($request->all(), $rules);

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
            $product->image = $filename;

            if ($product->save()) {
                // Prepare data for Shopify
                $shopifyProductData = [
                    'title' => $request->name,
                    'body_html' => $request->description,
                    'vendor' => 'YourVendorName',
                    'product_type' => 'YourProductType',
                    'tags' => 'YourTags',
                    'variants' => [
                        [
                            'price' => $request->price,
                            'sku' => $request->sku,
                            'inventory_management' => 'shopify',
                            'inventory_quantity' => $request->qty,
                        ],
                    ],
                ];
                print_r(json_encode($shopifyProductData));
                die();
                // Send product data to Shopify
                $this->shopifyService->createProduct($shopifyProductData);

                // Redirect or respond
                return redirect()->route('products.index')->with('status', 'Product created and listed on Shopify!');
            } else {
                // Redirect back to the previous page
                return Redirect::back()->with('error', 'Failed to create product');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }
}
