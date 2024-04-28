<?php
namespace App\Conversations;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;

class NameConversation extends Conversation
{
    public function askForName()
    {
        $this->ask('What is your name?', function (BotMan $bot, $answer) {
            $name = $answer->getText();
            $bot->userStorage()->save(['name' => $name]);
            $bot->reply("Hi $name! Nice to meet you.");
        });
    }

    public function run()
    {
        $this->askForName();
    }
}
