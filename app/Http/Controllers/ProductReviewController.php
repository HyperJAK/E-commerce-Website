<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function getProductReviews(Request $request)
    {
        $productReviews = DB::table('product_reviews')->join('users', 'product_reviews.user_id', '=', 'users.user_id')->select('product_reviews.*', 'users.username as user_name', 'users.email as user_email')->where('product_reviews.product_id', $request->productId)->get();
        return response()->json(['product_reviews' => $productReviews]);
    }
}
