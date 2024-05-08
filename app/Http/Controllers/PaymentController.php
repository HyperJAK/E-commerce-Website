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

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' =>[
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => "testing payment joe",
                        ],
                        'unit_amount' => 1099,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment/success'),
            'cancel_url' => route('payment/failure'),
        ]);
        // return $session;
        return redirect()->away($session->url);
        // try {
        //     $paymentIntent = PaymentIntent::create([
        //         'amount' => 1000, // Amount in cents
        //         'currency' => 'usd',
        //         'payment_method_types' => ['card'],
        //     ]);

        //     return response()->json(['client_secret' => $paymentIntent->client_secret]);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

    }

    public function paymentSuccess(Request $request)
    {


        // return 'payment success';
        return view('payValid');
    }
    public function paymentFailure(Request $request)
    {
        // return 'payment failed';
        return view('payFail');
    }

}
