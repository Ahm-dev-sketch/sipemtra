<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('landing');
});

use App\Http\Controllers\JadwalController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('jadwal', JadwalController::class);
});

