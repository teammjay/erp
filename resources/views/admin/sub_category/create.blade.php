<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-100">

    <div class="flex justify-end my-8">
        <a href="{{ route('subcategories.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-800">Back</a>
    </div>
    <div class="text-center mb-8"> 
        <h1 class="text-4xl font-bold text-gray-800 dark:text-yellow">{{$title}}</h1> 
    </div>
    <form action="{{ $create ? route('subcategories.store') : route('subcategories.update',['subcategory'=>$subCategoryId])}}" name="subCategoryForm" id="subCategoryForm" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="category" id="category" class="block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded focus:outline-none focus:border-gray-500" required>
                <option value="active">Select Category</option>
                @if($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                @endif
            </select>
            <p></p>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{isset($subCategory['name']) ?  $subCategory['name'] : ''}}" class="border border-gray-200 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <p></p>
        </div>
        <div class="mb-4">
            <label for="slug" class="block text-gray-700 font-bold mb-2">Slug</label>
            <input type="text" name="slug" id="slug" value="{{isset($subCategory['slug']) ?  $subCategory['slug'] : ''}}" class="border border-gray-200 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <p></p>
        </div>
        <div class="mb-4">
        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
        <select name="status"title="status" id="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <p></p>
    </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{$button}}</button>
    </form>
</body>
</html>
