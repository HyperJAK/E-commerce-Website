<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample payment status data
        $paymentStatuses = [
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Paid',
            ],
            [
                'name' => 'Failed',
            ],
            // Add more payment statuses as needed
        ];

        // Insert payment statuses into the database
        foreach ($paymentStatuses as $paymentStatus) {
            DB::table('payment_statuses')->insertOrIgnore($paymentStatus);
        }
    }
}
