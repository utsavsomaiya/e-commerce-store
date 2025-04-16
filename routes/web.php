<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

        Route::get('/', DashboardController::class)->name('dashboard');

        Route::prefix('products')->group(function (): void {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::put('{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::prefix('categories')->group(function (): void {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::put('{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('{category}', [CategoryController::class, 'destroy'])->name('categories.delete');
        });
    });
