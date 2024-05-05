<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\VerificationSuccessEmail;
use App\Mail\PasswordResetEmail;

use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function showSignUpForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'string|nullable|max:1000'
        ]);


        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->address = $request->input('address', '');
        $user->is_seller = $request->has('is_seller');

        $user->verification_token = Str::random(32);

        $user->save();

        $this->sendVerificationEmail($user);

        return redirect()->route('signin')->with('status', 'Account created! Please check your email to verify your account.');
    }



    public function showSignInForm()
    {
        return view('signin');
    }

    public function updatePreferredCurrency(Request $request){

        $user = User::where('user_id', Auth::id())->first();

        $user->preferred_currency = $request->preferred_currency;

        $user->currency_symbol = match ($request->preferred_currency) {
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'LBP' => 'ل.ل',
            'KWD' => 'د.ك',
            default => '',
        };

        $user->save();

        if($request->store_id !== null){
            return redirect()->route($request->redirection_route, ['store_id'=>$request->store_id]);
        }
        else{
            return redirect()->route($request->redirection_route);
        }

    }

    public function signin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);


    if (Auth::attempt($request->only('email', 'password'))) {

        $user = Auth::user();

        if ($user->is_admin) {

            return redirect()->route('admin.dashboard')->with('status', 'Welcome to the Admin Dashboard');
        } else {

            return redirect()->route('home')->with('status', 'Welcome to Home');
        }
    } else {

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}

    public function sendVerificationEmail(User $user)
{
    $verificationUrl = route('verify.email', ['token' => $user->verification_token]);

    Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));
}

public function verifyEmail($token)
{

    $user = User::where('verification_token', $token)->first();


    if ($user) {

        $user->is_verified = 1;

        $user->email_verified_at = now();

        $user->verification_token = null;

        $user->save();


        Mail::to($user->email)->send(new VerificationSuccessEmail($user));


        return response()->json([
            'message' => 'Your email has been successfully verified!'
        ]);
    }

    return response()->json([
        'message' => 'Invalid verification token.'
    ], 400);
}



public function showForgotPasswordForm()
{
    return view('forgot_password');
}

// public function sendPasswordResetLink(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email|exists:users,email',
//     ]);

//     $user = User::where('email', $request->input('email'))->first();
//     if (!$user) {
//         // If the email does not exist, return an error message
//         return back()->withErrors(['email' => 'Email address does not exist.']);
//     }

//     // Generate a password reset token
//     $token = Str::random(64);

//     // Store the token in the password_resets table
//     \DB::table('password_resets')->insert([
//         'email' => $request->email,
//         'token' => $token,
//         'created_at' => now(),
//     ]);

//     // Send an email to the user with the password reset link
//     $resetUrl = route('password.reset', ['token' => $token]);

//     // Create a Mailable and send it
//     Mail::to($request->email)->send(new PasswordResetEmail($resetUrl));

//     //Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));

//     return back()->with('status', 'Password reset link has been sent to your email!');
// }


public function sendPasswordResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->input('email'))->first();
    if (!$user) {

        return back()->withErrors(['email' => 'Email address does not exist.']);
    }

    $token = \Str::random(64);

    \DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now(),
    ]);

    $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);


    Mail::to($request->email)->send(new PasswordResetEmail($resetUrl));

    return back()->with('status', 'Password reset link has been sent to your email!');
}





public function showResetPasswordForm($token)
{
    $record = \DB::table('password_resets')->where('token', $token)->first();

    if (!$record) {
        return redirect()->route('signin')->with('error', 'Invalid password reset token.');
    }

    return view('reset_password', [
        'token' => $token,
        'email' => $record->email,
    ]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $record = \DB::table('password_resets')
        ->where('token', $request->token)
        ->where('email', $request->email)
        ->first();

    if (!$record) {
        return redirect()->route('signin')->with('error', 'Invalid password reset token or email.');
    }

    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();


    //\DB::table('password_resets')->where('token', $request->token)->delete();

    return redirect()->route('signin')->with('status', 'Password has been reset successfully. Please sign in with your new password.');
}



public function showEditProfileForm()
{
    return view('profile.edit');
}

public function updateProfile(Request $request)
{
    $emailRule = 'required|email|max:255|unique:users,email,' . Auth::user()->user_id . ',user_id';
    $userRule = 'required|string|max:255|unique:users,username,' . Auth::user()->user_id . ',user_id';

    $request->validate([
        'username' => $userRule,
        'email' => $emailRule,
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'address' => 'nullable|string|max:1000',
    ]);


    $user = Auth::user();

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->country = $request->input('country');
    $user->city = $request->input('city');
    $user->address = $request->input('address', '');

    $user->save();

    return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
}


public function logout(Request $request)
{
// DB::table('sessions')
//     ->whereUserId($request->user_id)
//     ->delete();


// $sessions = DB::table('sessions')
//     ->where('user_id',$request->user_id)
//     ->first();



//     DB::table('sessions')
//         ->where('id' , $sessions->id)
//         ->delete();



   Auth::logout();
    $request->session()->invalidate();


    $request->session()->regenerateToken();


    return redirect()->route('signin')->with('status', 'You have been logged out.');
}

}


