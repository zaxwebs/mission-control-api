<?php

namespace App\Http\Controllers;

use App\Models\Rocket;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class RocketController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// Use Spatie QueryBuilder to filter and sort rockets, and include missions
		$rockets = QueryBuilder::for(Rocket::class)
			->allowedIncludes('missions')
			->allowedFilters([
				'name',
				AllowedFilter::exact('height'),
				AllowedFilter::exact('diameter'),
				AllowedFilter::exact('weight'),
				AllowedFilter::exact('payload_capacity'),
			])
			->defaultSort('-id')
			->allowedSorts(['created_at', 'name', 'height', 'diameter', 'weight', 'payload_capacity'])
			->get();

		// Return the filtered and sorted rockets in JSON format
		return response()->json([
			'success' => true,
			'data' => $rockets
		], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{

		// Validate the request data
		$request->validate([
			'name' => 'required|string|max:255',
			'height' => 'required|numeric',
			'diameter' => 'required|numeric',
			'weight' => 'required|numeric',
			'payload_capacity' => 'required|numeric',
		]);

		// Create a new rocket with the validated data
		$rocket = Rocket::create($request->all());

		// Return the newly created rocket as JSON
		return response()->json([
			'success' => true,
			'data' => $rocket
		], 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Rocket $rocket)
	{
		// Return the specified rocket with its associated missions
		return response()->json([
			'success' => true,
			'data' => $rocket->load('missions') // Eager load the missions relationship
		], 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Rocket $rocket)
	{
		// Validate the request data
		$request->validate([
			'name' => 'sometimes|string|max:255',
			'height' => 'sometimes|numeric',
			'diameter' => 'sometimes|numeric',
			'weight' => 'sometimes|numeric',
			'payload_capacity' => 'sometimes|numeric',
		]);

		// Update the rocket with the validated data
		$rocket->update($request->all());

		// Return the updated rocket as JSON
		return response()->json([
			'success' => true,
			'data' => $rocket
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Rocket $rocket)
	{
		// Delete the specified rocket
		$rocket->delete();

		// Return a success message
		return response()->json([
			'success' => true,
			'message' => 'Rocket deleted successfully.'
		], 200);
	}
}
