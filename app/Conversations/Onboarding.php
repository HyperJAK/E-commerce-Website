<?php
namespace App\Conversations;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Onboarding extends Conversation
{
    protected $firstname;

    protected $email;
   

    public function askFirstname()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            $this->firstname = $answer->getText();
            $this->say('Nice to meet you '.$this->firstname.' type ok to continue');
            // $this->say($userId);
            // $this->askLogin();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            $this->email = $answer->getText();
            $this->say('Great - thank you, '.$this->firstname);
            $this->askLogin();
        });
    } 
    public function askLogin()
    {
       
        // $obj=User::find($user->getId());
        $this->say('$user');
    //     if($obj){
    //     $this->ask('it seems you are not logged in, do you need some help?', function(Answer $answer) {
    //         if($answer->getText()=='yes'){
    //         $this->say("<a href='/login' target='blank'>Login Here!</a>");
    //         }else{
    //            $this->say('okay, '.$this->firstname.' you can still be a guest!');  
    //         }
    //     });
    // }else{
    //     $this->ask('Since you are logged in and a seller let me give you some options!', function(Answer $answer) {
    //         // $this->say(Auth::id()); 
    //         $this->say("<a href='/seller/dashboard' target='blank'>Seller Dashboard!</a>"); 
    //         $this->say("<a href='/seller/user-profile?seller_id=4' target='blank'>Seller Dashboard!</a>"); 
    //         $this->say("<a href='/products' target='blank'>Browse products!</a>");  
    
    //     });
    // }
    }

    public function run()
    {
        // $message = $this->bot->getMessage();
        // $sender = $message->getSender();
        // $userId = $sender['id'];
        // $user = $this->getUser();
        // $userId = $user->getId();
        $this->askFirstname();
    }
}