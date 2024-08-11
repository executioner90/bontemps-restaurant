<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Password: password
        $users = [
            [
                'id' => 1,
                'role_id' => '1',
                'name' => 'Owner',
                'email' => 'owner@bontemps.nl',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 2,
                'role_id' => '2',
                'name' => 'Chef',
                'email' => 'chef@bontemps.nl',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 3,
                'role_id' => '3',
                'name' => 'Server',
                'email' => 'server@bontemps.nl',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 4,
                'role_id' => '4',
                'name' => 'Host',
                'email' => 'host@bontemps.nl',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 5,
                'role_id' => '5',
                'name' => 'Financial consulent',
                'email' => 'financial@bontemps.nl',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
        ];

        User::query()->upsert(
            $users,
            ['id'],
            ['role_id', 'name', 'email', 'email_verified_at', 'password', 'remember_token']
        );
    }
}
