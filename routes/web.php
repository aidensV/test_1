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


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {

Route::get('/home', function () {
    return view('menu');
});
Route::get('get_harga_barang/{id}','salesController@get_harga_barang');
Route::get('get_unit_barang/{id}','salesController@get_unit_barang');
Route::get('get_data_barang/{id}','salesController@get_data_barang')->name('get_data_barang');
Route::get('cek_item/{barang}/{unit}','salesController@cek_item');
Route::get('cek_qty/{qty}/{owner}','StockController@cek_qty');
Route::get('data_user','UserController@listData')->name('data_user');
Route::PATCH('master_user_change_password/{id}','UserController@update_password');
Route::post('update_qty','OrderController@update_qty')->name('update_qty');
Route::post('update_unit','OrderController@update_unit')->name('update_unit');
Route::post('update_status_order','OrderController@update_status_order')->name('update_status_order');
Route::post('kurangi_stock','StockController@kurangi_stock');
Route::post('tambahi_stock','StockController@tambahi_stock');

Route::resource('data_unit','UnitController');
Route::resource('data_owner','OwnerController');
Route::resource('data_item','ItemController');
Route::resource('data_stock','StockController');
Route::resource('sales','salesController');
Route::resource('distribution','StockDistributionController');
Route::resource('master_user','UserController');
Route::resource('order','OrderController');
});
