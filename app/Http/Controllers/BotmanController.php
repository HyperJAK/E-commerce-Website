<?php

namespace App\Http\Controllers;

use App\Conversations\Onboarding;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use App\Conversations\NameConversation;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
class BotmanController extends Controller
{
    public function Botmanview(){
        return view('botmantest');
    }
    public function BotmanTest(){
$config = [
    // "web" => [
    //    "token" => "JOE"
    // ]
];
DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
$botman = BotManFactory::create($config, new LaravelCache());

// Give the bot something to listen for.
$botman->hears('hi|hello|bonjour|hey|sabaho', function (BotMan $bot) {
    $bot->reply('Hello! Click Start to initate a conversation');
    // ->addButton(Button::create('Start')->value('start'));

});
$botman->hears('start', function (BotMan $bot) {
    $bot->startConversation(new Onboarding);
});
$botman->hears('What is your name?', function (BotMan $bot) {
    $bot->reply('I am Carty your personnal bot! how may I help you today ;)');
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand');
});
// Start listening
$botman->listen();
}


}
