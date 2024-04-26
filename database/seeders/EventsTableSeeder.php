<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all participant IDs, store IDs, and product IDs
        $participantIds = DB::table('users')->pluck('user_id');
        $storeIds = DB::table('stores')->pluck('store_id');
        $productIds = DB::table('products')->pluck('product_id');

        // Create events
        for ($i = 0; $i < 50; $i++) { // Adjust the number of events as needed
            // Sample event data
            $eventData = [
                'name' => 'Sample Event',
                'description' => 'Sample event description',
                'start_date' => now(), // Current date and time
                'end_date' => now()->addDays(rand(1, 7)), // Random end date within 1 to 7 days from start date
                'calendar_link' => 'https://example.com/calendar', // Sample calendar link
                'participant_id' => $participantIds->random(),
                'store_id' => $storeIds->random(),
                'product_id' => $productIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert event into the database
            DB::table('events')->insertOrIgnore($eventData);
        }
    }
}
