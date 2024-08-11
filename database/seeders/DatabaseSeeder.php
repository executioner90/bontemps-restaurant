<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MealSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(MealProductSeeder::class);
        $this->call(TableSeeder::class);
    }
}
