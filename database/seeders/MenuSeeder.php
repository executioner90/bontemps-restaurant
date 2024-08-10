<?php

namespace Database\Seeders;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'id' => 1,
                'name' => 'Salads',
                'special' => false,
                'image' => 'salads-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Soups',
                'special' => false,
                'image' => 'soups-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Chicken',
                'special' => true,
                'image' => 'chicken-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'Noodles',
                'special' => false,
                'image' => 'noodles-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'name' => 'Rice',
                'special' => true,
                'image' => 'rice-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'name' => 'Pizza\'s',
                'special' => false,
                'image' => 'pizzas-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'name' => 'Seafood',
                'special' => true,
                'image' => 'seafood-menu.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'name' => 'Deserts',
                'special' => true,
                'image' => 'deserts-menu.jpg',
                'created_at' => Carbon::now()
            ],
        ];

        Menu::query()->upsert(
            $menus,
            ['id'],
            ['name', 'special', 'image', 'created_at']
        );
    }
}
