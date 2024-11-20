<?php

namespace Database\Factories;

use App\Enums\TableStatus;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends Factory<User>
 */
class TimeSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => Table::all()->random()->id,
            'from' => $this->faker->dateTimeBetween('today 16:00', 'today 23:59')->format('H:i'),
            'till' => $this->faker->dateTimeBetween('today 16:00', 'today 23:59')->format('H:i'),
            'status' => $this->faker->randomElement(array_map(fn($case) => $case->value, TableStatus::cases())),
            'created_at' => Carbon::now(),
        ];
    }
}
