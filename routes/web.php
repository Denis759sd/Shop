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
Route::get('/', 'App\Http\Controllers\HomeController@index');

/*
 * ProductController
 */
Route::get('/{category}', 'App\Http\Controllers\ProductController@showCategory')->name('ShowCategory');
Route::get('/category/{product_id}', 'App\Http\Controllers\ProductController@show')->name('ShowProduct');

