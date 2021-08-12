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

/*
 * HomeController
 */
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('Home');

/*
 * ProductController
 */
Route::get('/category/{category}', 'App\Http\Controllers\ProductController@showCategory')->name('ShowCategory');
Route::get('/category/{category}/{product_id}', 'App\Http\Controllers\ProductController@show')->name('ShowProduct');

/*
 * CartController
*/
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('CartIndex');
Route::post('/add-to-cart', 'App\Http\Controllers\CartController@addToCart')->name('AddToCart');
Route::get('/clear-cart', 'App\Http\Controllers\CartController@clear')->name('ClearCart');
