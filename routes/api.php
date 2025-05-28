<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KapalController;
use App\Http\Controllers\api\UserController;

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
