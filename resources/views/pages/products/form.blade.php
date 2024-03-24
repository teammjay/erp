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
            <form id="product-form" method='POST' action='/product/{{ $product ? $product->id : ''  }}' enctype="multipart/form-data">
                @csrf
                @if($product)
                    @method('PUT')
                @endif
                <div class="card card-body">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Basic Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border border-2 p-2" value='{{ old('name', $product ? $product->name : '') }}'>
                                        @error('name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Default Price</label>
                                        <input type="text" name="name" class="form-control border border-2 p-2" value='{{ old('price', $product ? $product->price : '') }}'>
                                        @error('price')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" name="sku" class="form-control border border-2 p-2" value='{{ old('sku', $product ? $product->sku : '') }}'>
                                        @error('sku')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Inventory</label>
                                        <input type="text" name="quantity" class="form-control border border-2 p-2" value='{{ old('quantity', $product ? $product->quantity : '') }}'>
                                        @error('quantity')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header pt-0 pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Desciption</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="editor"></div>
                        </div>
                        <div class="card-header pt-0 pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Images</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div action="/file-upload" class="border dropzone" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            <a href='{{ route("product.index") }}' class="btn bg-gradient-dark ms-3">Back</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>
    @push('js')
    <script src="{{ asset('assets') }}/js/dropzone.min.js"></script>
    <script src="{{ asset('assets') }}/js/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow' // Specify theme in configuration
        });
    </script>
    @endpush
</x-layout>
