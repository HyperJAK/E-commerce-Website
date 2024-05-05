<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
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

        //getting seller id for cartItem
        $store_id= Product::select('store_id')->where('product_id',$productIds->random())->first();
        $seller_id = Store::select('user_id')->where('store_id', $store_id->store_id)->first();

        // Create cart items
        for ($i = 0; $i < 50; $i++) { // Adjust the number of cart items as needed
            // Sample cart item data
            $cartItemData = [
                'product_id' => $productIds->random(),
                'cart_id' => $cartIds->random(),
                'quantity' => rand(1, 10), // Sample quantity
                'price' => rand(10, 100), // Sample price
                'seller_id'=>$seller_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert cart item into the database
            DB::table('cart_items')->insertOrIgnore($cartItemData);
        }
    }
}
