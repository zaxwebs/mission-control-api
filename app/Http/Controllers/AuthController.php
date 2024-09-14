<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	/**
	 * Register a new user.
	 */
	public function register(Request $request)
	{
		// Validate the request data
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8|confirmed',
		]);

		// Create a new user
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		// Generate a token for the user
		$token = $user->createToken('auth_token')->plainTextToken;

		// Return a response with the user and token
		return response()->json([
			'success' => true,
			'message' => 'User registered successfully.',
			'user' => $user,
			'token' => $token,
		], 201);
	}

	/**
	 * Login a user.
	 */
	public function login(Request $request)
	{
		// Validate the login data
		$request->validate([
			'email' => 'required|email',
			'password' => 'required|string',
		]);

		// Check if the user credentials are valid
		if (!Auth::attempt($request->only('email', 'password'))) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		// Get the authenticated user
		$user = Auth::user();

		// Generate a new token for the user
		$token = $user->createToken('auth_token')->plainTextToken;

		// Return a response with the user and token
		return response()->json([
			'success' => true,
			'message' => 'Login successful.',
			'user' => $user,
			'token' => $token,
		], 200);
	}

	/**
	 * Logout a user (Revoke the token).
	 */
	public function logout(Request $request)
	{
		// Revoke all tokens for the authenticated user
		//$request->user()->tokens()->delete();

		// Revoke the token that was used to authenticate the request
		$request->user()->currentAccessToken()->delete();

		// Return a success message
		return response()->json([
			'success' => true,
			'message' => 'Logout successful.',
		], 200);
	}
}
