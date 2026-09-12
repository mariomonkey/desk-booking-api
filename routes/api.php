<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeskController;
use App\Http\Controllers\Api\AuthController; // Add this import at the top
use App\Http\Controllers\Api\ReservationController; // Add this at the top

// Public routes (anyone can see desks or login)
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('desks', DeskController::class)->only(['index']);

// Protected routes (you MUST have a token to enter)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
});
// Add the login route
Route::post('/login', [AuthController::class, 'login']);

// Your existing desks route
Route::apiResource('desks', DeskController::class);
// This single line automatically creates the 5 standard REST endpoints!
Route::apiResource('desks', DeskController::class);