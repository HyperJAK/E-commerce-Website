<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all store IDs
        $storeIds = DB::table('stores')->pluck('store_id');

        // Sample product data
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 10.99,
                'category' => 'Category 1',
                'quantity' => 100,
                'path1' => 'path/to/image1.jpg',
                'path2' => 'path/to/image2.jpg',
                'path3' => 'path/to/image3.jpg',
                'path4' => 'path/to/image4.jpg',
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 20.99,
                'category' => 'Category 2',
                'quantity' => 50,
                'path1' => 'path/to/image1.jpg',
                'path2' => 'path/to/image2.jpg',
                'path3' => 'path/to/image3.jpg',
                'path4' => 'path/to/image4.jpg',
            ],
            // Add more products as needed
        ];

        // Create products
        foreach ($products as $product) {
            // Randomly select a store ID
            $storeId = $storeIds->random();

            // Add store_id to product data
            $product['store_id'] = $storeId;

            // Insert product into the database
            DB::table('products')->insertOrIgnore($product);
        }
    }
}
