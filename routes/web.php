<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('welcome');
});

#Route::apiResource('users', UserController::class);
#Route::apiResource('queues', QueueController::class);
#Route::apiResource('documents', DocumentController::class);