<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RocketController;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function (Request $request) {
	return 'Hello World';
});

Route::apiResource('rockets', RocketController::class);

