<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $userIds = User::pluck('user_id')->toArray();

        $productIds = Product::pluck('product_id')->toArray();

        foreach (range(1, 50) as $index) {
            $review = new ProductReviews();
            $review->content = $faker->paragraph();
            $review->rating = $faker->numberBetween(1, 5);
            $review->user_id = $faker->randomElement($userIds);
            $review->product_id = $faker->randomElement($productIds);
            $review->save();
        }
    }
}
