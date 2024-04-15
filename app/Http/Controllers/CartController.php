<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddCart(Request $request){
        $request->validate([
           'buyer_id'=>'required|exists:users,user_id|numeric',
            ],[
                'exists'=>'Buyer does not exist',
            ]);
        Cart::create([
            'buyer_id'=>$request->buyer_id,
        ]);
        return response()->json(['message'=>"CartItem added successfully"],200);
}
public function EditCartStatus(Request $request){
    $request->validate([
        'cart_id'=>'required|exists:carts,cart_id|numeric',
       'status'=>'required|numeric',
        ]);
    $obj= Cart::find($request->cart_id);
    if($obj){
    if($request->status==0 || $request->status==1){
        $obj->status = $request->status;
        $obj->save();        
    return response()->json(["message"=>"Cart status edited successfully"]);
    }else{
        return response()->json(["message"=>"Cart edit failed"]);
    }
}else{
        return response()->json(["message"=>"Cart could not be found"]);
    }
}
public function ActivateCartStatus(Request $request){
    $request->validate([
        'cart_id'=>'required|exists:carts,cart_id|numeric',
        ]);
    $obj= Cart::find($request->cart_id);
    if($obj){
        $obj2=Cart::where('buyer_id',$obj->buyer_id)
        ->where('cart_id', '!=',$request->cart_id)
        ->update(['status' => 0]);
        $obj->status=1;
        $obj->save();       
    return response()->json(["message"=>"Cart status activated successfully"]);
}else{
        return response()->json(["message"=>"Cart could not be found"]);
    }
}
public function getCarts($buyer_id) {
    $cart = Cart::where('buyer_id',$buyer_id)->get();
    if ($cart->isNotEmpty()) {
      return $cart;  
    }else{
    return response()->json(['message' => 'cart not found or this user has no items in his cart'], 404);
    }
}
public function DeleteCart($cart_id){
    $obj= Cart::find($cart_id);
    if ($obj) {
        $obj->delete();        
    return response()->json(["message"=>"Cart deleted successfully"]);
    } else {
    return response()->json(['message'=>'Cart does not exist or delete Cartfailed']);
}
    }
}
