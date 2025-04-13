<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('me', [AuthController::class, 'me']);

Route::apiResource('users', UserController::class);
Route::apiResource('queues', QueueController::class);
Route::middleware('auth:api')->post('documents/upload', [DocumentController::class, 'store']);
Route::apiResource('documents', DocumentController::class);