<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// Retrieve all missions with their associated rockets
		$missions = Mission::with('rocket')->get();

		// Return the missions in JSON format
		return response()->json([
			'success' => true,
			'data' => $missions
		], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// Validate the request data
		$request->validate([
			'rocket_id' => 'required|exists:rockets,id',
			'name' => 'required|string|max:255',
			'description' => 'required|string',
		]);

		// Create a new mission with the validated data
		$mission = Mission::create($request->all());

		// Return the newly created mission in JSON format
		return response()->json([
			'success' => true,
			'data' => $mission
		], 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Mission $mission)
	{
		// Return the specified mission with the associated rocket
		return response()->json([
			'success' => true,
			'data' => $mission->load('rocket')
		], 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Mission $mission)
	{
		// Validate the request data
		$request->validate([
			'rocket_id' => 'sometimes|exists:rockets,id',
			'name' => 'sometimes|string|max:255',
			'description' => 'sometimes|string',
		]);

		// Update the mission with the validated data
		$mission->update($request->all());

		// Return the updated mission in JSON format
		return response()->json([
			'success' => true,
			'data' => $mission
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Mission $mission)
	{
		// Delete the mission from storage
		$mission->delete();

		// Return a success message
		return response()->json([
			'success' => true,
			'message' => 'Mission deleted successfully.'
		], 200);
	}
}
