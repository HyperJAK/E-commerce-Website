<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Store;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function AddWishlist(Request $request){
        $str= Store::find($request->store_id);
        $prod= Product::find($request->product_id);
        $user= User::find($request->user_id);
        if($str->isNotEmpty() && $prod->isNotEmpty() && $user->isNotEmpty()){
        Wishlist::create([
            'user_id'=> $request->user_id,
            'product_id'=> $request->product_id,
            'store_id'=>$request->store_id,
        ]);
        return response()->json(['message'=>"Wishlist added successfully"],200);
    }else{
        return response()->json(['message'=>'Store or product does not exist!'],404);
    }
}
public function getWishlist($user_id) {
    $wishlist = Wishlist::where('user_id',$user_id)->get();
    if ($wishlist->isNotEmpty()) {
      return $wishlist;  
    }else{
    return response()->json(['message' => 'Wishlist not found or this user has no wishlist'], 404);
    }
}

}
