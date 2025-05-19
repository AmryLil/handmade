<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Users::firstOrCreate(
            ['email_222336' => 'admin123@gmail.com'],
            [
                'name'            => 'AdminJi',
                'password_222336' => Hash::make('admin123'),
                'role_222336'     => 'admin',
            ]
        );
    }
}
