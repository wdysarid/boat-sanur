<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\KapalController;
use App\Http\Controllers\api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('/user',UserController::class);

Route::get('user', [AuthController::class, 'getUser']); // buat test aja ini

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('web');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);
});

Route::prefix('kapal')->group(function () {
    Route::get('/', [KapalController::class, 'getKapal']);
    Route::post('/', [KapalController::class, 'tambahKapal']);
    Route::put('/{id}', [KapalController::class, 'updateKapal']);
    Route::delete('/{id}', [KapalController::class, 'deleteKapal']);
});
