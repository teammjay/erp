<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;

class getSubcategoriesAndBrands extends Controller
{
    //
   public function getSubcategories(Request $request, $categoryId)
{
    $subcategories = Subcategory::where('category_id', $categoryId)->get();
    return response()->json($subcategories);
}

public function getBrands(Request $request, $categoryId)
{
    $brands = Brand::where('category_id', $categoryId)->get();
    return response()->json($brands);
}
}
