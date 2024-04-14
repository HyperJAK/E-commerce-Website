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
        $obj=Wishlist::where('user_id',$request->user_id)->where('product_id',$request->product_id)->where('store_id',$request->store_id)->get();
        if($obj->isNotEmpty()){
            return response()->json(['message'=>'Error Duplicate wishlist or user does not exist'],404);
}else{
     if($str && $prod && $user){
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
}
public function getWishlist($user_id) {
    $wishlist = Wishlist::where('user_id',$user_id)->get();
    if ($wishlist->isNotEmpty()) {
      return $wishlist;  
    }else{
    return response()->json(['message' => 'Wishlist not found or this user has no wishlist'], 404);
    }
}
//to know that product how many people wished for it
public function getNumberWishlist($product_id) {
    $wishlist = Wishlist::where('product_id',$product_id)->count();
    if ($wishlist>0) {
      return $wishlist;  
    }else{
    return response()->json(['message' => 'Wishlist not found or this product has no wishlist'], 404);
    }
}
//edit wishlist doesn't make sense we can just add a new product or delete it there's nothing to edit

public function DeleteWishlist($wishlist_id){
    $obj= Wishlist::find($wishlist_id);
    if ($obj) {
        $obj->delete();        
    return response()->json(["message"=>"wishlist deleted successfully"]);
    } else {
    return response()->json(['message'=>'wishlist does not exist or delete wishlist failed']);
}
    }
}
