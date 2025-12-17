<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\app\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HeroSectionController;


// ############################## Auth Routes ################################### //
    Route::prefix('auth')->group(function () {
        Route::get('/login-form', [AuthController::class, 'loginForm'])->name('loginform');
        Route::post('/login'    , [AuthController::class, 'login'])->name('login');
        Route::post('/logout'   , [AuthController::class, 'logout'])->name('logout');
    });

