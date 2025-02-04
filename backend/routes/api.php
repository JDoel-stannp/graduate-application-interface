<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are typically stateless and are assigned the "api" middleware group.
| They are prefixed with "/api" by default.
|
*/

// Register a resource route for the graduates API
Route::apiResource('graduates', GraduateController::class);
