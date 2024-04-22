<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MicrosoftAuthController extends Controller{



public function redirectToMicrosoftGraph()
{
    $query = http_build_query([
        'client_id' => env('MICROSOFT_GRAPH_CLIENT_ID'),
        'redirect_uri' => 'http://localhost:8000/auth/microsoft-graph/callback',
        'response_type' => 'code',
        'scope' => 'User.Read', 
        'state' => csrf_token(),
    ]);

    return redirect('https://login.microsoftonline.com/common/oauth2/v2.0/authorize?' . $query);
}
public function handleMicrosoftGraphCallback(Request $request)
{
    if ($request->state !== csrf_token()) {
        return redirect()->route('signin')->with('error', 'Invalid state parameter.');
    }

    $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
        'client_id' => env('MICROSOFT_GRAPH_CLIENT_ID'),
        'client_secret' => env('MICROSOFT_GRAPH_CLIENT_SECRET'),
        'code' => $request->code,
        'redirect_uri' => 'http://localhost:8000/auth/microsoft-graph/callback',
        'grant_type' => 'authorization_code',
    ]);

    if (isset($response['access_token'])) {
        $accessToken = $response['access_token'];
    } else {
        return redirect()->route('signin')->with('error', 'Access token not found in response.');
    }


    $graphResponse = Http::withToken($accessToken)
        ->get('https://graph.microsoft.com/v1.0/me');

    Log::info('Microsoft Graph API Response: ' . $graphResponse->body());

    if ($graphResponse->successful()) {
        $userData = $graphResponse->json();

        $user = User::where('email', strtolower($userData['mail'] ?? null))->first();

        if (!$user) {
            $user = new User();
            $user->username = $userData['displayName'] ?? 'User';
            $user->email = strtolower($userData['mail'] ?? null);
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
    } else {
        return redirect()->route('signin')->with('error', 'Failed to retrieve user information from Microsoft Graph.');
    }
}

}
