<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

class CartItemController extends Controller
{
    public function AddCartItem(Request $request){
        $request->validate([
/*           'cart_id'=>'required|exists:carts,cart_id|numeric',*/
           'product_id'=>'required|exists:products,product_id|numeric',
           'quantity'=>'required|numeric',
            ],[
                'exists'=>'Cart Id or Product Id do not exist',
            ]);
            $price= Product::select('price')->where('product_id',$request->product_id)->get();

            //getting seller id for cartItem
            $store_id= Product::select('store_id')->where('product_id',$request->product_id)->first();
            $seller_id = Store::select('user_id')->where('store_id', $store_id->store_id)->first();

            //to test if theres an open cart
            $availableCartTest = Cart::select('cart_id')->where('status', 0)->where('buyer_id', $request->buyer_id)->get();

            if(!$availableCartTest->isNotEmpty()){
                $cartController = new CartController();
                $cartController->AddCart($request);
            }

            //after cart is created we get it
        $availableCart = Cart::select('cart_id')->where('status', 0)->where('buyer_id', $request->buyer_id)->get();

            if($availableCart->isNotEmpty()){
                CartItem::create([
                    'price'=> $price->pluck('price')->first(),
                    'quantity'=> $request->quantity,
                    'product_id'=> $request->product_id,
                    'cart_id'=>$availableCart[0]->cart_id,
                    'seller_id'=>$seller_id->user_id,
                ]);
            }

        return redirect()->route('getProd',['id'=>$request->product_id]);
}
public function EditCartItemQtt(Request $request){
    $request->validate([
        'cartItem_id'=>'required|exists:cart_items,cartItem_id|numeric',
       'quantity'=>'required|numeric',
        ]);
    $obj= CartItem::find($request->cartItem_id);
    if($request->quantity>=0){
        $obj->quantity = $request->quantity;
        $obj->save();
    return response()->json(["message"=>"CartItem quantity edited successfully"]);
    }else{
        return response()->json(["message"=>"CartItem quantity cannot be <0"]);
    }
}
public function getCartItem($cart_id) {
    $cartItem = CartItem::where('cart_id',$cart_id)->get();
    if ($cartItem->isNotEmpty()) {
      return $cartItem;
    }else{
    return response()->json(['message' => 'cartItems not found or this user has no items in his cart'], 404);
    }
}
public function DeleteCartItem($cartItem_id){
    $obj= CartItem::find($cartItem_id);
    $product_id = $obj->product_id;
    $wished = false;

    if($obj){
        $checkIfWishlisted= Product::find($obj->product_id);

        if(count($checkIfWishlisted->getUserStatus(Auth::id()))>0){
            $wished=true;
        }else{
            $wished=false;
        }
    }

    if ($obj) {
        $obj->delete();
    return redirect()->route('getProd',['id'=>$product_id])->with('wished', $wished);
    } else {
    return redirect()->route('getProd',['id'=>$product_id])->with('wished', $wished);
}
    }
}
