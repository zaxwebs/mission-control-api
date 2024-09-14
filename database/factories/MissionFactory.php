<?php

namespace Database\Factories;

use App\Models\Rocket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Missions>
 */
class MissionFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'rocket_id' => Rocket::factory(), // Automatically associate a rocket by creating a new one
			'name' => $this->faker->sentence(3), // Generates a mission name with 3 words
			'description' => $this->faker->paragraph(), // Generates a random paragraph for the description
		];
	}
}
