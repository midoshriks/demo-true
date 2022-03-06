<?php

use App\Category;
use App\SupCategories;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/supcategories', function(){
    return SupCategories::all();
});

Route::get('/categories', function(){
    return response(['categories'=>Category::all()]);
});

Route::get('/categories/{id?}', function(){
    // return category code
    // return subcategory where cat_code = id
    // return response(['sub_categories'=>$var1, 'category'=>$var2]);
});



Route::get('/sub_categories/{id?}', function(){
    // $
    // return products where sub_category_code = id
    // return response(['products'=>$products]);
});

