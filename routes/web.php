<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    return view('user.home', ['firstName' => $user ? $user->name : '']);
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/verify', [AuthController::class, 'showRegisterVerify'])->name('register.verify');
Route::post('/register/verify', [AuthController::class, 'verifyRegisterOtp'])->name('register.verify.submit');
