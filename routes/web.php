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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'CartController@cart');
Route::get('/add-to-cart/{id}', 'CartController@addToCart');

Route::get('/orders', 'OrderController@orders');
Route::get('/orders/{id}', 'OrderController@order');

Route::get('/payment', 'PaymentController@index');
Route::get('/process-payment', 'PaymentController@processPayment');
