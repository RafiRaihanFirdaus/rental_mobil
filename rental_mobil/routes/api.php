<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');



// Mobil
Route::post('/simpan_mobil', 'MobilController@store')->middleware('jwt.verify');
Route::put('/ubah_mobil/{id}','MobilController@update')->middleware('jwt.verify');
Route::delete('/hapus_mobil/{id}','MobilController@destroy')->middleware('jwt.verify');
Route::get('/tampil_mobil','MobilController@tampil_mobil')->middleware('jwt.verify');


// Jenis Mobil
Route::post('/simpan_jenis', 'JenisMobilController@store')->middleware('jwt.verify');
Route::put('/ubah_jenis/{id}','JenisMobilController@update')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}','JenisMobilController@destroy')->middleware('jwt.verify');
Route::get('/tampil_jenis','JenisMobilController@tampil_jenis')->middleware('jwt.verify');


// Penyewa
Route::post('/simpan_penyewa', 'PenyewaController@store')->middleware('jwt.verify');
Route::put('/ubah_penyewa/{id}','PenyewaController@update')->middleware('jwt.verify');
Route::delete('/hapus_penyewa/{id}','PenyewaController@destroy')->middleware('jwt.verify');
Route::get('/tampil_penyewa','PenyewaController@tampil_penyewa')->middleware('jwt.verify');


// Transaksi
Route::post('/simpan_transaksi', 'TransaksiController@store')->middleware('jwt.verify');
Route::get('/tampil_transaksi','TransaksiController@tampil_transaksi')->middleware('jwt.verify');


// Detail
Route::post('/simpan_detail', 'DetailController@store')->middleware('jwt.verify');
Route::get('/tampil_detail','DetailController@tampil_detail')->middleware('jwt.verify');