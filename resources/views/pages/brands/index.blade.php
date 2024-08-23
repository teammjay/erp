<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="brands"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Brands'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('demo'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ Session::get('demo') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" id="searchInput" placeholder="Search..." class="form-control px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('brands.create') }}" class="btn btn-primary">Add Brand</a>
                </div>
            </div>

            <div class="text-center mb-4">
                <h1 class="font-semibold text-2xl">Brands</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($brands->isNotEmpty())
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>
                                        @if($brand->status == "active")
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('brands.delete', $brand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-4">No brands found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center my-4">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
    <x-footers.auth></x-footers.auth>

    <!-- Plugins Section -->
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

    <!-- Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function () {
                let filterValue = searchInput.value.toUpperCase();
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
        });
    </script>
</x-layout>
