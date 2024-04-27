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
                'status' => false, // or false based on your requirements
                'user_id' => 1, // Assuming you have users already seeded
                'image' => 'images/storeImages/1/image1.png',
            ],
            [
                'name' => 'Store 2',
                'description' => 'Description of Store 2',
                'status' => true, // or true based on your requirements
                'user_id' => 2, // Assuming you have users already seeded
                'image' => 'images/storeImages/2/image1.png'
            ],
            [
                'name' => 'Store 3',
                'description' => 'Description of Store 3',
                'status' => true, // or true based on your requirements
                'user_id' => 1, // Assuming you have users already seeded
                'image' => 'images/storeImages/1/image2.png'
            ],
            [
                'name' => 'Store 4',
                'description' => 'Description of Store 4',
                'status' => true, // or true based on your requirements
                'user_id' => 2, // Assuming you have users already seeded
                'image' => 'images/storeImages/2/image2.png'
            ],
            // Add more stores as needed
        ]);
    }
}
