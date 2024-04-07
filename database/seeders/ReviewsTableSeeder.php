<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs
        $userIds = DB::table('users')->pluck('user_id');

        // Get all product IDs
        $productIds = DB::table('products')->pluck('product_id');

        // Get all store IDs
        $storeIds = DB::table('stores')->pluck('store_id');

        // Create reviews
        for ($i = 0; $i < 100; $i++) { // Adjust the number of reviews as needed
            // Randomly select a user ID
            $userId = $userIds->random();

            // Randomly select a product ID or store ID (or leave null)
            $productId = $productIds->random();
            $storeId = $storeIds->random();

            // Determine if the review is for a product or a store
            $isForProduct = rand(0, 1); // 50% chance for each

            // Create review data
            $data = [
                'content' => 'Sample review content',
                'rating' => rand(1, 5), // Random rating between 1 and 5
                'reviewer_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Associate review with a product or store (or leave null)
            if ($isForProduct) {
                $data['product_id'] = $productId;
            } else {
                $data['store_id'] = $storeId;
            }

            // Insert the review into the database
            DB::table('reviews')->insertOrIgnore($data);
        }
    }
}
