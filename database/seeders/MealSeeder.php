<?php

namespace Database\Seeders;

use App\Models\Meal;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MealSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Meal::query()->truncate();
        Meal::factory()->count(80)->create();

        Schema::enableForeignKeyConstraints();
    }
}
