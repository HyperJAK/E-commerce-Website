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
        $storeIds = DB::table('stores')->pluck('store_id');
        $catIds = DB::table('categories')->pluck('category_id');

        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 10.99,
                'quantity' => 100,
                'path1' => 'path/to/image1.jpg',
                'path2' => 'path/to/image2.jpg',
                'path3' => 'path/to/image3.jpg',
                'path4' => 'path/to/image4.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 20.99,
                'quantity' => 50,
                'path1' => 'path/to/image1.jpg',
                'path2' => 'path/to/image2.jpg',
                'path3' => 'path/to/image3.jpg',
                'path4' => 'path/to/image4.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];

       
        foreach ($products as $product) {
          
            $storeId = $storeIds->random();
            $catId = $catIds->random();
            $product['store_id'] = $storeId;
            $product['category_id'] = $catId;
            DB::table('products')->insertOrIgnore($product);
        }
    }
}
