<?php

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


// Redirect root to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Admin Schedule
Route::get('/admin/schedule', function () {
    return view('admin.schedule');
})->name('admin.schedule');

// Admin Boats and Tickets
Route::get('/admin/boats', function () {
    return view('admin.boats');
})->name('admin.boats');

// Admin Payments
Route::get('/admin/payments', function () {
    return view('admin.payments');
})->name('admin.payments');

// Admin Destinations
Route::get('/admin/destinations', function () {
    return view('admin.destinations');
})->name('admin.destinations');

// Admin Feedback
Route::get('/admin/feedback', function () {
    return view('admin.feedback');
})->name('admin.feedback');

// // Admin Views - Only for rendering views, data will be fetched from API
// Route::prefix('admin')->name('admin.')->group(function () {
//     // Dashboard View
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     // Schedule View
//     Route::get('/schedule', function () {
//         return view('admin.schedule');
//     })->name('schedule');

//     // Boats and Tickets View
//     Route::get('/boats', function () {
//         return view('admin.boats');
//     })->name('boats');

//     // Payments View
//     Route::get('/payments', function () {
//         return view('admin.payments');
//     })->name('payments');

//     // Destinations View
//     Route::get('/destinations', function () {
//         return view('admin.destinations');
//     })->name('destinations');

//     // Feedback View
//     Route::get('/feedback', function () {
//         return view('admin.feedback');
//     })->name('feedback');
// });

