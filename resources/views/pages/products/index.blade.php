<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="product"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Product Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
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
                    <div class="flex items-start justify-start mb-3">
                        <input type="text" id="searchInput" placeholder="Search..."
                            class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="text-end mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-dark">
                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Product
                </a>
            </div>
                    <div class="my-8">
                        <h1 class="font-semibold text-center mt-5 text-2xl">Products</h1>
                    </div>

                    <div class="overflow-x-auto mt-3">
                        <table class="table table-hover table-striped min-w-full divide-y divide-gray-200" id="dataTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Id</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slug</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Image</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->slug }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                @if ($product->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('storage/images/products/' . $product->image) }}" width="100px"></td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('products.delete', $product->id) }}" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-4">No products found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="my-4">
                            {{ $products->links() }}
                        </div>
                    </div>
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
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

        <!-- Additional Plugins and Scripts -->
        <x-plugins></x-plugins>
        @push('js')
            <script src="{{ asset('assets') }}/js/dropzone.min.js"></script>
            <script src="{{ asset('assets') }}/js/quill.min.js"></script>
            <script>
                var quill = new Quill('#editor', {
                    theme: 'snow' // Specify theme in configuration
                });
            </script>

            <!-- Filter Products -->
            <script>
                // Filter products based on search input
                document.getElementById('searchInput').addEventListener('keyup', function () {
                    let filterValue = this.value.toUpperCase();
                    let rows = document.querySelectorAll('#dataTable tbody tr');

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
    </main>
</x-layout>
