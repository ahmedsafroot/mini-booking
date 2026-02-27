<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SearchController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum','throttle:api_rate_limit'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/hotels', [HotelController::class, 'store']);
    Route::get('/hotels', [HotelController::class, 'index']);

    Route::post('/rooms', [RoomController::class, 'store']);

    Route::get('/search', [SearchController::class, 'search']);
});
