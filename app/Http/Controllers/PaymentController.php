<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        return view('viewPayment');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // $charge = \Stripe\Charge::create([ 'amount' => 1000, // Amount in cents
        //         'currency' => 'usd', 'source' => $request->stripeToken, // Token from Stripe.js
        //         'description' => 'Laravel Payment', 
        //     ]);
        //     return $charge;
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 1000, // Amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function paymentCallback(Request $request)
    {
        // Handle payment success or failure here
    }

}