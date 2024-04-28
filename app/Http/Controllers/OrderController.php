<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function createOrderView(){

        //retrieving the data of all current carts of the user that were saved in CartController, getActiveCart function
        $data = Session::get('userCart');

        $totalPrice = 0;
        foreach ($data as $item){
            $totalPrice += $item->price;
        }

        return view('/order/createOrder',['userCartItems'=>$data])->with('totalPrice', $totalPrice);
    }

}
