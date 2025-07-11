<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('Pages.Homepage');
});

Route::get('/Login', function () {
    return view('Pages.Login');
});

Route::get('/SignUp', function () {
    return view('Pages.SignUp');
});
Route::get('/About', function () {
    return view('Pages.About');
});
Route::get('/Setting', function () {
    return view('Pages.Users.Setting');
});
Route::get('/Help', function () {
    return view('Pages.Users.Help');
});
Route::get('/Edit', function () {
    return view('Pages.Users.Edit');
});
Route::get('/Orders', function () {
    return view('Pages.Users.Orders');
});
Route::get('/Profile', function () {
    return view('Pages.Users.Profile');
});
Route::get('/NewPass', function () {
    return view('Pages.NewPas');
});

Route::get('/Forgoten', function () {
    return view('Pages.Forgoten');
});
Route::get('/Dashboard', function () {
    return view('Dashboards.Dashboard');
});



Route::get('/DetailRoom', function (Request $request) {
    $RoomId = $request->query('RoomId');
    return view('Pages.DetailRoom');
})->name('DetailRooms');
Route::get('/DetailService', function (Request $request) {
    $ServiceId = $request->query('ServiceId');
    return view('Pages.DetailService');
})->name('DetailService');

Route::get('/Service', function () {
    return view('Pages.Service');
});
Route::get('/Rooms', function () {
    return view('Pages.Rooms');
});

Route::get('/Reserve', function () {
    return view('Pages.Reservation');
});

Route::get('/Booking', function () {
    return view('Pages.Booking');
});

Route::get('/User', function () {
    return view('Dashboards.User');
});

Route::get('/BookingDashboard', function () {
    return view('Dashboards.Booking');
});

Route::get('/Pemesanan', function () {
    return view('Dashboards.Pemesanan');
});

Route::get('/Kamar', function () {
    return view('Dashboards.Kamar');
});
Route::get('/JenisKamar', function () {
    return view('Dashboards.JenisKamar');
});
Route::get('/ServiceDashboard', function () {
    return view('Dashboards.Service');
});
Route::get('/Fasilitas', function () {
    return view('Dashboards.Fasilitas');
});
Route::get('/Gallery', function () {
    return view('Dashboards.Gallery');
});