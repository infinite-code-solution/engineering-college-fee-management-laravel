<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\FeeManagementController;


// Publicly accessible endpoints
Route::get('/products', [ProductController::class, 'index']);
Route::get('/fees/ledger', [FeeManagementController::class, 'index']);
// Protected endpoints requiring a Sanctum token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
