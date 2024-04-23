<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all buyer IDs
        $buyerIds = DB::table('users')->pluck('user_id');

        // Create carts
        for ($i = 0; $i < 10; $i++) { // Adjust the number of carts as needed
            // Sample cart data
            $cartData = [
                'buyer_id' => $buyerIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert cart into the database
            DB::table('carts')->insertOrIgnore($cartData);
        }
    }
}
