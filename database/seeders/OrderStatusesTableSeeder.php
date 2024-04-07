<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample payment status data
        $orderStatuses = [
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Confirmed',
            ],
            [
                'name' => 'Shipped',
            ],
            [
                'name' => 'Delivered',
            ],
            [
                'name' => 'Cancelled',
            ],
            // Add more payment statuses as needed
        ];

        // Insert payment statuses into the database
        foreach ($orderStatuses as $orderStatus) {
            DB::table('order_statuses')->insertOrIgnore($orderStatus);
        }
    }
}
