<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RocketController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\AuthController;

// Demo routes on content types
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

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('rockets', RocketController::class);
// Route::apiResource('missions', MissionController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
	// Protected routes that require authentication
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/missions', [MissionController::class, 'store']);
	Route::put('/missions/{mission}', [MissionController::class, 'update']);
	Route::delete('/missions/{mission}', [MissionController::class, 'destroy']);

	Route::post('/rockets', [RocketController::class, 'store']);
	Route::put('/rockets/{rocket}', [RocketController::class, 'update']);
	Route::delete('/rockets/{rocket}', [RocketController::class, 'destroy']);
});

// Public routes (accessible without authentication)
Route::get('/missions', [MissionController::class, 'index']);
Route::get('/missions/{mission}', [MissionController::class, 'show']);

Route::get('/rockets', [RocketController::class, 'index']);
Route::get('/rockets/{rocket}', [RocketController::class, 'show']);

