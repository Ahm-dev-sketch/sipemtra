<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Route::get('/', function () {
//    return view('welcome');
//})
// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

