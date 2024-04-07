<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all chat IDs, sender IDs, and recipient IDs
        $chatIds = DB::table('chats')->pluck('chat_id');
        $userIds = DB::table('users')->pluck('user_id');

        // Create chat messages
        for ($i = 0; $i < 50; $i++) { // Adjust the number of messages as needed
            // Sample chat message data
            $messageData = [
                'content' => 'Sample message content',
                'chat_id' => $chatIds->random(),
                'sender_id' => $userIds->random(),
                'recipient_id' => $userIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert chat message into the database
            DB::table('chat_messages')->insertOrIgnore($messageData);
        }
    }
}
