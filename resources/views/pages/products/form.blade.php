<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="product"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Product'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                        data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('demo'))
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('demo') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                        data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

{{--            <div class="d-flex justify-content-end my-4">--}}
{{--                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>--}}
{{--            </div>--}}
                <div>
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{isset($product['name']) ?  $product['name'] : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Description</label>
                                    <textarea id="description" name="description" rows="4"  class="form-control"
                                              data-placeholder="Enter Product Description Here"
                                              spellcheck="false" onfocus="onElementFocus(this)" onfocusout="onElementDeFocused(this)" >
                                        {{isset($product['description']) ?  $product['description'] : ''}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <h2 class="h5 mb-3">Product Category</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="active">Select Category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="subcategory">Subcategory</label>
                                    <select class="form-control" name="subcategory" id="subcategory">
                                        <option value="active">Select Subcategory</option>
                                        @if($subCategories->isNotEmpty())
                                            @foreach ($subCategories as $subcategory)
                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" name="brand" id="brand">
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
                        <h2 class="h5 mb-3">Pricing</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{isset($product['price']) ?  $product['price'] : ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label for="compare_price" class="form-label">Compare at Price</label>
                                    <input type="text" class="form-control" id="compare_price" name="compare_price" value="{{isset($product['compare_price']) ?  $product['compare_price'] : ''}}">
                                </div>
                            </div>
                        </div>
                        <h2 class="h5 mb-3">Inventory</h2>
                    </form>
                </div>
            <div class="card mx-auto shadow-sm border border-gray-300 p-4">
                <h1 class="card-title h4 mb-4">{{$title}}</h1>
                <form action="{{ $create ? route('products.store') : route('products.update',['product'=>$productId])}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control border border-black">{{isset($product['description']) ?  $product['description'] : ''}}</textarea>
                    </div>

                    <div class="mb-3">
                        <h2 class="form-label h5 mb-3">Upload Images (Max:20 images only)</h2>
                        <input type="file" name="image" id="image" class="form-control border border-black" multiple>
                        @if(isset($product['image']))
                        <img src="{{ asset('storage/images/product/'.$product['image']) }}" alt="Previous Image" class="mt-2">
                        @endif
                    </div>

                    <!-- Inventory: SKU, Barcode, Track Quantity, Quantity -->
                    <div class="mb-3">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">SKU (Stock Keeping Unit)</label>
                                <input type="text" id="sku" name="sku" value="{{isset($product['sku']) ?  $product['sku'] : ''}}" class="form-control border border-black">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" id="barcode" name="barcode" value="{{isset($product['barcode']) ?  $product['barcode'] : ''}}" class="form-control border border-black">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Track Quantity</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="track_qty_yes" name="track_qty" value="Yes">
                                <label class="form-check-label" for="track_qty_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="track_qty_no" name="track_qty" value="No">
                                <label class="form-check-label" for="track_qty_no">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" id="qty" name="qty" min="0" class="form-control border border-black" value="{{ old('qty') }}">
                        </div>
                    </div>

                    <!-- Featured Product -->
                    <div class="mb-3">
                        <label for="featured_product" class="form-label">Featured Product</label>
                        <select name="featured_product" id="featured_product" class="form-select">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">{{$button}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-plugins></x-plugins>
    @push('js')
    <script src="{{ asset('assets') }}/js/dropzone.min.js"></script>
    <script src="{{ asset('assets') }}/js/quill.min.js"></script>
    <script src="{{ asset('assets') }}/js/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow' // Specify theme in configuration
        });
    </script>
    @endpush
    <script>
//     categorySelect.addEventListener('change', function () {
//     const categoryId = this.value;
//
//     // Clear existing options
//     subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
//     brandSelect.innerHTML = '<option value="">Select Brand</option>';
//
//     if (categoryId) {
//         fetch(`/categories/${categoryId}/subcategories`)
//             .then(response => response.json())
//             .then(data => {
//                 data.subcategories.forEach(subcategory => {
//                     const option = document.createElement('option');
//                     option.value = subcategory.id;
//                     option.textContent = subcategory.name;
//                     subcategorySelect.appendChild(option);
//                 });
//
//                 // You need to send a separate request to fetch brands
//                 fetch(`/categories/${categoryId}/brands`)
//                     .then(response => response.json())
//                     .then(data => {
//                         data.brands.forEach(brand => {
//                             const option = document.createElement('option');
//                             option.value = brand.id;
//                             option.textContent = brand.name;
//                             brandSelect.appendChild(option);
//                         });
//                     });
//             })
//             .catch(error => console.error('Fetch error:', error));
//     }
// });
</script>

</x-layout>
