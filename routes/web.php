<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::inertia('login', 'Login')->name('login');
Route::inertia('register', 'Register')->name('Register');

Route::middleware(Authenticate::class)->group(function (): void {
    Route::get('/', function () {
        return 'hey buddy!';
    });
});
