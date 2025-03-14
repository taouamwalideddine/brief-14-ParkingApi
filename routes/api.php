<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// public
Route::middleware('auth:sanctum')->group(function () {
// test
    Route::get('/test', function () {
        return response()->json(['message' => 'API routes are working!']);
    });

    // user role stuff
    Route::middleware('user')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

// place holder
    });

    // admin role stuff
    Route::middleware('admin')->group(function () {

// place holder
    });

    // logoit
    Route::post('/logout', [AuthController::class, 'logout']);
});
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ReservationController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    // Test route
    Route::get('/test', function () {
        return response()->json(['message' => 'API routes are working!']);
    });

    // User-specific
Route::middleware('user')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
});

    // Admin-specific
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/parkings', [ParkingController::class, 'index']);
        Route::post('/parkings', [ParkingController::class, 'store']);
        Route::put('/parkings/{id}', [ParkingController::class, 'update']);
        Route::delete('/parkings/{id}', [ParkingController::class, 'destroy']);
        Route::get('/parkings/search', [ParkingController::class, 'search']);
        Route::get('/admin/statistics', [ParkingController::class, 'statistics']);
    });

// logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
