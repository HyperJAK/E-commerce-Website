<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryForStores;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryForStoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('category_id')->toArray();
        $storeIds = Store::pluck('store_id')->toArray();

        $numberOfAssignments = 10;

        for ($i = 0; $i < $numberOfAssignments; $i++) {
            $randomCategoryId = $categoryIds[array_rand($categoryIds)];
            $randomStoreId = $storeIds[array_rand($storeIds)];

            CategoryForStores::create([
                'category_id' => $randomCategoryId,
                'store_id' => $randomStoreId,
            ]);
        }
    }
}
