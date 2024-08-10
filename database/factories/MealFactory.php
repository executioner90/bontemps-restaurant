<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => $this->faker->numberBetween(1, 8),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image' => null,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => Carbon::now(),
        ];
    }
}
