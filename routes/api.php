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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
