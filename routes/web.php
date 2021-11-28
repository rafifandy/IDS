<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_home;
use App\Http\Controllers\C_customer;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_toko;
use App\Http\Controllers\API\C_buku;
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

Route::get('/test',[C_home::class,'index2']);
Route::get('/',[C_home::class,'index']);


//customer
Route::get('/customer',[C_customer::class,'index']);
Route::post('/customer/store',[C_customer::class,'store']);
Route::post('/customer/store2',[C_customer::class,'store2']);
Route::get('/getkabupaten',[C_customer::class,'getKabupaten']);
Route::get('/getkecamatan',[C_customer::class,'getKecamatan']);
Route::get('/getkelurahan',[C_customer::class,'getKelurahan']);

Route::get('/customer/export',[C_customer::class,'export']);
Route::post('/customer/import',[C_customer::class,'import']);


//barang
Route::get('/barang',[C_barang::class,'index']);
Route::post('/barang/store',[C_barang::class,'store']);
Route::post('/barang/cetak',[C_barang::class,'cetak']);
Route::get('/getto',[C_barang::class,'getTo']);


//toko
Route::get('/toko',[C_toko::class,'index']);
Route::post('/toko/store',[C_toko::class,'store']);
Route::get('/toko/cetak/{id}',[C_toko::class,'cetak']);
Route::post('/toko/getLocationToko',[C_toko::class,'getLocationToko']);
Route::post('/toko/hasil',[C_toko::class,'getDistanceFromLatLonInKm']);

//buku
Route::resource('/api/buku',C_buku::class);