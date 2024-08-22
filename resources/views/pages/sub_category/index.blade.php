<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="sub_categories"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Subcategory Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container py-4">
            <!-- Add Subcategory Button -->
            <div class="text-end mb-3">
                <a href="{{ route('subcategories.create') }}" class="btn btn-dark">
                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Subcategory
                </a>
            </div>

            <!-- Search Input -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" id="searchInput" placeholder="Search..." class="form-control form-control-sm bg-light border border-dark">
                </div>
            </div>

            <!-- Page Title -->
            <h1 class="text-center mb-4">Subcategories</h1>

            <!-- Subcategory Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="dataTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slug</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows -->
                                @if ($subCategories->isNotEmpty())
                                    @foreach ($subCategories as $subcategory)
                                        <tr>
                                            <td>{{ $subcategory->id }}</td>
                                            <td>{{ $subcategory->categoryName }}</td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ $subcategory->slug }}</td>
                                            <td>
                                                @if($subcategory->status == "active")
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('subcategories.delete', $subcategory->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No subcategories found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center my-4">
                {{ $subCategories->links() }}
            </div>
        </div>
    </main>
    <x-footers.auth></x-footers.auth>
    <x-plugins></x-plugins>
</x-layout>

<!-- Bootstrap Bundle (includes Popper) and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Search Script -->
<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#dataTable tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
