<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RocketController;
use App\Http\Controllers\MissionController;

Route::get('/hello', function (Request $request) {
	return response()->json([
		'success' => true,
		'data' => 'Hello World!'
	], 200);
});

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('rockets', RocketController::class);
Route::apiResource('missions', MissionController::class);

