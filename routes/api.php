<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeeController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/fees/dashboard', [FeeController::class, 'index']); // Admin ledger
    Route::get('/fees/statement/{id}', [FeeController::class, 'show']); // Student/Admin specific look
    Route::post('/fees/collect', [FeeController::class, 'pay']); // Processing endpoint
});
