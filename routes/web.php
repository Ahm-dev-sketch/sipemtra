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

use App\Http\Controllers\ScheduleController;

Route::middleware(['auth'])->group(function () {
    // Routes untuk admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('schedules', ScheduleController::class);
    });
});

