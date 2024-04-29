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
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
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

$botman->hears('hi|hello|bonjour|hey|sabaho', function (BotMan $bot) {
    $bot->typesAndWaits(1);
    // $bot->reply('Hello! Click Start to initate a conversation');
    $buttonHtml = "<button onclick="."botmanWidget.say('start');return false;".">Click Me!</button>";

$message = OutgoingMessage::create($buttonHtml);

$bot->reply($message);
    // ->addButton(Button::create('Start')->value('start'));

});
$botman->hears('start', function (BotMan $bot) {
    $bot->startConversation(new Onboarding);
});
$botman->hears('What is your name?', function (BotMan $bot) {
    $bot->reply('I am Carty your personnal bot! how may I help you today? ;)');
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand');
});

$botman->listen();
}


}
