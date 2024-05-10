<?php

namespace App\Http\Controllers;

use App\Models\StoreReviews;
use Illuminate\Http\Request;

class StoreReviewController extends Controller
{

    public function createStoreReview(Request $request){
        $request->validate([
            'content'=>'required',
            'rating'=>'required|numeric',
            'user_id'=>'required|exists:users,user_id|numeric',
            'store_id'=>'required|exists:stores,store_id|numeric'
        ],[
            'exists'=>'User or Store do not exist',
        ]);

        $newStoreRev = new StoreReviews();
        $newStoreRev->content = $request->reviewContent;
        $newStoreRev->rating = $request->rating;
        $newStoreRev->user_id = $request->user_id;
        $newStoreRev->store_id = $request->store_id;

        $newStoreRev->save();

        return response()->json(['store_reviews' => $newStoreRev]);
    }

    public function getStoreReviews(Request $request)
    {
        $storeReviews = StoreReviews::with('user')->where('store_id', $request->storeId)->get();
        return response()->json(['store_reviews' => $storeReviews]);
    }
}
