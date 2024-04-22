<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


    class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->user();
    
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = new User();
        $user->username = $googleUser->getName() ?: 'User';
        $user->email = $googleUser->getEmail();
        $user->password = Str::random(16);
        
        $user->country = $googleUser->user['locale'] ?? 'Unknown';
        if (isset($googleUser->user['locale'])) {
            $locale = explode('_', $googleUser->user['locale']);
            if (isset($locale[1])) {
                $user->country = $locale[1];
            }
        }

        $user->city = 'Unknown';
        $user->address = 'Not provided';

        $user->verification_token = Str::random(32); 
        $user->save();

        $userController = new UserController();
        $userController->sendVerificationEmail($user);
    }

    Auth::login($user);

    return redirect()->route('home');
}
}