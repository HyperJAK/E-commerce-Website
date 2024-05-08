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
        $orderStatuses = DB::table('order_statuses')->pluck('order_status_id');
        $carts = DB::table('carts')->pluck('cart_id');

        // Create orders
        for ($i = 0; $i < 50; $i++) { // Adjust the number of orders as needed
            // Sample order data
            $orderData = [
                'order_status_id' => $orderStatuses[rand(0, 4)], // Random status
                'description' => 'Sample order description',
                'address' => 'Sample address',
                'shipping_method' => ['by air', 'by sea'][rand(0, 1)], // Random shipping method
                'order_placement_date' => now(), // Current date and time
                'total_price' => rand(100, 1000), // Sample total price
                'buyer_id' => $buyerIds->random(),
                'cart_id' => $carts->random(),
                'location_id' => 1,
            ];

            // Insert order into the database
            DB::table('orders')->insertOrIgnore($orderData);
        }
    }
}
