<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs
        $userIds = DB::table('users')->pluck('user_id');

        // Create chats
        for ($i = 0; $i < 50; $i++) { // Adjust the number of chats as needed
            // Sample chat data
            $chatData = [
                'user_initiator_id' => $userIds->random(),
                'user_target_id' => $userIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert chat into the database
            DB::table('chats')->insertOrIgnore($chatData);
        }
    }
}
