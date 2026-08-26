<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\CollegeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestApiController;

Route::get('/test-api', [TestApiController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/fees/dashboard', [FeeController::class, 'index']); // Admin ledger
    Route::get('/fees/statement/{id}', [FeeController::class, 'show']); // Student/Admin specific look
    Route::post('/fees/collect', [FeeController::class, 'pay']); // Processing endpoint

    Route::get('/colleges', [CollegeController::class, 'index']);
    Route::post('/colleges', [CollegeController::class, 'store']);
    Route::get('/colleges/{id}', [CollegeController::class, 'show']);
    Route::put('/colleges/{id}', [CollegeController::class, 'update']);
    Route::delete('/colleges/{id}', [CollegeController::class, 'destroy']);
});
