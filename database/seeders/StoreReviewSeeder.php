<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\Store;
use App\Models\StoreReviews;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = User::pluck('user_id')->toArray();

        $storeIds = Store::pluck('store_id')->toArray();

        foreach (range(1, 50) as $index) {
            $review = new StoreReviews();
            $review->content = $faker->paragraph(2);
            $review->rating = $faker->numberBetween(1, 5);
            $review->user_id = $faker->randomElement($userIds);
            $review->store_id = $faker->randomElement($storeIds);
            $review->save();
        }
    }
}
