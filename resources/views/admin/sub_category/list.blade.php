<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <div class="flex items-start justify-start">
    <input type="text" id="searchInput" placeholder="Search..." class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
</div>
    <div class="flex justify-end my-8">
        
        <a href="{{ route('subcategories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-green-600">Add SubCategory</a>
    </div>
    <div class="my-8">
        <h1 class="font-semibold text-center mt-5 text-2xl">SubCategories</h1>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table-auto min-w-full divide-y divide-gray-200" id="dataTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
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
       <a href="" class="inline-block p-1 bg-green-500 text-white font-bold rounded-md">
    <span class="px-2 py-1 bg-green-600 text-white font-semibold rounded-md">Active</span>
</a>

    @else
       <a href="" class="inline-block p-1 bg-red-500 text-white font-bold rounded-md">
    <span class="px-2 py-1 bg-red-600 text-white font-semibold rounded-md">Inactive</span>
</a>

    @endif
</td>

             <td class="px-4 py-2">
                <a href="{{route('subcategories.edit',$subcategory->id)}}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
                <a href="{{route('subcategories.delete',$subcategory->id)}}" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</a> 
                </form>
            </td>       
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center py-4">No categories found.</td>
    </tr>
@endif

            </tbody>
        </table>
        <div class="my-4">
            {{ $subCategories->links() }}
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
</body>
</html>