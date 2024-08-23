<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('pages.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $data = [
            'title' => "Create Category",
            'button' => "Create",
            'create' => true,
            'url' => url('/categories/create')
        ];
        return view('pages.category.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:categories',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/category', $filename);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->image = $filename;

        if ($category->save()) {
            return Redirect()->route('categories.create')->with('status', 'Category created successfully!');
        } else {
            return Redirect::back()->with('error', 'Failed to create category');
        }
    }

    public function edit($categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('categories.index');
        }

        $data = [
            'title' => "Edit Category",
            'button' => "Save",
            'create' => false,
            'url' => url('/categories/edit/' . $categoryId),
            'category' => $category,
            'categoryId' => $categoryId,
        ];

        return view('pages.category.form', $data);
    }

    public function update($categoryId, Request $request)
    {
        $category = Category::find($categoryId);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            $filename = time() . "-shop." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images/category', $filename);
            $category->image = $filename;
        }

        $category->save();
        return redirect('/categories/list');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            $category->delete();
        }
        return redirect('/categories/list');
    }
}
