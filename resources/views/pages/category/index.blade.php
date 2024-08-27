<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="categories"></x-navbars.sidebar>
    <main class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Categories'></x-navbars.navs.auth>
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
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="searchInput" placeholder="Search..." class="form-control">
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-12 text-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-12">
                    <h1 class="font-weight-bold text-center">Categories</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Slug</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if($category->status == "active")
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{route('categories.delete',$category->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No categories found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="my-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
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
    <script>
        // Get the input element
        let searchInput = document.getElementById('searchInput');

        // Add event listener
        searchInput.addEventListener('keyup', function () {
            // Get the filter value
            let filterValue = searchInput.value.toUpperCase();

            // Get the table rows
            let rows = document.querySelectorAll('#dataTable tbody tr');

            // Loop through all table rows, and hide those that don't match the search query
            rows.forEach(function (row) {
                let name = row.querySelector('td:nth-child(2)').textContent.toUpperCase();
                let slug = row.querySelector('td:nth-child(3)').textContent.toUpperCase();
                if (name.includes(filterValue) || slug.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    @endpush
</x-layout>