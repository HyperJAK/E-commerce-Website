<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = new User();
            $user->username = $googleUser->getName() ?: 'User';
            $user->email = $googleUser->getEmail();
            
            $user->password = Str::random(16);

            if (isset($googleUser->user['locale'])) {
                $locale = explode('_', $googleUser->user['locale']);
                if (isset($locale[1])) {
                    $user->country = $locale[1];
                }
            } else {
                $user->country = 'Unknown';
            }
            
            $user->city = 'Unknown';
            $user->address = 'Not provided';
            
            $user->verification_token = Str::random(32);
            
            $user->save();
            
            $this->sendVerificationEmail($user);
        }

        Auth::login($user);

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    } catch (\Exception $e) {
        return redirect()->route('signin')->with('error', 'Google sign-in failed. Please try again.');
    }
}


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $facebookUser->getEmail())->first();

        if (!$user) {
            $user = new User();
            $user->username = $facebookUser->getName() ?: 'User';
            $user->email = $facebookUser->getEmail();
            $user->password = Str::random(16); 
            $user->country = $facebookUser->user['location']['country'] ?? 'Unknown';
            $user->city = $facebookUser->user['location']['city'] ?? 'Unknown';
            $user->address = 'Not provided';
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('home');
    }





    public function redirectToMicrosoft()
{
    return Socialite::driver('microsoft')->redirect();
}

public function handleMicrosoftCallback()
{
    $microsoftUser = Socialite::driver('microsoft')->user();
    

    $user = User::where('email', $microsoftUser->getEmail())->first();

    if (!$user) {
        $user = new User();
        $user->username = $microsoftUser->getName() ?: 'User';
        $user->email = $microsoftUser->getEmail();
        $user->password = Str::random(16); 
        $user->country = 'Unknown';
        $user->city = 'Unknown';
        $user->address = 'Not provided';
        $user->save();

        $userController = new UserController();
        $userController->sendVerificationEmail($user);
    }

    Auth::login($user);

    return redirect()->route('home');
}
}
