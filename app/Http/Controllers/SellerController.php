<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return view('/seller/dashboard/index');
    }

    public function userProfile(Request $request)
    {

        $user = User::where('email', 'admin@example.com')->first();


        return view('/seller/pages/laravel-examples/user-profile')->with('user', $user);
    }

    public function profile()
    {
        return view('/seller/pages/profile');
    }

    public function userManagement()
    {
        return view('/seller/pages/laravel-examples/user-management');
    }

    public function tables()
    {
        return view('/seller/pages/tables');
    }

    public function billing()
    {
        return view('/seller/pages/billing');
    }


    public function notifications()
    {
        return view('/seller/pages/notifications');
    }

    public function staticSignIn()
    {
        return view('/seller/pages/static-sign-in');
    }

    public function staticSignUp()
    {
        return view('/seller/pages/static-sign-up');
    }
}
