<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="categories"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="{{ $title }}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ session('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('demo'))
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ session('demo') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="d-flex justify-content-end my-4">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
            </div>

                        <div class="row mb-5"> 
                <div class="col-md-12 text-center"> 
                    <h1 class="display-4 font-weight-bold">{{$title}}</h1> 
                </div>
            <div class="card shadow-sm border border-black">
                <div class="card-body">
                    <form action="{{ $create ? route('categories.store') : route('categories.update',['category'=>$categoryId]) }}" method="POST" enctype="multipart/form-data" class="col-md-6 offset-md-3">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" id="name" name="name" value="{{ isset($category['name']) ? $category['name'] : '' }}" class="form-control border border-black" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="slug" class="col-form-label">Slug:</label>
                            <input type="text" id="slug" name="slug" value="{{ isset($category['slug']) ? $category['slug'] : '' }}" class="form-control border border-black" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" id="status" class="form-control border border-black" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="image" class="col-form-label">Image:</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control border border-black">
                            @if (isset($category['image']))
                                <img src="{{ asset('storage/images/category/'.$category['image']) }}" alt="Previous Image" class="mt-2">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">{{$button}}</button>
                    </form>
                </div>
            </div>
        </div>
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

<script>
    // Get the title input element
    const titleInput = document.getElementById('name');

    // Add an input event listener to the name input
    titleInput.addEventListener('input', function() {
        // Get the current name value
        const title = titleInput.value;

        // Make an HTTP GET request to the /getSlug route
        fetch(`/getSlug?title=${title}`)
           .then(response => response.json())
           .then(data => {
                // Display the slug value
                const slugDisplay = document.getElementById('slug');
                slugDisplay.value = data.slug;
            })
           .catch(error => {
                // Handle any errors
                console.error(error);
            });
    });
</script>
