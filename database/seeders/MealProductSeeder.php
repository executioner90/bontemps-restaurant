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

        DB::table('meal_product')->truncate();
        DB::table('meal_product')->insert($mealProductRelations);

        Schema::enableForeignKeyConstraints();
    }
}
