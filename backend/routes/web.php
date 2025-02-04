<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduateController;

Route::get('/test', function () {
    return response()->json(['message' => 'Test route is working!']);
});

Route::get('/', function () {
    return view('welcome');
});

// Disable CSRF for routes in this group by removing the VerifyCsrfToken middleware.
Route::prefix('api')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->group(function () {
        Route::apiResource('graduates', GraduateController::class);
    });
