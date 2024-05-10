<?php

namespace App\Http\Controllers;

use App\Models\ProductReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{

    public function createProductReview(Request $request){

        $request->validate([
            'content'=>'required',
            'rating'=>'required|numeric',
            'user_id'=>'required|exists:users,user_id|numeric',
            'product_id'=>'required|exists:products,product_id|numeric'
        ],[
            'exists'=>'User or Product do not exist',
        ]);

        $newProductRev = new ProductReviews();
        $newProductRev->content = $request->content;
        $newProductRev->rating = $request->rating;
        $newProductRev->user_id = $request->user_id;
        $newProductRev->product_id = $request->product_id;

        $newProductRev->save();

        // return response()->json(['product_reviews' => $newProductRev]);
        return redirect()->back();
    }
    public function getProductReviews($productId)
    {
        $productReviews = DB::table('product_reviews')->join('users', 'product_reviews.user_id', '=', 'users.user_id')->select('product_reviews.*', 'users.username as user_name', 'users.email as user_email')->where('product_reviews.product_id', $productId)->get();
        // return response()->json(['product_reviews' => $productReviews]);
        return $productReviews;
    }
}
