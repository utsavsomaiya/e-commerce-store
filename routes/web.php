<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware(RedirectIfAuthenticated::class)
    ->group(function (): void {
        Route::inertia('login', 'Auth/Login')->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::inertia('register', 'Auth/Register')->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
    });

Route::middleware(Authenticate::class)
    ->group(function (): void {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::inertia('/', 'Dashboard')->name('dashboard');
    });
