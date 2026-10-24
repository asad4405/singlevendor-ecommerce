<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Support\Facades\Route;

// =========== api ============= //
Route::get('settings', [SettingsController::class, 'settings']);
Route::get('contact-info', [SettingsController::class, 'contact_info']);
Route::get('social-media', [FrontendController::class, 'socialMedia']);
Route::get('policy-pages', [FrontendController::class, 'policyPages']);
// banner
Route::get('/mainslider', [FrontendController::class, 'mainSlider']);

// category
Route::get('/categories', [CategoryController::class, 'categoryList']);
Route::get('/menu-categories', [CategoryController::class, 'menuCategories']);

// subcategory
Route::get('/subcategories', [CategoryController::class, 'subCategoryList']);
Route::get('/subcategories-by-category/{slug}', [CategoryController::class, 'subcategoriesByCategory']);

// childcategory
Route::get('/childcategories', [CategoryController::class, 'childCategoryList']);
Route::get('/childcategories-by-subcategory/{slug}', [CategoryController::class, 'childcategoriesBySubcategory']);

// brands
Route::get('/brands', [FrontendController::class, 'brands']);

// products
Route::get('/front-category-products', [ProductController::class, 'frontCategoryProducts']);
Route::get('/product-details/{slug}', [ProductController::class, 'productDetails']);
Route::get('/related-products/{slug}', [ProductController::class, 'relatedProducts']);
Route::get('/category-products/{slug}', [ProductController::class, 'categoryProducts']);
Route::get('/subcategory-products/{slug}', [ProductController::class, 'subCategoryProducts']);
Route::get('/childcategory-products/{slug}', [ProductController::class, 'childCategoryProducts']);
Route::get('/search-products/{search}', [ProductController::class, 'searchCategoryProducts']);
Route::get('/feature-products', [ProductController::class, 'featureproducts']);
Route::get('/shop-products', [ProductController::class, 'shopProducts']);


// cart
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('/cart-products', [CartController::class, 'cartProducts']);
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart']);
Route::post('/clear-cart', [CartController::class, 'clearCart']);

// orders
Route::post('/place-order', [OrderController::class, 'placeOrder']);
Route::post('/track-order', [OrderController::class, 'trackOrder']);
