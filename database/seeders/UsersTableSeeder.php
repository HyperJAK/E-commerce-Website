<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Populating Db
        DB::table('users')->insertOrIgnore([
            [
                'username' => 'john_doe',
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'username' => 'jane_smith',
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            // Add more users as needed
        ]);
    }
}
