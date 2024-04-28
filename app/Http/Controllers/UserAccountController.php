<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    public function show()
    {
        $user = Auth::user();
    return view('account.show', compact('user'));
    }

    
    public function showinfo()
    {
        $user = Auth::user();
        return view('account.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|regex:/^[0-9]+$/|max:255',
        ]);

        $user->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'is_seller' => $request->has('is_seller') ? 1 : 0,
        ]);

        $user = Auth::user();

        return redirect()->route('myaccount' , compact('user'))->with('status', 'Account information updated successfully.');
    }
}

