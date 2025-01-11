<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('/', [LoginController::class, 'show'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login.perform', [LoginController::class, 'login'])->name('login.perform');
Route::post('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
Route::post('/reset-password.send', [ResetPassword::class, 'send'])->name('reset-password.send');
Route::post('/reset-password.reset', [RegisterController::class, 'reset'])->name('reset-password.reset');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
