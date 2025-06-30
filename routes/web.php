<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TiketPdfController;
use App\Http\Controllers\Api\TiketController;
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
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    $email = request()->query('email');
    $user = User::where('email', $email)
                ->where('reset_token', $token)
                ->first();

    if (!$user) {
        return redirect()->route('password.request')
                         ->with('error', 'Token tidak valid atau sudah kadaluarsa');
    }

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $email,
        'user' => $user // Pastikan user dikirim ke view
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Auth actions
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Search
Route::get('/search', [JadwalController::class, 'search'])->name('search.tickets');

// FITUR BARU: Route khusus untuk booking redirect (sebelum group wisatawan)
// Route ini akan handle user yang belum login saat ingin booking tiket
Route::get('/pemesanan', function (Request $request) {
    if (!auth()->check()) {
        // FITUR BARU: Simpan booking intent dengan key spesifik untuk booking
        session([
            'booking_intent' => [
                'jadwal_id' => $request->get('jadwal_id'),
                'from' => $request->get('from'),
                'to' => $request->get('to'),
                'departure_date' => $request->get('departure_date'),
                'passenger_count' => $request->get('passenger_count', 1),
                'passenger_type' => $request->get('passenger_type', 'domestic'),
            ],
            'url.intended' => route('wisatawan.pemesanan'),
        ]);

        return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu untuk melanjutkan pemesanan.');
    }

    return redirect()->route('wisatawan.pemesanan', $request->all());
})->name('pemesanan.guest');

// FITUR BARU: Route alternatif untuk book ticket (opsional)
Route::get('/book-ticket', function (Request $request) {
    if (!auth()->check()) {
        // FITUR BARU: Simpan data booking dengan key yang spesifik
        session([
            'booking_intent' => [
                'jadwal_id' => $request->get('jadwal_id'),
                'from' => $request->get('from'),
                'to' => $request->get('to'),
                'departure_date' => $request->get('departure_date'),
                'passenger_count' => $request->get('passenger_count', 1),
                'passenger_type' => $request->get('passenger_type', 'domestic'),
            ],
            'url.intended' => route('wisatawan.pemesanan'),
        ]);

        return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu untuk melanjutkan pemesanan.');
    }

    return redirect()->route('wisatawan.pemesanan', $request->all());
})->name('book.ticket');

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

        Route::get('/payments/data', [AdminController::class, 'getPaymentData'])->name('payments.data');

        Route::get('/passengers', [AdminController::class, 'indexPassengers'])->name('passengers');
        Route::get('/passengers/data', [AdminController::class, 'getPassengerData'])->name('passengers.data');
        Route::get('/passengers/{id}', [AdminController::class, 'showPassenger'])->name('passengers.show');
        Route::get('/passengers/{id}/detail', [AdminController::class, 'getPassengerDetail'])->name('passengers.detail');
        Route::post('/passengers/checkin', [AdminController::class, 'checkInPassenger'])->name('passengers.checkin');
        Route::get('/jadwal-options', [AdminController::class, 'getJadwalOptions'])->name('jadwal.options');

        Route::get('/show', function () {
            return view('admin.show');
        })->name('show');

        Route::get('/feedback', [AdminController::class, 'indexFeedback'])->name('feedback');
        Route::get('/feedback/data', [AdminController::class, 'getFeedbackData'])->name('feedback.data');

        // FIXED: PDF routes untuk admin
        Route::get('/tiket/{id}/pdf', [TiketPdfController::class, 'generateAdminPdf'])->name('tiket.pdf');

        // QR Code generation route
        Route::get('/qr-code/generate', [AdminController::class, 'generateQrCode'])->name('qr.generate');

        // Jadwal options
        Route::get('/jadwal-options', [AdminController::class, 'getJadwalOptions'])->name('jadwal.options');
    });

// ========== USER ROUTES (PROTECTED) ==========
Route::middleware(['auth.role:wisatawan', 'verified.email'])
    ->prefix('wisatawan')
    ->name('wisatawan.')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        Route::get('/pemesanan', [UserController::class, 'pemesanan'])->name('pemesanan');
        Route::post('/pemesanan/proses', [UserController::class, 'prosesPemesanan'])->name('pemesanan.proses');

        Route::get('/pembayaran', [UserController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/pembayaran/proses', [UserController::class, 'prosesPembayaran'])->name('pembayaran.proses');

        Route::get('/konfirmasi', [UserController::class, 'konfirmasi'])->name('konfirmasi');

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

        Route::get('/tiket', [UserController::class, 'tiketSaya'])->name('tiket');
        Route::get('/tiket/status/{status}', [UserController::class, 'getTiketByStatus'])->name('tiket.status');
        Route::get('/tiket/{id}', [UserController::class, 'showTiket'])->name('tiket.show');
        Route::get('/tiket/{id}/detail', [UserController::class, 'getTiketDetail'])->name('tiket.detail');

        Route::get('/feedback', function () {
            return view('wisatawan.feedback');
        })->name('feedback');

        Route::post('/feedback/tambah', [UserController::class, 'tambahFeedback'])->name('feedback.tambah');

        Route::get('/tiket/{id}/pdf', [TiketPdfController::class, 'generatePdf'])->name('tiket.pdf');
        Route::get('/tiket/{id}/preview', [TiketPdfController::class, 'previewPdf'])->name('tiket.preview');
        // PDF Routes
        Route::get('/tiket/{tiket}/pdf', [TiketPdfController::class, 'generatePdf'])->name('tiket.pdf');
        Route::get('/tiket/{tiket}/preview', [TiketPdfController::class, 'previewPdf'])->name('tiket.preview');
        Route::post('/tiket/{id}/batal', [UserController::class, 'batalkanTiket'])->name('tiket.batal');
    });

Route::prefix('api')
    ->middleware(['web'])
    ->group(function () {
        // Penumpang check-in (for admin scanner)
        Route::post('/penumpang/checkin', [\App\Http\Controllers\Api\PenumpangController::class, 'checkInPenumpang']);
    });
