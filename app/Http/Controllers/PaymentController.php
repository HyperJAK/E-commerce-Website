<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {   $request->validate([
            'order_id'=>'required|exists:orders,order_id|numeric',
            ]);
            $order=Order::find($request->order_id);

            if($order->order_status_id==2){
                return view('payvalid',['order_id'=>$request->order_id]);
                // return $order->order_status_id;
            }else{
                  return view('viewPayment',['order_id'=>$request->order_id]);
            }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id'=>'exists:orders,order_id|numeric',
            ]);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $order=Order::find($request->order_id);
        $order&&$centsString = str_replace('.', '', (string) $order->total_price);
        if($centsString){
        $cents = (int) $centsString;
    }else{
        $cents=0;
    }

        if($order){
        $user=User::find($order->buyer_id);
        $username=$user->username;
    }else{
        $username='User';
    }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' =>[
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => "testing payment for: ".$username,
                        ],
                        'unit_amount' => $cents,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment/success',['order_id'=>$request->order_id]),
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
        $request->validate([
            'order_id'=>'exists:orders,order_id|numeric',
            ]);

            $order=Order::find($request->order_id);
            $order->order_status_id=2;
            $order->save();
        // return 'payment success';
        return view('payValid');
    }
    public function paymentFailure(Request $request)
    {
        // return 'payment failed';
        return view('payFail');
    }

}
