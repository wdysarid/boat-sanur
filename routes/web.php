<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
    return view('search.tickets');
});

// Admin Views - Only for rendering views, data will be fetched from API
// Route::prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard View
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Schedule View
    Route::get('/schedule', function () {
        return view('admin.schedule');
    })->name('schedule');

    // Boats and Tickets View
    Route::get('/boats', [AdminController::class,'indexKapal'])->name('boats');

    // Payments View
    Route::get('/payments', function () {
        return view('admin.payments');
    })->name('payments');

    // Destinations View
    Route::get('/destinations', function () {
        return view('admin.destinations');
    })->name('destinations');

    // Feedback View
    Route::get('/feedback', function () {
        return view('admin.feedback');
    })->name('feedback');
});

//User Views - data will be fetched from API
Route::middleware(['auth', 'role:wisatawan'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/pemesanan', function () {
        return view('user.pemesanan');
    })->name('pemesanan');
});


Route::post('/kapal', [AdminController::class,'storeKapal']);
Route::get('/kapal/{id}/edit', [AdminController::class,'editKapal']);
