<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Rocket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// User::factory(10)->create();

		User::factory()->create([
			'name' => 'Test User',
			'email' => 'test@example.com',
		]);

		$rockets = Rocket::factory()
			->count(50)
			->hasMissions(2) // Creates 3 missions for each rocket
			->create();
	}
}
