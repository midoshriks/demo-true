<?php
// use Illuminate\Routing\Route;

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;

 //category routes
Route::post('/importexcel', 'CategoryController@importexcel');
Route::post('/importsupexcel', 'SupCategoriesController@importsupexcel');
Route::post('/importproduct', 'ProductController@importproduct');

Route::group(['prefix' => 'LaravelLocalization'::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');

            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::get('/export', 'CategoryController@export')->name('export');

            //SupCategories
            Route::resource('supcategories', 'SupCategoriesController' )->except(['show']);
            Route::get('/exportsup', 'SupCategoriesController@export')->name('exportsup');

            //product routes
            Route::resource('products', 'ProductController')->except(['show']);
            Route::get('/exportproduct', 'ProductController@exportproduct')->name('export_Product');

            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

            //order routes
            Route::resource('orders', 'OrderController');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');


            //user routes
            Route::resource('users', 'UserController')->except(['show']);

        });//end of dashboard routes
    });
