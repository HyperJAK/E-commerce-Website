<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Store;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddWishlist(Request $request){
        $request->validate([
           'store_id'=>'required|exists:stores,store_id|numeric',
           'product_id'=>'required|exists:products,product_id|numeric',
           'user_id'=>'required|exists:users,user_id|numeric'
            ]);

        // $str= Store::find($request->store_id);
        // $prod= Product::find($request->product_id);
        // $user= User::find($request->user_id);
        $obj=Wishlist::where('user_id',$request->user_id)->where('product_id',$request->product_id)->where('store_id',$request->store_id)->get();
        if($obj->isNotEmpty()){
            return response()->json(['message'=>'Error Duplicate wishlist or user does not exist'],404);
}else{

        Wishlist::create([
            'user_id'=> $request->user_id,
            'product_id'=> $request->product_id,
            'store_id'=>$request->store_id,
        ]);
        return redirect()->route('getProd',['id'=>$request->product_id]);
    //else{
    //     return response()->json(['message'=>'Store or product does not exist!'],404);}
}
}
public function getWishlist($user_id) {
    $wishlist = Wishlist::where('user_id',Auth::id())->get();
    if ($wishlist->isNotEmpty()) {
    
    foreach ($wishlist as $key) {
        $key->product_name = $key->getProdName()[0];
        $key->path1 = $key->getProdPic()[0];
        }
    // return $wishlist;
    return view('Wishlists')->with('objs',$wishlist);  
    }else{
    // return response()->json(['message' => 'Wishlist not found or this user has no wishlist'], 404);
     return view('Wishlists');  
    }
}
//to know that product how many people wished for it
public function getNumberWishlist($product_id) {
    $wishlist = Wishlist::where('product_id',$product_id)->count();
    if ($wishlist>=0) {
      return $wishlist;  
    }else{
    return response()->json(['message' => 'Wishlist not found or this product has no wishlist'], 404);
    }
}
//edit wishlist doesn't make sense we can just add a new product or delete it there's nothing to edit

public function DeleteWishlist(Request $request){
    $request->validate([
        'store_id'=>'required|exists:stores,store_id|numeric',
        'product_id'=>'required|exists:products,product_id|numeric',
        'user_id'=>'required|exists:users,user_id|numeric'
         ]);
    $obj= Wishlist::where('store_id',$request->store_id)->where('product_id',$request->product_id)->where('user_id',$request->user_id)->first();
    if ($obj) {
        $list=Wishlist::find($obj->wishlist_id);
        $list->delete();        
    // return response()->json(["message"=>"wishlist deleted successfully"]);
    return back()->withSuccess(['Product removed from wishlist!']);
    } else {
    // return response()->json(['message'=>'wishlist does not exist or delete wishlist failed']);
    return redirect()->route('getProd',['id'=>$request->product_id])->withErrors(['Error Removing from wishlist']);
}
    }
}
