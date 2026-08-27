<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\CourseController;
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
    
    Route::get('/academic-years', [AcademicYearController::class, 'index']);
    Route::post('/academic-years', [AcademicYearController::class, 'store']);
    Route::get('/academic-years/{id}', [AcademicYearController::class, 'show']);
    Route::put('/academic-years/{id}', [AcademicYearController::class, 'update']);
    Route::delete('/academic-years/{id}', [AcademicYearController::class, 'destroy']);

    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
});
