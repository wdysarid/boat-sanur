<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\FeedbackController;

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

// ========== TAMBAHAN GOOGLE OAUTH ROUTES ==========
// Web Authentication Routes
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');

// Google OAuth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
// ========== END GOOGLE OAUTH ROUTES ==========

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

    Route::get('/feedback', [AdminController::class, 'indexFeedback'])->name('feedback');
    Route::get('/feedback/data', [AdminController::class, 'getFeedbackData'])->name('feedback.data');

});

//User Views - data will be fetched from API
Route::middleware(['auth', 'role:wisatawan'])->prefix('wisatawan')->name('wisatawan.')->group(function () {
    Route::get('/dashboard', function () {
        return view('wisatawan.dashboard');
    })->name('dashboard');

    Route::get('/pemesanan', function () {
        return view('wisatawan.pemesanan');
    })->name('pemesanan');

    Route::get('/pembayaran', function () {
        return view('wisatawan.pembayaran');
    })->name('pembayaran');

    Route::get('/konfirmasi', function () {
        return view('wisatawan.konfirmasi');
    })->name('konfirmasi');

    Route::get('/profile', function () {
        return view('wisatawan.profile');
    })->name('profile');

    Route::get('/profile/edit', function () {
        return view('wisatawan.edit-profile');
    })->name('profile.edit');

    Route::get('/profile/ubah-password', function () {
        return view('wisatawan.ubah-password');
    })->name('profile.change-password');

    Route::get('/tiket', function () {
        return view('wisatawan.tiket');
    })->name('tiket');

     Route::post('/feedback/tambah', [UserController::class, 'tambahFeedback'])
        ->name('feedback.tambah');
});

