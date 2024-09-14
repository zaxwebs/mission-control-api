<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RocketController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\AuthController;

Route::get('/hello-text', function (Request $request) {
	// text/html
	return 'Hello World!';
});

Route::get('/hello-array', function (Request $request) {
	// application/json
	return [
		'success' => true,
		'data' => 'Hello World!'
	];
});

Route::get('/hello-response', function (Request $request) {
	// application/json with definable status
	return response()->json([
		'success' => true,
		'data' => 'Hello World!'
	], 200);
});

// authentication

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('rockets', RocketController::class);
Route::apiResource('missions', MissionController::class);

