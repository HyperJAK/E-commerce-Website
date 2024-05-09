<?php

namespace App\Http\Controllers;

use App\Models\StoreReviews;
use Illuminate\Http\Request;

class StoreReviewController extends Controller
{
    public function getStoreReviews(Request $request)
    {
        $storeReviews = StoreReviews::with('user')->where('store_id', $request->storeId)->get();
        return response()->json(['store_reviews' => $storeReviews]);
    }
}
