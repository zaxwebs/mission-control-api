<?php

namespace App\Http\Controllers;

use App\Models\Rocket;
use Illuminate\Http\Request;

class RocketController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// Retrieve all rockets from the database
		$rockets = Rocket::with('missions')->get();

		return $rockets;

		// Return the rockets in JSON format
		// return response()->json([
		// 	'success' => true,
		// 	'data' => $rockets
		// ], 200);
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Rocket $rocket)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Rocket $rocket)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Rocket $rocket)
	{
		//
	}
}
