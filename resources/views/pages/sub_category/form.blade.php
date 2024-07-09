<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="sub_categories"></x-navbars.sidebar>
    <main class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='SubCategories'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container py-4">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('demo'))
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('demo') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row justify-content-end">
                <div class="col-md-2 mb-3"> <!-- Added mb-3 class for bottom margin -->
                    <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="row mb-5"> 
                <div class="col-md-12 text-center"> 
                    <h1 class="display-4 font-weight-bold">{{$title}}</h1> 
                </div>
            </div>
            <form action="{{ $create? route('subcategories.store') : route('subcategories.update',['subcategory'=>$subCategoryId])}}" name="subCategoryForm" id="subCategoryForm" method="POST" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="category" class="col-form-label">Category</label>
                    <select name="category" id="category" class="form-control border border-black" required>
                        <option value="active">Select Category</option>
                        @if($categories->isNotEmpty())
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="invalid-feedback">
                        Please select a category.
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{isset($subCategory['name'])?  $subCategory['name'] : ''}}" class="form-control border border-black" required>
                    <div class="invalid-feedback">
                        Please enter a name.
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-form-label">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{isset($subCategory['slug'])?  $subCategory['slug'] : ''}}" class="form-control border border-black" required>
                    <div class="invalid-feedback">
                        Please enter a slug.
                    </div>
                </div>
                <div class="form-group mb-3"> <!-- Added mb-3 class for bottom margin -->
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" id="status" class="form-control border border-black" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a status.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{$button}}</button>
            </form>
        </div>
    </main>
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
