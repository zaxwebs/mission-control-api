<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rocket>
 */
class RocketFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => $this->faker->company . ' Rocket',
			'height' => $this->faker->randomFloat(2, 50, 100),
			'diameter' => $this->faker->randomFloat(2, 2, 10),
			'weight' => $this->faker->randomFloat(2, 5000, 10000),
			'payload_capacity' => $this->faker->randomFloat(2, 1000, 20000),
		];
	}
}
