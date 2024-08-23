<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-100 p-8">

<div class="flex justify-end my-8">
        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-800">Back</a>
    </div>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-300"> <!-- Added border classes -->
        <h1 class="text-2xl font-semibold mb-4">{{$title}}</h1>
        <form action="{{ $create ? route('products.store') : route('products.update',['product'=>$productId])}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Product Name and Description -->
            <div class="mb-6">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" id="name" name="name"value="{{isset($product['name']) ?  $product['name'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
            </div>
            <div class="mb-6">
                <label for="slug" class="block mb-2">Vendor</label>
                <input type="text" id="vendor" name="vendor" value="{{isset($product['vendor']) ?  $product['vendor'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2">Description</label>
                <textarea id="description" name="description" rows="4"  class="w-full border border-gray-300 rounded-md px-4 py-2">{{isset($product['description']) ?  $product['description'] : ''}}</textarea> <!-- Added border class -->
            </div>

            <!-- Product Category and Subcategory -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Product Category</h2>
                <div class="flex mb-4">
                    <div class="w-1/2 pr-4">
                        <label for="category" class="block mb-2">Category</label>
                        <select name="category" id="category" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                            <option value="active">Select Category</option>
                            @if($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="w-1/2 pl-4">
                        <label for="subcategory" class="block mb-2">Subcategory</label>
                        <select name="subcategory" id="subcategory" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                            <option value="active">Select Subcategory</option>
                            @if($subCategories->isNotEmpty())
                            @foreach ($subCategories as $subcategory)
                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="w-1/2 pl-4">
                        <label for="brand" class="block mb-2">Brand</label>
                        <select name="brand" id="brand" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                            <option value="active">Select Brand</option>
                            @if($brands->isNotEmpty())
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-6">
            <label class="block mb-2">Upload Images (Max:20 images only)</label>
            <input type="file"  name="image" id="image" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple class="form-input" />
            @if(isset($product['image']))
        <img src="{{ asset('storage/images/product/'.$product['image']) }}" alt="Previous Image" class="mt-2">
    @endif
            </div>


            <!-- Pricing: Price and Compare at Price -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Pricing</h2>
                <div class="flex mb-4">
                    <div class="w-1/2 pr-4">
                        <label for="price" class="block mb-2">Price</label>
                        <input type="text" id="price" name="price" value="{{isset($product['price']) ?  $product['price'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                    </div>
                    <div class="w-1/2 pl-4">
                        <label for="compare_price" class="block mb-2">Compare at Price</label>
                        <input type="text" id="compare_price" name="compare_price" value="{{isset($product['compare_price']) ?  $product['compare_price'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                    </div>
                </div>
            </div>

            <!-- Inventory: SKU, Barcode, Track Quantity, Quantity -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Inventory</h2>
                <div class="flex mb-4">
                    <div class="w-1/2 pr-4">
                        <label for="sku" class="block mb-2">SKU (Stock Keeping Unit)</label>
                        <input type="text" id="sku" name="sku" value="{{isset($product['sku']) ?  $product['sku'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                    </div>
                    <div class="w-1/2 pl-4">
                        <label for="barcode" class="block mb-2">Barcode</label>
                        <input type="text" id="barcode" name="barcode" value="{{isset($product['barcode']) ?  $product['barcode'] : ''}}" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                    </div>
                </div>



                <div class="mb-6">
    <div class="flex items-center">
        <h1 class="mr-2 text-lg font-semi-bold">Track Quantity</h1>
        <input type="radio" id="track_qty_yes" name="track_qty" value="Yes" class="mr-2">
        <label for="track_qty_yes" class="mr-4 cursor-pointer">Yes</label>
        <input type="radio" id="track_qty_no" name="track_qty" value="No" class="mr-2">
        <label for="track_qty_no" class="cursor-pointer">No</label>
    </div>
</div>
                    <div class="mb-6">
        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
        <select name="status"title="status" id="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

                <div>
                    <label for="qty" class="block mb-2">Quantity</label>
                    <input type="number" id="qty" name="qty"  min="0" class="w-full border border-gray-300 rounded-md px-4 py-2" value="{{ old('qty') }}"> <!-- Added border class -->
                </div>
            </div>
            
            <!-- Featured Product and Image -->
            <div class="mb-6">
                <label for="featured_product" class="block mb-2">Featured Product</label>
                <select name="featured_product" id="featured_product" class="w-full border border-gray-300 rounded-md px-4 py-2"> <!-- Added border class -->
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mb-6">
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-700">{{$button}}</button>
            </div>
        </form>
    </div>
</body>
</html>
