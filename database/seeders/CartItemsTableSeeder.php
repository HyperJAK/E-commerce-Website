<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all product IDs and cart IDs
        $productIds = DB::table('products')->pluck('product_id');
        $cartIds = DB::table('carts')->pluck('cart_id');

        // Create cart items
        for ($i = 0; $i < 50; $i++) { // Adjust the number of cart items as needed
            // Sample cart item data
            $cartItemData = [
                'product_id' => $productIds->random(),
                'cart_id' => $cartIds->random(),
                'quantity' => rand(1, 10), // Sample quantity
                'price' => rand(10, 100), // Sample price
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert cart item into the database
            DB::table('cart_items')->insertOrIgnore($cartItemData);
        }
    }
}
