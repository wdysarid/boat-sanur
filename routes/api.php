<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KapalController;
use App\Http\Controllers\Api\TiketController;
use App\Http\Controllers\api\JadwalController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\PembayaranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('/user',UserController::class);

Route::get('user', [AuthController::class, 'getUser']); // buat test aja ini

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('api.login')->middleware('web');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);
});

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
    // Public routes
    Route::get('/', [FeedbackController::class, 'getFeedbackDisetujui']);

    // User routes (protected)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [FeedbackController::class, 'tambahFeedback']);
        Route::get('/saya', [FeedbackController::class, 'getFeedbackSaya']);
    });

    // Admin routes (protected)
    Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
        Route::get('/semua', [FeedbackController::class, 'getSemuaFeedback']);
        Route::post('/{id}/setujui', [FeedbackController::class, 'setujuiFeedback']);
        Route::delete('/{id}', [FeedbackController::class, 'hapusFeedback']);
    });
});
