<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        $currencies = ['USD', 'EUR', 'GBP', 'LBP', 'KWD'];
        return view('account.show', compact('user', 'currencies'));
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
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|regex:/^[0-9]+$/|max:255',
            'preferred_currency' => 'required|string|in:USD,EUR,GBP,LBP,KWD',
        ]);

        $user->update([
            'username' => $validatedData['username'],
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'preferred_currency' => $validatedData['preferred_currency'],
            'is_seller' => $request->has('is_seller') ? 1 : 0,
        ]);
        
        $user->currency_symbol = match ($request->preferred_currency) {
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'LBP' => 'ل.ل',
            'KWD' => 'د.ك',
            default => '',
        };

        $user->save();

        return redirect()->route('myaccount' , compact('user'))->with('status', 'Account information updated successfully.');
    }
}

