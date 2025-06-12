<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\JadwalController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');


Route::get('/search', function () {
    return view('search-tickets');
});

// web.php
Route::get('/search', [JadwalController::class, 'search'])->name('search.tickets');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Views - Only for rendering views, data will be fetched from API
// Route::prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard View
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Schedule View
    Route::get('/schedule', [AdminController::class, 'indexSchedule'])->name('schedule');

    // Boats and Tickets View
    Route::get('/boats', [AdminController::class,'indexKapal'])->name('boats');

    // Payments View
    Route::get('/payments', function () {
        return view('admin.payments');
    })->name('payments');

    // Feedback View
    Route::get('/feedback', function () {
        return view('admin.feedback');
    })->name('feedback');
});

//User Views - data will be fetched from API
Route::middleware(['auth', 'role:wisatawan'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/pemesanan', function () {
        return view('user.pemesanan');
    })->name('pemesanan');

    Route::get('/pembayaran', function () {
        return view('user.pembayaran');
    })->name('pembayaran');

    Route::get('/konfirmasi', function () {
        return view('user.konfirmasi');
    })->name('konfirmasi');
});


Route::post('/kapal', [AdminController::class,'storeKapal']);
Route::get('/kapal/{id}/edit', [AdminController::class,'editKapal']);
