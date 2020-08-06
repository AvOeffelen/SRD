<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


Route::get('/products','ProductController@show')->name('product.show');

Route::get('/customer','UserController@show')->name('customer.show');


//,'middleware'=>['web']
Route::group(['prefix' => 'axios', 'namespace' => 'Axios'], function () {
    Route::post('/product/store','ProductController@store')->name('axios.product.store');
    Route::get('product/get/all','ProductController@getAll')->name('axios.product.get.all');

    Route::delete('product/{product}','ProductController@removeProduct')->name('axios.product.delete');

});


Route::group(['prefix' => 'axios/customer', 'namespace' => 'Axios'], function () {

});
