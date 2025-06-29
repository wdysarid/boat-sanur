<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KapalController;
use App\Http\Controllers\Api\TiketController;
use App\Http\Controllers\api\JadwalController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\PenumpangController;
use App\Http\Controllers\Api\PembayaranController;

Route::get('user', [AuthController::class, 'getUser']); // buat test aja ini

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login')
    ->middleware('web');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Protected Routes
// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/dashboard', [AuthController::class, 'profile']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);
// });

// Kapal (Boat) Routes
Route::prefix('kapal')->group(function () {
    Route::get('/', [KapalController::class, 'getKapal']);
    Route::post('/', [KapalController::class, 'tambahKapal']);
    Route::get('/{id}', [KapalController::class, 'getKapalById']);
    Route::put('/{id}', [KapalController::class, 'updateKapal']);
    Route::patch('/{id}', [KapalController::class, 'updateKapal']);
    Route::post('/{id}', [KapalController::class, 'updateKapal']); // Alternative for file uploads
    Route::delete('/{id}', [KapalController::class, 'deleteKapal']);
});

// Jadwal (Schedule) Routes
Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'getJadwal']);
    Route::post('/', [JadwalController::class, 'tambahJadwal']);
    Route::get('/{id}', [JadwalController::class, 'getJadwalById']);
    Route::put('/{id}', [JadwalController::class, 'updateJadwal']);
    Route::patch('/{id}', [JadwalController::class, 'updateJadwal']);
    Route::delete('/{id}', [JadwalController::class, 'deleteJadwal']);
    Route::post('/{id}/complete', [JadwalController::class, 'completeSchedule']);
});

// Tiket (Ticket) Routes
Route::prefix('tiket')->middleware(['web', 'auth'])->group(function () {
    Route::post('/', [TiketController::class, 'pesanTiket']);
    Route::get('/', [TiketController::class, 'getTiketSaya']);
    Route::get('/{id}', [TiketController::class, 'getTiketDetail']);
    Route::post('/{id}/batal', [TiketController::class, 'batalkanTiket'])->name('api.tiket.batal');
    Route::get('/status/{status}', [TiketController::class, 'getTiketByStatus']);

    Route::prefix('/{tiket}/penumpang')->group(function () {
        Route::post('/', [PenumpangController::class, 'store']);
    });
});

// Penumpang Routes
Route::prefix('penumpang')->group(function () {
        // Route::post('/', [PenumpangController::class, 'store']);
        Route::get('/tiket/{tiket_id}', [PenumpangController::class, 'show']);
        Route::post('/checkin', [PenumpangController::class, 'checkInPenumpang']);
        Route::get('/all', [PenumpangController::class, 'getAllPenumpang']);
        Route::get('/{id}', [PenumpangController::class, 'getDetailPenumpang']);
    });

// Pembayaran (Payment) Routes
Route::prefix('pembayaran')->middleware(['web', 'auth'])->group(function () {
    // User routes
    Route::post('/', [PembayaranController::class, 'uploadBuktiBayar']);
    Route::get('/', [PembayaranController::class, 'getRiwayatPembayaran']);
    Route::get('/{id}', [PembayaranController::class, 'getPaymentDetail']);
    Route::post('/batal', [PembayaranController::class, 'cancelPayment'])->name('pembayaran.batal');

    // Admin routes
    Route::post('/{id}/verifikasi', [PembayaranController::class, 'verifikasiPembayaran']);
});

// Feedback Routes
Route::prefix('feedback')->group(function () {
    // Public routes
    Route::get('/', [FeedbackController::class, 'getFeedback']);

    // User routes (protected)
    Route::middleware(['web', 'auth'])->group(function () {
        Route::post('/', [FeedbackController::class, 'tambahFeedback'])->name('api.feedback.tambah');
        Route::get('/saya', [FeedbackController::class, 'getFeedbackSaya']);
        Route::put('/{id}', [FeedbackController::class, 'updateFeedback']);
        Route::delete('/{id}', [FeedbackController::class, 'deleteFeedback']);
    });

    // Admin routes
    Route::get('/semua', [FeedbackController::class, 'getSemuaFeedback']);
    Route::post('/{id}/{action}', [FeedbackController::class, 'handleStatus'])
        ->where('action', 'approve|reject')
        ->name('feedback.handle-status');
    Route::delete('/admin/{id}', [FeedbackController::class, 'hapusFeedback']);
});
