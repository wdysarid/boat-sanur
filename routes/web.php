<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('landing');
});

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');




Route::get('/', function () {
    return view('landing'); // Mengarah ke resources/views/landing.blade.php
});



