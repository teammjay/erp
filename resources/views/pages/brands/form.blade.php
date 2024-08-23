<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="brands"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Brands'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid">
            <!-- Success Alert -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="text-sm">{{ session('status') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Demo Alert -->
            @if (Session::has('demo'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="text-sm">{{ session('demo') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="container mt-5">
                <div class="row justify-content-end mb-4">
                    <div class="col-auto">
                        <a href="{{ route('brands.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-yellow">{{$title}}</h1>
                </div>

                <div>
                    <form action="{{ $create ? route('brands.store') : route('brands.update',['brand'=>$brandId]) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-sm mx-auto">
                        @csrf
                        <style>
                            /* Custom CSS to set black border */
                            .form-control, .form-select {
                                border: 1px solid #000;
                            }
                        </style>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" value="{{ isset($brands['name']) ?  $brands['name'] : '' }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" id="slug" name="slug" value="{{ isset($brands['slug']) ?  $brands['slug'] : '' }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                      <div class="mb-3">
                    <label for="subcategory" class="form-label">Subcategory</label>
                                <select name="subcategory" id="subcategory" class="form-select">
                                    <option value="active">Select Subcategory</option>
                                    @if($subCategories->isNotEmpty())
                                    @foreach ($subCategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                    <div class="invalid-feedback">
                        Please select a subcategory.
                    </div>
                </div>

                        <button type="submit" class="btn btn-primary">{{$button}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Plugins -->
    <x-plugins>
        @push('js')
        <script src="{{ asset('assets') }}/js/dropzone.min.js"></script>
        <script src="{{ asset('assets') }}/js/quill.min.js"></script>
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
            });
        </script>
        @endpush
    </x-plugins>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
