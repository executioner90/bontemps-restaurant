<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meal>
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
            'menu_id' => Menu::all()->random()->id,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image' => null,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => Carbon::now(),
        ];
    }
}
