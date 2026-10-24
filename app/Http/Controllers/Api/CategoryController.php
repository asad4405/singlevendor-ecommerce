<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $categories = Category::where('status',1)->select('id','category_name','slug','image')->get();
        return response()->json([
            'status' => true,
            'data' => $categories,
            'message' => 'Category List fetch successfully!'
        ]);
    }
    public function menuCategories()
    {
        $categories = Category::where('status',1)->select('id','category_name','slug','image')->with(['subcategories.childcategories'])->get();
        return response()->json([
            'status' => true,
            'data' => $categories,
            'message' => 'Category List fetch successfully!'
        ]);
    }
    public function subCategoryList()
    {
        $subcategories = Subcategory::where('status',1)->get();
        return response()->json([
            'status' => true,
            'data' => $subcategories,
            'message' => 'Subcategory List fetch successfully!'
        ]);
    }
    public function subcategoriesByCategory()
    {
        $subcategories = Subcategory::where('status',1)->get();
        return response()->json([
            'status' => true,
            'data' => $subcategories,
            'message' => 'Subcategory List fetch successfully!'
        ]);
    }
    public function childCategoryList()
    {
        $childcategories = Childcategory::where('status',1)->get();
        return response()->json([
            'status' => true,
            'data' => $childcategories,
            'message' => 'Childcategory List fetch successfully!'
        ]);
    }
    public function childcategoriesBySubcategory()
    {
        $childcategories = Childcategory::where('status',1)->get();
        return response()->json([
            'status' => true,
            'data' => $childcategories,
            'message' => 'Childcategory List fetch successfully!'
        ]);
    }
}
