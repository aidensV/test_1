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
    return view('menu');
});
Route::get('get_data_barang/{id}','salesController@get_data_barang');
Route::resource('data_unit','UnitController');
Route::resource('data_owner','OwnerController');
Route::resource('data_item','ItemController');
Route::resource('data_stock','StockController');
Route::resource('sales','salesController');
