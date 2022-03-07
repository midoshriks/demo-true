<?php

use App\Category;
use App\Product;
use App\SupCategories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/supcategories', function(){
    return SupCategories::all();
});

Route::get('/categories', function(){
    return response(['categories'=>Category::all()]);
});

Route::get('/categories/{id}', function( $id){
    $categories_id = Category::find($id);
    // return response(['categories'=>Category::all()]);
    return response(['categories'=>$categories_id]);
});

Route::get('/sub_categories/{id}', function( $id){
    $sub_categories_id = SupCategories::find($id);
    // return response(['categories'=>Category::all()]);
    return response(['sub_categories'=>$sub_categories_id]);
});

Route::get('/categories/{id?}/{cat_code?}', function($id , $cat_code){

    // return response([$cat_code = SupCategories::with('code', $cat_code)->where('id', $id)->get()]);

    // return category code
    // return response(['cat_code'=>Category::find($id)]);


    $cat = Category::find($id);
    $cat_code = SupCategories::where('cat_code' , $cat_code )->get();

    // return subcategory where cat_code = id
    // return response([$data]);

    return response([
        'category'=>$cat,
        'sub_categories'=>$cat_code,
    ]);
    // return response(['sub_categories'=>$var1, 'category'=>$var2]);
});



Route::get('/sub_categories/{id?}/{sub_category_code}', function($id , $sub_category_code){
    // $
    // return products where sub_category_code = id
    // return response(['products'=>$products]);

    // $sub_category_code = Product::where('sub_category_code',$sub_category_code)->get();
    $sub_categories_id = SupCategories::find($id);
    $products = Product::where('sub_category_code',$sub_category_code)->get();
    return response([
        'id'=>$sub_categories_id,
        'products'=>$products,
    ]);
});

