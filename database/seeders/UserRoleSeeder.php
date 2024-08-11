<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'role' => 'super',
                'abbreviation' => 'SU',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'role' => 'cook',
                'abbreviation' => 'CO',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'role' => 'server',
                'abbreviation' => 'SE',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'role' => 'host',
                'abbreviation' => 'HO',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'role' => 'economic',
                'abbreviation' => 'EC',
                'created_at' => Carbon::now()
            ],
        ];

        Role::query()->upsert(
            $roles,
            ['id'],
            ['role', 'abbreviation', 'created_at']
        );
    }
}
