<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\JenisKamarController;
use App\Http\Controllers\JenisServiceController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KamarFasilitasController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/JenisKamar', [JenisKamarController::class, 'index']);
Route::get('/JenisKamar/all', [JenisKamarController::class, 'getData']);
Route::get('/JenisKamar/{id}', [JenisKamarController::class, 'show']);

Route::get('/Kamar', [KamarController::class, 'index']);
Route::get('/Kamar/all', [KamarController::class, 'getData']);
Route::get('/Kamar/{id}', [KamarController::class, 'show']);

Route::get('/Fasilitas', [FasilitasController::class, 'index']);
Route::get('/Fasilitas/all', [FasilitasController::class, 'getData']);
Route::get('/Fasilitas/{id}', [FasilitasController::class, 'show']);

Route::get('/Booking', [BookingController::class, 'index']);
Route::get('/Booking/all', [BookingController::class, 'getData']);
Route::get('/Booking/Count', [BookingController::class, 'countBooking']);
Route::get('/Booking/{id}', [BookingController::class, 'show']);

Route::get('/Galery/{id}', [GaleryController::class, 'show']);
Route::get('/Galery/Data/{id}', [GaleryController::class, 'showServiceOrRoom']);
Route::get('/Galery', [GaleryController::class, 'index']);
Route::get('/Galery/all', [GaleryController::class, 'getData']);

Route::get('/JenisService', [JenisServiceController::class, 'index']);
Route::get('/JenisService/all', [JenisServiceController::class, 'getData']);
Route::get('/JenisService/{id}', [JenisServiceController::class, 'show']);

Route::get('/Pemesanan', [PemesananController::class, 'index']);
Route::get('/Pemesanan/all', [PemesananController::class, 'getData']);
Route::get('/Pemesanan/Count', [PemesananController::class, 'countPesanan']);
Route::get('/Pemesanan/{id}', [PemesananController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/EditUser', [UserController::class, 'update']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/BookingPesanan', [BookingController::class, 'getCombinedData']);
    Route::get('/User/BookingPesanan', [BookingController::class, 'getCombinedDataUser']);
    Route::get('/Booking/User/Count', [BookingController::class, 'countBookingByUser']);
    //Booking

    Route::post('/Booking', [BookingController::class, 'store']);
    Route::post('/Booking/dashboard', [BookingController::class, 'storeDashboard']);

    Route::post('/Booking/{id}', [BookingController::class, 'update']);
    Route::post('/Booking/dashboard/{id}', [BookingController::class, 'updateDashboard']);
    Route::get('/Booking/user/{id}', [BookingController::class, 'showBookingbyUser']);
    Route::get('/Booking/user', [BookingController::class, 'getDataByUserId']);
    Route::delete('/Booking/{id}', [BookingController::class, 'destroy']);
    //Fasilitas

    Route::post('/Fasilitas', [FasilitasController::class, 'store']);
    Route::post('/Fasilitas/{id}', [FasilitasController::class, 'update']);
    Route::get('/Fasilitas/user/{id}', [FasilitasController::class, 'showFasilitasbyUser']);
    Route::delete('/Fasilitas/{id}', [FasilitasController::class, 'destroy']);
    //Galery

    Route::post('/Galery', [GaleryController::class, 'store']);

    Route::post('/Galery/{id}', [GaleryController::class, 'update']);
    Route::get('/Galery/user/{id}', [GaleryController::class, 'showGalerybyUser']);
    Route::delete('/Galery/{id}', [GaleryController::class, 'destroy']);
    //JenisKamar
    Route::post('/JenisKamar/addFasilitas', [KamarFasilitasController::class, 'store']);

    Route::post('/JenisKamar', [JenisKamarController::class, 'store']);
    Route::post('/JenisKamar/{id}', [JenisKamarController::class, 'update']);
    Route::get('/JenisKamar/user/{id}', [JenisKamarController::class, 'showJenisKamarbyUser']);
    Route::delete('/JenisKamar/{id}', [JenisKamarController::class, 'destroy']);
    //Service

    Route::post('/JenisService', [JenisServiceController::class, 'store']);
    Route::post('/JenisService/{id}', [JenisServiceController::class, 'update']);
    Route::get('/JenisService/user/{id}', [JenisServiceController::class, 'showServicebyUser']);
    Route::delete('/JenisService/{id}', [JenisServiceController::class, 'destroy']);
    //Kamar

    Route::post('/Kamar', [KamarController::class, 'store']);
    Route::post('/Kamar/{id}', [KamarController::class, 'update']);
    Route::get('/Kamar/user/{id}', [KamarController::class, 'showKamarbyUser']);
    Route::delete('/Kamar/{id}', [KamarController::class, 'destroy']);
    //Pemesanan

    Route::post('/Pemesanan', [PemesananController::class, 'store']);
    Route::post('/Pemesanan/dashboard', [PemesananController::class, 'storeDashboard']);
    Route::post('/Pemesanan/{id}', [PemesananController::class, 'update']);
    Route::post('/Pemesanan/dashboard/{id}', [PemesananController::class, 'updateDashboard']);
    Route::get('/Pemesanan/user/{id}', [PemesananController::class, 'showPemesananbyUser']);
    Route::delete('/Pemesanan/{id}', [PemesananController::class, 'destroy']);
    Route::get('/Pemesanan/User/Count', [PemesananController::class, 'countPesananByUser']);
    Route::get('/Pemesanan/user', [PemesananController::class, 'getDataByUserId']);
    //User
    Route::get('/User', [UserController::class, 'index']);
    Route::get('/User/all', [UserController::class, 'getData']);
    Route::get('/User/Count', [UserController::class, 'countUser']);
    Route::get('/UserData', [UserController::class, 'show']);
    Route::post('/User', [UserController::class, 'store']);
    Route::post('/User/{id}', [UserController::class, 'update']);
    Route::post('/UserEditData', [UserController::class, 'edit']);
    Route::get('/User/user/{id}', [UserController::class, 'showUserbyUser']);
    Route::delete('/User/{id}', [UserController::class, 'destroy']);
});
