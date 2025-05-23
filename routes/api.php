<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('/user',UserController::class);

Route::get('user', [AuthController::class, 'getUser']); // buat test aja ini

<<<<<<< Updated upstream
<<<<<<< Updated upstream
// Route publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Route dengan token valid
=======
// Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Hanya bisa diakses dengan token valid
>>>>>>> Stashed changes
=======
// Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Hanya bisa diakses dengan token valid
>>>>>>> Stashed changes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);
<<<<<<< Updated upstream
<<<<<<< Updated upstream
});
=======
=======
>>>>>>> Stashed changes
    
    // Ganti password
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
<<<<<<< Updated upstream
});
>>>>>>> Stashed changes
=======
});
>>>>>>> Stashed changes
