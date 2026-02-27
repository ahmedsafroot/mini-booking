<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('hotels', HotelController::class);

    Route::resource('rooms', RoomController::class)
        ->only(['index', 'create', 'store', 'destroy']);

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search.index');

    Route::post('/search', [SearchController::class, 'search'])
        ->name('search.perform');
});
