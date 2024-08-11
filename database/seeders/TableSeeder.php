<?php

namespace Database\Seeders;

use App\Enums\TableStatus;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            [
                'id' => 1,
                'number' => 1,
                'capacity' => 2,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'number' => 2,
                'capacity' => 4,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'number' => 3,
                'capacity' => 6,
                'status' => TableStatus::Unavailable,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'number' => 4,
                'capacity' => 2,
                'status' => TableStatus::Unavailable,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'number' => 5,
                'capacity' => 8,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'number' => 6,
                'capacity' => 4,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'number' => 7,
                'capacity' => 2,
                'status' => TableStatus::Unavailable,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'number' => 8,
                'capacity' => 6,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'number' => 9,
                'capacity' => 2,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'number' => 10,
                'capacity' => 10,
                'status' => TableStatus::Available,
                'created_at' => Carbon::now(),
            ],
        ];

        Table::query()->upsert(
            $tables,
            ['id'],
            ['number', 'capacity', 'status', 'created_at'],
        );
    }
}
