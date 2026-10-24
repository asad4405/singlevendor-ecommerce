<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function frontCategoryProducts()
    {
        $categories = Category::where('status', 1)
            ->orderBy('id', 'ASC')
            ->with([
                'products',
                'products.image',
                'products.inventory',
                'products.inventory.color',
                'products.inventory.size'
            ])
            ->get();

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'category_id'   => $category->id,
                'category_name' => $category->category_name,
                'slug'          => $category->slug,
                'front_view'    => $category->front_view,
                'products'      => $category->products
            ];
        }

        return response()->json([
            'status'  => true,
            'data'    => $data,
            'message' => 'Category wise product fetch successfully'
        ], 200);
    }

    public function productDetails(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->select('id', 'product_name', 'product_code', 'product_image', 'product_type', 'category_id', 'subcategory_id', 'childcategory_id', 'old_price', 'new_price', 'stock', 'product_unit', 'product_video', 'short_description', 'description')
            ->with('sliderimages')->first();
        $inventory = Inventory::where('product_id',$product->id)->with('color','size')->get();

        return response()->json([
            'status' => true,
            'data' =>  [
                'product'        => $product,
                'inventory'  => $inventory,
            ],
            'messsage' => 'Product details data fetch successfully!'
        ]);

    }

    public function relatedProducts($slug)
    {
        $product = Product::where('slug', $slug)->select('id', 'category_id')->first();
        $category_id = $product->category_id;
        $relatedProducts = Product::where('category_id', $category_id)
            ->select('id', 'product_name', 'product_image', 'product_type', 'old_price', 'new_price')
            ->where('id', '!=', $product->id)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $relatedProducts,
            'messsage' => 'Related product data fetch successfully!'
        ]);
    }

    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categoryProducts = Product::where('category_id', $category->id)
            ->select('id', 'product_name', 'product_image', 'product_type', 'old_price', 'new_price')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $categoryProducts,
            'messsage' => 'Category product data fetch successfully!'
        ]);
    }
    public function subCategoryProducts($slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->first();
        $subcategoryProducts = Product::where('subcategory_id', $subcategory->id)
            ->select('id', 'product_name', 'product_image', 'product_type', 'old_price', 'new_price')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $subcategoryProducts,
            'messsage' => 'Subcategory product data fetch successfully!'
        ]);
    }
    public function childCategoryProducts($slug)
    {
        $childcategory = Childcategory::where('slug', $slug)->first();
        $childcategoryProducts = Product::where('subcategory_id', $childcategory->id)
            ->select('id', 'product_name', 'product_image', 'product_type', 'old_price', 'new_price')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $childcategoryProducts,
            'messsage' => 'Childcategory product data fetch successfully!'
        ]);
    }
    public function searchCategoryProducts($search)
    {
        $searchProducts = Product::where('product_name', 'LIKE', "%{$search}%")
            ->orWhere('product_code', 'LIKE', "%{$search}%")
            ->select('id', 'product_name', 'product_image', 'product_type', 'old_price', 'new_price')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $searchProducts,
            'messsage' => 'Search product data fetch successfully!'
        ]);
    }

    public function featureproducts()
    {
        $products = Product::where('status',1)->where('feature_product', 1)
            ->select('id','slug', 'product_name', 'product_code', 'product_image', 'product_type', 'category_id', 'subcategory_id', 'childcategory_id', 'old_price', 'new_price', 'stock', 'product_unit', 'product_video', 'short_description', 'description')
            ->with('sliderimages')->get();

        return response()->json([
            'status' => true,
            'data' => $products,
            'messsage' => 'Feature products data fetch successfully!'
        ]);
    }

    public function shopProducts()
    {
        $products = Product::where('status',1)->latest()
            ->select('id','slug', 'product_name', 'product_code', 'product_image', 'product_type', 'category_id', 'subcategory_id', 'childcategory_id', 'old_price', 'new_price', 'stock', 'product_unit', 'product_video', 'short_description', 'description')
            ->with('sliderimages')->get();

        return response()->json([
            'status' => true,
            'data' => $products,
            'messsage' => 'Shop products data fetch successfully!'
        ]);
    }
}
