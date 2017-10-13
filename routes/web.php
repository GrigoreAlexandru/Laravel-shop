<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/submit', function () {
    return view('pages.create');
});
//Route::post('/checkout', function () {
//    return view('pages.create');
//});


Auth::routes();

Route::get('/category/{category}', 'ProductsController@index')->name('category');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'ProductsController@show');
Route::get('/', 'ProductsController@index')->name('index');
Route::get('/cart', 'ProductsController@viewCart');

Route::post('/checkout', 'ProductsController@checkout');
Route::post('/create', 'ProductsController@create');
Route::post('/product/{id}/review', 'ProductsController@createReview');
Route::post('/product/{id}/addToCart', 'ProductsController@addToCart');
Route::post('/product/{id}/removeFromCart', 'ProductsController@removeFromCart');
Route::post('/product/{id}/delete', 'ProductsController@delete');
//Route::post('/category', 'ProductsController@addToCart')->name('category');
