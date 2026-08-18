<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-api', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Your Laravel API is working perfectly!'
    ]);
});
