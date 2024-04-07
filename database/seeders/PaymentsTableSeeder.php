<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all payment method IDs
        $paymentMethodIds = DB::table('payment_methods')->pluck('payment_method_id');

        // Get all payment status IDs
        $paymentStatusIds = DB::table('payment_statuses')->pluck('payment_status_id');

        // Get all order IDs
        $orderIds = DB::table('orders')->pluck('order_id');

        // Create payments
        for ($i = 0; $i < 50; $i++) { // Adjust the number of payments as needed
            // Sample payment data
            $paymentData = [
                'amount_paid' => rand(10, 1000), // Sample amount paid
                'date' => now(), // Current date and time
                'payment_method_id' => $paymentMethodIds->random(),
                'payment_status_id' => $paymentStatusIds->random(),
                'order_id' => $orderIds->random(),
            ];

            // Insert payment into the database
            DB::table('payments')->insertOrIgnore($paymentData);
        }
    }
}
