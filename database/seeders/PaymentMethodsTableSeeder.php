<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample payment method data
        $paymentMethods = [
            [
                'name' => 'Credit Card',
            ],
            [
                'name' => 'Debit Card',
            ],
            [
                'name' => 'PayPal',
            ],
            // Add more payment methods as needed
        ];

        // Insert payment methods into the database
        foreach ($paymentMethods as $paymentMethod) {
            DB::table('payment_methods')->insertOrIgnore($paymentMethod);
        }
    }
}
