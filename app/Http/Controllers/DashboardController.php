<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('/dashboard/index');
    }

    public function userProfile(Request $request)
    {

        $user = User::where('email', 'jak@gmail.com')->first();


        return view('/pages/laravel-examples/user-profile')->with('user', $user);
    }

    public function profile()
    {
        return view('/pages/profile');
    }

    public function userManagement()
    {
        return view('/pages/laravel-examples/user-management');
    }

    public function tables()
    {
        return view('/pages/tables');
    }

    public function billing()
    {
        return view('/pages/billing');
    }


    public function notifications()
    {
        return view('/pages/notifications');
    }

    public function staticSignIn()
    {
        return view('/pages/static-sign-in');
    }

    public function staticSignUp()
    {
        return view('/pages/static-sign-up');
    }
}
