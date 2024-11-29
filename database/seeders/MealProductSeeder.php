<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MealProductSeeder extends Seeder
{
    public function run(): void
    {
        $mealProductRelations = [
            [
                'meal_id' => 1,
                'product_id' => 2,
            ],
        ];

        Schema::disableForeignKeyConstraints();

        DB::table('meals_products')->truncate();
        DB::table('meals_products')->insert($mealProductRelations);

        Schema::enableForeignKeyConstraints();
    }
}
