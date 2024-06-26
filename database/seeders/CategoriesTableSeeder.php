<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'electronics',
                'parent_id' => null,
                'description' => 'Category for electronic products.',
                'store_id'=>1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'smartphones',
                'parent_id' => 1,
                'description' => 'Category for smartphones.',
                'store_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'fournitures',
                'parent_id' => 1,
                'description' => 'Category for smartphones.',
                'store_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];

        foreach ($categories as $categoryData) {
            DB::table('categories')->insertOrIgnore($categoryData);
        }
    }
}
