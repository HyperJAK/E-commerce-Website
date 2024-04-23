<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Command to call all seeders (Please don't change the order of these)
        $this->call([
            UsersTableSeeder::class,
            StoresTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            CartsTableSeeder::class,
            CartItemsTableSeeder::class,
            ReviewsTableSeeder::class,
            ChatsTableSeeder::class,
            ChatMessagesTableSeeder::class,
            PaymentMethodsTableSeeder::class,
            PaymentStatusesTableSeeder::class,
            OrderStatusesTableSeeder::class,
            OrdersTableSeeder::class,
            PaymentsTableSeeder::class,
            EventsTableSeeder::class,
            WishlistsTableSeeder::class,
            CategoryForStoresSeeder::class

        ]);
    }
}
