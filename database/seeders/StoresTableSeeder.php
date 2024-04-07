<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insertOrIgnore([
            [
                'name' => 'Store 1',
                'description' => 'Description of Store 1',
                'status' => true, // or false based on your requirements
                'user_id' => 1, // Assuming you have users already seeded
            ],
            [
                'name' => 'Store 2',
                'description' => 'Description of Store 2',
                'status' => false, // or true based on your requirements
                'user_id' => 2, // Assuming you have users already seeded
            ],
            // Add more stores as needed
        ]);
    }
}
