<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
                        ->leftJoin('categories', 'categories.id', 'sub_categories.category_id')
                        ->latest('id')
                        ->paginate(10);

        return view('pages.sub_category.index', compact('subCategories'));
    }
        public function create()
        {
            $title = "Create SubCategory";
            $create = true;
            $button = "Create";
            $categories = Category::orderBy('name', 'ASC')->get();

            return view('pages.sub_category.form', compact('title', 'button', 'create', 'categories'));
        }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:sub_categories',
            'status' => 'required|in:active,inactive',
        ]);

        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->slug = $request->slug;
        $subcategory->status = $request->status;

        if ($subcategory->save()) {
            return redirect()->route('subcategories.create')->with('status', 'SubCategory created successfully!');
        } else {
            return Redirect::back()->with('error', 'Failed to create subcategory');
        }
    }

    public function edit($subCategoryId, Request $request) {
       $subCategory = SubCategory::find($subCategoryId);
       $create = false;
       if(empty($subCategory)){
        return redirect()->route('subcategories.index');
       }
       else{
        $title="Edit SubCategory";
        $button="Save";
        $url=url('/subcategories/edit');
        $categories = Category::orderBy('name','ASC')->get();
        $data = compact('subCategory','url','title','button','create','subCategoryId','categories');
       return view('pages.sub_category.form') -> with ($data);
       }

    }

    public function update(Request $request, $subCategoryId)
    {
        $subCategory = SubCategory::find($subCategoryId);

        if (!$subCategory) {
            return redirect()->route('subcategories.index');
        }

        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:sub_categories,slug,' . $subCategory->id,
            'status' => 'required|in:active,inactive',
        ]);

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->slug = $request->slug;
        $subCategory->status = $request->status;

        if ($subCategory->update()) {
            return redirect()->route('subcategories.index')->with('status', 'SubCategory updated successfully!');
        } else {
            return Redirect::back()->with('error', 'Failed to update subcategory');
        }
    }

    public function destroy($subCategoryId)
    {
        $subCategory = SubCategory::find($subCategoryId);

        if ($subCategory) {
            $subCategory->delete();
        }

        return redirect()->route('subcategories.index')->with('status', 'SubCategory deleted successfully!');
    }
}
