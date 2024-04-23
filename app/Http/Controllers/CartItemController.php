<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

class CartItemController extends Controller
{
    public function AddCartItem(Request $request){
        $request->validate([
           'cart_id'=>'required|exists:carts,cart_id|numeric',
           'product_id'=>'required|exists:products,product_id|numeric',
           'quantity'=>'required|numeric',
            ],[
                'exists'=>'Cart Id or Product Id do not exist',
            ]);
            $price= Product::select('price')->where('product_id',$request->product_id)->get();
        CartItem::create([
            'price'=> $price->pluck('price')->first(),
            'quantity'=> $request->quantity,
            'product_id'=> $request->product_id,
            'cart_id'=>$request->cart_id,
        ]);
        return response()->json(['message'=>"CartItem added successfully"],200);
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
    if ($obj) {
        $obj->delete();        
    return response()->json(["message"=>"CartItem deleted successfully"]);
    } else {
    return response()->json(['message'=>'CartItem does not exist or delete CartItem failed']);
}
    }
}
