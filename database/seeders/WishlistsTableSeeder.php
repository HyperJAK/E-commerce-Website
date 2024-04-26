<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all buyer IDs
        $buyerIds = DB::table('users')->pluck('user_id');
        $ProdsIds = DB::table('products')->pluck('product_id');
        $StoresIds = DB::table('stores')->pluck('store_id');

        // Create carts
        for ($i = 0; $i < 50; $i++) { // Adjust the number of carts as needed
            // Sample cart data
            $WishlistData = [
                'user_id' => $buyerIds->random(),
                'product_id'=> $ProdsIds->random(),
                'store_id'=> $StoresIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert cart into the database
            DB::table('wishlists')->insertOrIgnore($WishlistData);
        }
    }
}
