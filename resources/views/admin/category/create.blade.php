<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
        <script>
        // Get the title input element
        const titleInput = document.getElementById('title');

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
                    slugDisplay.textContent = data.slug;
                })
                .catch(error => {
                    // Handle any errors
                    console.error(error);
                });
        });
    </script>
</head>
<body>
    <div class="flex justify-end my-8">
        <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-800">Back</a>
    </div>
    <div class="text-center mb-8"> 
        <h1 class="text-4xl font-bold text-gray-800 dark:text-yellow">{{$title}}</h1> 
</div>
    <div>
      <form action="{{ $create ? route('categories.store') : route('categories.update',['category'=>$categoryId])}}" method="POST" enctype="multipart/form-data" class="w-full max-w-sm mx-auto">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
        <input type="text" title="name" id="name" name="name" value="{{isset($category['name']) ?  $category['name'] : ''}}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="mb-4">
        <label for="slug" class="block text-gray-700 font-bold mb-2">Slug</label>
        <input type="text" title="slug" id="slug" name="slug" value="{{isset($category['slug']) ?  $category['slug'] : ''}}"class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required >
    </div>
    <div class="mb-4">
        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
        <select name="status"title="status" id="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
     <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if(isset($category['image']))
        <img src="{{ asset('storage/images/category/'.$category['image']) }}" alt="Previous Image" class="mt-2">
    @endif
        </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{$button}}</button>
</form>
    </div>
</body>
</html>