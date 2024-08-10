<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'stock' => $this->faker->randomFloat('2', '0', '100'),
            'unit' => $this->faker->randomElement(['kg', 'g', 'l']),
            'min_available' => $this->faker->randomFloat('2', '0', '30'),
            'created_at' => Carbon::now(),
        ];
    }
}
