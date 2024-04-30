<?php

namespace App\Http\Controllers;

use App\Conversations\Onboarding;
use App\Models\Category;
use App\Models\CategoryForStores;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\User;
use App\Models\Store;
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
    $bot->reply('Hello! Type Start to initate a conversation (other commands: "ok","best dr","creator")');
    

});
$botman->hears('start', function (BotMan $bot) {
    $bot->startConversation(new Onboarding);
});

$botman->hears('ok', function ($botman) {
    $this->askLogin($botman);
});

$botman->hears('dashboard', function ($botman) {
    $botman->reply("<a href='/seller/dashboard' target='blank'>Seller Dashboard</a>");
});
$botman->hears('my wishlist', function ($botman) {
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply("<a href='/getWishlist/$userId' target='blank'>My Wishlist</a>");
});
$botman->hears('my cart', function ($botman) {
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply("<a href='/getActiveCart/$userId' target='blank'>My Cart</a>");
});
$botman->hears('logout', function ($botman) {
    $botman->reply("<a href='/login' target='blank'>Logout Here</a>");
});
$botman->hears('live chat with a seller', function ($botman) {
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply("<a href='/messages/$userId' target='blank'>Chat With Sellers!</a>");
});
$botman->hears('live chat with a buyer', function ($botman) {
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply("<a href='/messagesbuyer/$userId' target='blank'>Chat With Buyers!</a>");
});
$botman->hears('my categs', function ($botman) {
    $this->goCategs($botman);
});
$botman->hears('What is your name?', function (BotMan $bot) {
    $bot->reply('I am Carty your personnal bot! how may I help you today? ;)');
});
$botman->hears('best dr', function (BotMan $bot) {
    $bot->typesAndWaits(2);
    $bot->reply("I've searched the whole web , I found that our Dr. is the best<br/> #team Ali ;)");
});
$botman->hears('creator', function (BotMan $bot) {
    $bot->typesAndWaits(1);
    $bot->reply("<b>Joe</b>, I was so stubborn while he was programming me but now we're friends");
});

$botman->hears('code', function ($bot) {
    $user = $bot->getUser();
    $userId = $user->getId();
    $bot->reply('your user id is:' . $userId);});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand');
});

$botman->listen();
}
public function askLogin($botman)
{
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply('your user id is:' . $userId);
   
    $check=User::where('user_id',intval($userId))->exists();
    $obj=User::where('user_id',intval($userId))->get();
    if (!$check){
    $botman->reply("it seems you are not logged in, do you need some help? <a href='/login' target='blank'>Login Here!</a>");
    //   $botman->reply('okay, you can still be a guest!'); 
}elseif($check && $obj[0]->is_seller==1){
    //     $this->say("<a href='/products' target='blank'>Browse products!</a>");  });
    $options = [
    "dashboard",
    "my categs",
    "live chat with a buyer",
    "logout"
];

$questTitle = "As a seller you can try typing any of these:";
$question = Question::create($questTitle)->addButtons(
    collect($options)->map(function ($opt) {return Button::create($opt)->value($opt);})->toArray()
);

$botman->ask($question, function ($answer,$botman) {
});
}elseif($check && $obj[0]->is_seller==0){
        $commands = [
    "my wishlist",
    "my cart",
    "live chat with a seller",
    "logout"
];

$questionText = "As a buyer you can use:";
$question = Question::create($questionText)->addButtons(
    collect($commands)->map(function ($command) {
        return Button::create($command)->value($command);
    })->toArray()
);

$botman->ask($question, function ($answer) {
});
}

}
public function goCategs($botman){
    $user = $botman->getUser();
    $userId = $user->getId();
    $botman->reply('your user id is:' . $userId);

    $storeIds=Store::select('store_id')->where('user_id',$userId)->get();
    $categories = CategoryForStores::whereHas('CatStr', function ($query) use ($storeIds) {
        $query->whereIn('store_id', $storeIds);
    })->get();


    $fullAns=[];
    foreach ($categories as $key) {
        $key->name = $key->getCatNameStore();
        if (!in_array($key->name[0], $fullAns)) {
            $fullAns[] =$key->name[0]; 
        }
        }
        $string = implode(', ', $fullAns);
    if (count($categories)>0){
         $botman->reply('Your categories are: <b>' . $string.'</b>');
    }else{
         $botman->reply('Your categories are: empty');
    }
}
}
