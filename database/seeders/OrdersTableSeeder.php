<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs for buyers and sellers
        $buyerIds = DB::table('users')->pluck('user_id');
        $sellerIds = DB::table('users')->pluck('user_id');

        // Create orders
        for ($i = 0; $i < 50; $i++) { // Adjust the number of orders as needed
            // Sample order data
            $orderData = [
                'status' => ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'][rand(0, 4)], // Random status
                'description' => 'Sample order description',
                'address' => 'Sample address',
                'shipping_method' => ['by air', 'by sea'][rand(0, 1)], // Random shipping method
                'order_placement_date' => now(), // Current date and time
                'total_price' => rand(100, 1000), // Sample total price
                'buyer_id' => $buyerIds->random(),
                'seller_id' => $sellerIds->random(),
            ];

            // Insert order into the database
            DB::table('orders')->insertOrIgnore($orderData);
        }
    }
}
