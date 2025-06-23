<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\FeedbackController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// ========== EMAIL VERIFICATION ROUTES ==========
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('wisatawan.dashboard')->with('success', 'Email berhasil diverifikasi! Selamat datang di Tiket Boat Sanur.');
    })
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link verifikasi telah dikirim ulang ke email Anda!');
    })
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// ========== PUBLIC ROUTES ==========
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth pages
Route::get('/login', function (Illuminate\Http\Request $request) {
    if ($request->has('intended')) {
        session(['url.intended' => $request->get('intended')]);
    }
    return view('auth.login');
})->name('login');

Route::get('/register', function (Illuminate\Http\Request $request) {
    if ($request->has('intended')) {
        session(['url.intended' => $request->get('intended')]);
    }
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Auth actions
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Search
Route::get('/search', [JadwalController::class, 'search'])->name('search.tickets');


// API routes
Route::get('/api/feedback', [FeedbackController::class, 'getFeedback']);

// Public feedback submission (requires auth)
Route::middleware(['auth'])->group(function () {
    Route::post('/feedback', [FeedbackController::class, 'storeFeedbackFromLanding'])->name('wisatawan.feedback.tambah');
});

// ========== ADMIN ROUTES (PROTECTED) ==========
Route::middleware(['auth.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/schedule', [AdminController::class, 'indexSchedule'])->name('schedule');
        Route::get('/boats', [AdminController::class, 'indexKapal'])->name('boats');

        Route::get('/payments', function () {
            return view('admin.payments');
        })->name('payments');

        Route::get('/feedback', [AdminController::class, 'indexFeedback'])->name('feedback');
        Route::get('/feedback/data', [AdminController::class, 'getFeedbackData'])->name('feedback.data');
    });

// ========== USER ROUTES (PROTECTED) ==========
Route::middleware(['auth.role:wisatawan', 'verified.email'])
    ->prefix('wisatawan')
    ->name('wisatawan.')
    ->group(function () {
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

        Route::patch('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

        // Change Password Routes
        Route::get('/profile/ubah-password', function () {
            return view('wisatawan.ubah-password');
        })->name('profile.change-password');

        Route::post('/profile/ubah-password', [UserController::class, 'changePassword'])->name('profile.change-password.post');

        Route::get('/tiket', function () {
            return view('wisatawan.tiket');
        })->name('tiket');

        Route::get('/feedback', function () {
            return view('wisatawan.feedback');
        })->name('feedback');

        Route::post('/feedback/tambah', [UserController::class, 'tambahFeedback'])->name('feedback.tambah');

        Route::get('/pemesanan', [UserController::class, 'pemesanan'])->name('pemesanan');
        Route::post('/pemesanan/proses', [UserController::class, 'prosesPemesanan'])->name('pemesanan.proses');

        Route::get('/pembayaran', [UserController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/pembayaran/proses', [UserController::class, 'prosesPembayaran'])->name('pembayaran.proses');

    });
