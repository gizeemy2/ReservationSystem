<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController; // <- Admin/Auth altında
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\ReservationsController;
use App\Http\Controllers\Admin\PaymentsController;


// Opsiyonel ana sayfa
Route::get('/', fn () => view('welcome'));

// ---------------- GİRİŞ YAPMAMIŞLAR (guest) ----------------
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('login',  [AuthController::class, 'showLoginForm'])->name('login');      // admin.login
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// ---------------- GİRİŞ YAPANLAR (auth) ----------------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// ---------------- CORE auth 'login' alias fix ----------------
// Laravel'in kendi auth middleware'i 'login' adını aradığı için
// /login rotasını admin.login'e yönlendiriyoruz.
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // ... mevcut dashboard & logout rotaların

    Route::resource('customers', CustomersController::class)->except(['show']);
    Route::resource('suppliers', SuppliersController::class)->except(['show']);
    Route::resource('reservations', ReservationsController::class)->except(['show']);
    Route::resource('payments', PaymentsController::class)->except(['show']);
});
