<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_home;
use App\Http\Controllers\C_customer;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_toko;
use App\Http\Controllers\API\C_buku;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\C_scoreboard;

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

Route::get('/test',[C_home::class,'index3']);
Route::get('/',[C_home::class,'index']);
Route::get('/h2', [C_home::class, 'index2'])->name('home2');

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect',[LoginController::class,'redirectToProvider']);
Route::get('/auth/callback',[LoginController::class,'handleProviderCallback']);


Route::get('/scoreboard',[C_scoreboard::class,'index']);
Route::get('/scoreboard-sse',[C_scoreboard::class,'sse']);
Route::get('/console',[C_scoreboard::class,'console']);
Route::post('/scoreboard-console/update-period',[C_scoreboard::class,'updatePeriod']);
Route::post('/scoreboard-console/reset-period',[C_scoreboard::class,'resetPeriod']);
Route::post('/scoreboard-console/update-home-name',[C_scoreboard::class,'updateHomeName']);
Route::post('/scoreboard-console/update-home-score',[C_scoreboard::class,'updateHomeScore']);
Route::post('/scoreboard-console/reset-home-score',[C_scoreboard::class,'resetHomeScore']);
Route::post('/scoreboard-console/update-home-foul',[C_scoreboard::class,'updateHomeFoul']);
Route::post('/scoreboard-console/reset-home-foul',[C_scoreboard::class,'resetHomeFoul']);
Route::post('/scoreboard-console/update-away-name',[C_scoreboard::class,'updateAwayName']);
Route::post('/scoreboard-console/update-away-score',[C_scoreboard::class,'updateAwayScore']);
Route::post('/scoreboard-console/reset-away-score',[C_scoreboard::class,'resetAwayScore']);
Route::post('/scoreboard-console/update-away-foul',[C_scoreboard::class,'updateAwayFoul']);
Route::post('/scoreboard-console/reset-away-foul',[C_scoreboard::class,'resetAwayFoul']);
Route::post('/scoreboard-console/update-home-status',[C_scoreboard::class,'updateHomeStatus']);
Route::post('/scoreboard-console/update-timer',[C_scoreboard::class,'updateTimer']);
Route::post('/update-menit-detik',[C_scoreboard::class,'update_menit_detik']);
