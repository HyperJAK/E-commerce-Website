<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('/dashboard/index');
    }

    public function userProfile()
    {
        return view('/pages/laravel-examples/user-profile');
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

    public function rtl()
    {
        return view('/pages/rtl');
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
