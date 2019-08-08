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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/detail/{id}', 'HomeController@detail');
Route::post('/home/detail/stores', 'HomeController@stores');
Route::get('/home/autocomplete', 'HomeController@autocomplete');
//profile
Route::get('/profile', 'ProfileController@index');
Route::get('/profile/{id}/edit', 'ProfileController@edit');
Route::put('/profile/{id}/update', 'ProfileController@update');
//kategori
Route::get('/admin/kategori', 'KategoriController@index');
Route::post('/admin/kategori/stores', 'KategoriController@stores');
Route::get('/admin/kategori/{id}/edit', 'KategoriController@edit');
Route::put('/admin/kategori/{id}/update', 'KategoriController@update');
Route::get('/admin/kategori/hapus/{id}', 'KategoriController@hapus');
//barang
Route::get('/admin/barang', 'BarangController@index');
Route::post('/admin/barang/stores', 'BarangController@stores');
Route::get('/admin/barang/{id}/edit', 'BarangController@edit');
Route::put('/admin/barang/{id}/update', 'BarangController@update');
Route::get('/admin/barang/hapus/{id}', 'BarangController@hapus');
//cart
Route::get('/cart', 'CartController@index');
Route::get('/cart/hapus/{id}', 'CartController@hapus');
Route::get('/cart/process', 'CartController@process');
//transaksi
Route::get('/transaction/stores', 'TransactionController@stores');
Route::get('/transaction', 'TransactionController@index');
Route::get('/transaction/accept/{id}', 'TransactionController@accept');
Route::get('/transaction/received/{id}', 'TransactionController@received');
//report
Route::get('/admin/laporan', 'ReportController@index');
Route::get('/admin/laporan/detail/{id}', 'ReportController@detail');

