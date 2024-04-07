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
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //Command to call all seeders
        $this->call([
            UsersTableSeeder::class,
            StoresTableSeeder::class,
            ProductsTableSeeder::class,
            CartsTableSeeder::class,
            CartItemsTableSeeder::class,
            ReviewsTableSeeder::class,
            ChatsTableSeeder::class,
            ChatMessagesTableSeeder::class,
            PaymentMethodsTableSeeder::class,
            PaymentStatusesTableSeeder::class,
            OrdersTableSeeder::class,
            PaymentsTableSeeder::class,
            EventsTableSeeder::class,
            // Add other seeders in the required order
        ]);
    }
}
