<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


use App\Http\Controllers\MobileappsVer1;   
// Route::get('/', [MobileappsVer1::class, 'def']);
Route::get('/', function(){
    return 'successed';
});

Route::post('/login', [MobileappsVer1::class, 'login']);

Route::post('/get_lokasikerja_def', [MobileappsVer1::class, 'get_lokasikerja_def']);    

Route::post('/absen', [MobileappsVer1::class, 'absen']);  

Route::post('/status-absen', [MobileappsVer1::class, 'get_status_absen']);  

// Untuk Shift 3 Btn Checkout
Route::get('/last-checkin/{id_karyawan?}', [MobileappsVer1::class, 'last_checkin']);  

Route::post('/kehadiran', [MobileappsVer1::class, 'kehadiran']);  

// Cuti
Route::get('/jenis-cuti/{id_perusahaan?}', [MobileappsVer1::class, 'jenis_cuti']);  
Route::post('/pengajuan-cuti', [MobileappsVer1::class, 'pengajuan_cuti']);   
Route::get('/show-photo-img/{id?}/{field?}', [MobileappsVer1::class, 'show_photo_img']);  
 