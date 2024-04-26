<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('/admin/dashboard/index');
    }

    public function userProfile(Request $request)
    {

        $user = User::where('email', 'admin@example.com')->first();


        return view('/admin/pages/laravel-examples/user-profile')->with('user', $user);
    }

    public function profile()
    {
        return view('/admin/pages/profile');
    }

    public function userManagement()
    {
        return view('/admin/pages/laravel-examples/user-management');
    }

    public function tables()
    {
        return view('/admin/pages/tables');
    }

    public function billing()
    {
        return view('/admin/pages/billing');
    }


    public function notifications()
    {
        return view('/admin/pages/notifications');
    }

    public function staticSignIn()
    {
        return view('/admin/pages/static-sign-in');
    }

    public function staticSignUp()
    {
        return view('/admin/pages/static-sign-up');
    }
}
