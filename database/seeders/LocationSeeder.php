<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'user_id' => 1,
                'latitude' => 33.888,
                'longitude' => 35.495,
            ],
            [
                'user_id' => 2,
                'latitude' => 33.889,
                'longitude' => 35.496,
            ],
        ];

        DB::table('locations')->insert($locations);

    }
}
