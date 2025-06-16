<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KapalController;
use App\Http\Controllers\Api\TiketController;
use App\Http\Controllers\api\JadwalController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\PembayaranController;

// TAMBAHAN: Import controller untuk web feedback
use App\Http\Controllers\FeedbackController as WebFeedbackController;

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
    Route::get('/profile', [AuthController::class, 'profile']);
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
    Route::post('/', [JadwalController::class, 'tambahJadwal']); //->middleware('auth:sanctum');
    Route::get('/{id}', [JadwalController::class, 'getJadwalById']);
    Route::put('/{id}', [JadwalController::class, 'updateJadwal']); //->middleware('auth:sanctum');
    Route::patch('/{id}', [JadwalController::class, 'updateJadwal']); //->middleware('auth:sanctum');
    Route::delete('/{id}', [JadwalController::class, 'deleteJadwal']); //->middleware('auth:sanctum');
    Route::post('/{id}/complete', [JadwalController::class, 'completeSchedule']); //->middleware('auth:sanctum');
});

// Tiket (Ticket) Routes
// Route::prefix('tiket')->middleware('auth:sanctum')->group(function () {
Route::prefix('tiket')->group(function () {
    Route::post('/', [TiketController::class, 'pesanTiket']);
    Route::get('/', [TiketController::class, 'getTiketSaya']);
    Route::get('/{id}', [TiketController::class, 'getTiketDetail']);
    Route::post('/{id}/batal', [TiketController::class, 'batalkanTiket']);
});

// Pembayaran (Payment) Routes
// Route::prefix('pembayaran')->middleware('auth:sanctum')->group(function () {
Route::prefix('pembayaran')->group(function () {
    // User routes
    Route::post('/', [PembayaranController::class, 'uploadBuktiBayar']);
    Route::get('/', [PembayaranController::class, 'getRiwayatPembayaran']);
    Route::get('/{id}', [PembayaranController::class, 'getDetailPembayaran']);

    // Admin routes
    Route::middleware('can:admin')->group(function () {
        Route::post('/{id}/verifikasi', [PembayaranController::class, 'verifikasiPembayaran']);
    });
});

// Feedback Routes
Route::prefix('feedback')->group(function () {
    // Public routes - MODIFIKASI: Gunakan WebFeedbackController untuk konsistensi
    Route::get('/', [FeedbackController::class, 'getFeedback']);

    // TAMBAHAN: Route untuk user feedback management (dari halaman feedback.blade.php)
    Route::middleware(['web', 'auth'])->group(function () {
        Route::get('/saya', [FeedbackController::class, 'getUserFeedback']);
        Route::put('/{id}', [FeedbackController::class, 'update']);
        Route::delete('/{id}', [FeedbackController::class, 'destroy']);
    });

    // User routes (protected) - PERBAIKAN: Gunakan web middleware untuk session auth
    Route::middleware(['web', 'auth'])->group(function () {
        Route::post('/', [FeedbackController::class, 'tambahFeedback'])->name('api.feedback.tambah');
        Route::get('/saya', [FeedbackController::class, 'getFeedbackSaya']);

        // PERBAIKAN: Route yang benar untuk update dan delete
        Route::put('/{id}', [FeedbackController::class, 'updateFeedback']);
        Route::delete('/{id}', [FeedbackController::class, 'deleteFeedback']);
    });

    // Admin routes (protected)
    // Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
    Route::get('/semua', [FeedbackController::class, 'getSemuaFeedback']);
    Route::post('/{id}/{action}', [FeedbackController::class, 'handleStatus'])
        ->where('action', 'approve|reject')
        ->name('feedback.handle-status');
    Route::delete('/admin/{id}', [FeedbackController::class, 'hapusFeedback']); // Beda route untuk admin delete
    // });
});
