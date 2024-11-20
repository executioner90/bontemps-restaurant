<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\TimeSlot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        TimeSlot::query()->truncate();
        TimeSlot::factory()
            ->count(50)
            ->create();

        Schema::enableForeignKeyConstraints();
    }
}
