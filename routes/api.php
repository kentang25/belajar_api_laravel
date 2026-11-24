<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('posts', PostController::class);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'Logout']);
    Route::apiResource('tasks', TaskController::class);
});