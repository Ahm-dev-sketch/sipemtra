<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

Route::get('/', function () {
    $user = Auth::user();
    return view('user.home', ['firstName' => $user ? $user->name : '']);
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/verify', [AuthController::class, 'showRegisterVerify'])->name('register.verify');
Route::post('/register/verify', [AuthController::class, 'verifyRegisterOtp'])->name('register.verify.submit');

Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
Route::put('/bookings/{booking}', [AdminController::class, 'updateBooking'])->name('bookings.update');

Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
Route::get('/pelanggan/create', [AdminController::class, 'createPelanggan'])->name('pelanggan.create');
Route::post('/pelanggan', [AdminController::class, 'storePelanggan'])->name('pelanggan.store');
Route::get('/pelanggan/{customer}/edit', [AdminController::class, 'editPelanggan'])->name('pelanggan.edit');
Route::put('/pelanggan/{customer}', [AdminController::class, 'updatePelanggan'])->name('pelanggan.update');
Route::delete('/pelanggan/{customer}', [AdminController::class, 'destroyPelanggan'])->name('pelanggan.destroy');

// Jadwal routes
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::get('/jadwal/{jadwal}/seats', [JadwalController::class, 'getBookedSeats']);

// Booking routes
Route::middleware('auth')->group(function () {
    Route::get('/pesan-tiket', [BookingController::class, 'step1'])->name('pesan');
    Route::post('/pesan-tiket/step1', [BookingController::class, 'processStep1']);
    Route::get('/pesan-tiket/step2', [BookingController::class, 'step2']);
    Route::post('/pesan-tiket/step2', [BookingController::class, 'processStep2']);
    Route::get('/pesan-tiket/step3', [BookingController::class, 'step3']);
    Route::post('/pesan-tiket/step3', [BookingController::class, 'processStep3']);
    Route::get('/riwayat', [BookingController::class, 'riwayat'])->name('riwayat');
    Route::patch('/booking/{booking}/status', [BookingController::class, 'updateBookingStatus']);
});
