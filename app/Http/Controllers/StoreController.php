<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryForStores;
use App\Models\Store;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{



    public function getIndex(){


        return view('stores');
    }

    public function getStore($id){
        $store = Store::find($id);
        if ($store) {
            return $store;
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function getAllStores(){
        $stores = Store::all();
        if ($stores->isNotEmpty()) {
            return $stores;
        } else {
            return response()->json(['message'=>'Stores not found']);
        }
    }

    public function getStoreSmallInfo(Request $request){
        $page = intval($request->page) ?: 1;
        $pageSize = 6;
        $offset = ($page - 1) * $pageSize;

        if ($page >= 0) {
            $stores = Store::select('store_id','name', 'description')->offset($offset)->limit($pageSize)->get();

            if ($stores->isNotEmpty()) {
                $storesChunks = $stores->chunk(3); // Chunk stores into groups of three

                return view('stores')->with('stores', $storesChunks);
            } else {
                return response()->json(['message'=>'Stores not found']);
            }
        }
    }

    public function SortStoresByCategory($categoryId)
    {
        $categories = CategoryForStores::where('category_id', $categoryId)->get();
        $cats = CategoryForStores::all()->unique();
        $groupedData = [];
        $groupedCats = [];


        foreach ($categories as $category){
            $catId = $category->category_id;

            if (!isset($groupedData[$catId])) {
                $groupedData[$catId] = [
                    'id' => $catId,
                    'category' => null,
                    'stores' => [],
                ];


            }

            $groupedData[$catId]['category'] = Category::where('category_id', $catId)->first();

            $store = Store::where('store_id', $category->store_id)->first();


            $storesCollection = collect($groupedData[$catId]['stores']);

            if (!$storesCollection->contains('store_id', $store->store_id)) {
                $groupedData[$catId]['stores'][] = $store;
            }


        }


        foreach ($cats as $cat) {
            $categoryId = $cat->category_id;

            $groupedCats[$categoryId] = Category::find($cat->category_id);

        }


        return view('stores')->with('cats', $groupedCats)->with('categories', $groupedData);/*$groupedData*/
    }

    public function getStoresByCategory()
    {
        $categories = CategoryForStores::all();
        $groupedData = [];
        $groupedCats = [];

        foreach ($categories as $category) {
            $categoryId = $category->category_id;

            if (!isset($groupedData[$categoryId])) {
                $groupedData[$categoryId] = [
                    'id' => $category->category_id,
                    'category' => null,
                    'stores' => [],
                ];

                $groupedData[$categoryId]['category'] = Category::where('category_id', $category->category_id)->first();

            }

            $groupedCats[$categoryId] = Category::where('category_id', $category->category_id)->first();

            $store = Store::where('store_id', $category->store_id)->first();


            $storesCollection = collect($groupedData[$categoryId]['stores']);

            if (!$storesCollection->contains('store_id', $store->store_id)) {
                $groupedData[$categoryId]['stores'][] = $store;
            }

        }



        return view('stores')->with('cats', $groupedCats)->with('categories', $groupedData)/*$groupedData*/ /*$groupedCats*/;
    }


    public function getPendingStoresByUserId($userId)
    {
        $stores = Store::where('user_id', $userId)->where('status', '0')->get();
        if ($stores->isNotEmpty()) {
            return $stores;
        } else {
            return response()->json(['message'=>'Stores not found']);
        }
    }

    public function getActiveStoresByUserId($userId)
    {
        $stores = Store::where('user_id', $userId)->where('status', '1')->get();
        if ($stores->isNotEmpty()) {
            return $stores;
        } else {
            return response()->json(['message'=>'Stores not found']);
        }
    }

    public function addStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $storeCategory = strtolower($request->category);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/storeImages/').$request->seller_id, $imageName);
        $store = new Store();
        $store->name = $request->name;
        $store->description = $request->description;
        $store->status = 0;
        $store->user_id = $request->seller_id;
        $store->image = 'images/storeImages/'.$request->seller_id.'/'.$imageName;

        $store->save();



        $checkDuplicateCategory = Category::select('category_id')->where('name', $storeCategory)->get();

        if(count($checkDuplicateCategory) == 0){
            $category = new Category();
            $category->name = $storeCategory;
            $category->store_id = $store->store_id;

            $category->save();

            $recheckDuplicate = Category::select('category_id')->where('name', $storeCategory)->get();

            if(count($recheckDuplicate) > 0) {
                $categoryForStore = new CategoryForStores();
                $categoryForStore->category_id = $recheckDuplicate[0]->category_id;
                $categoryForStore->store_id = $store->store_id;

                $categoryForStore->save();
            }
        }
        else{
            $recheckDuplicate2 = Category::select('category_id')->where('name', $storeCategory)->get();

            if(count($recheckDuplicate2) > 0){
                $categoryForStore = new CategoryForStores();
                $categoryForStore->category_id = $recheckDuplicate2[0]->category_id;
                $categoryForStore->store_id = $store->store_id;

                $categoryForStore->save();
            }

        }


        $allUserStores = Store::where('user_id', $request->seller_id)->get();

        if ($allUserStores) {
            foreach ($allUserStores as $store) {
                $categoriesIds = CategoryForStores::select('category_id')->where('store_id', $store->store_id)->distinct()->get();
                $storeCategories = [];

                foreach ($categoriesIds as $categoryId) {
                    $category = Category::select('name')->where('category_id', $categoryId->category_id)->first();
                    if ($category) {
                        $storeCategories[] = $category->name;
                    }
                }

                $store['categories'] = $storeCategories;
            }
        }

        return redirect()->route('seller-tables', ['seller_id' => $request->seller_id]);
    }

    public function updateStore(Request $request, $id): JsonResponse
    {
        $store = Store::find($id);
        if ($store) {
            $store->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'user_id' => $request->user_id,
            ]);
            return response()->json(["message" => "Store updated successfully"]);
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function updateStoreName(Request $request, $id): JsonResponse
    {
        $store = Store::find($id);
        if ($store) {
            $store->update([
                'name' => $request->name,
            ]);
            return response()->json(["message" => "Store updated successfully"]);
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function updateStoreDescription(Request $request, $id): JsonResponse
    {
        $store = Store::find($id);
        if ($store) {
            $store->update([
                'description' => $request->description,
            ]);
            return response()->json(["message" => "Store updated successfully"]);
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function updateStoreStatus(Request $request, $id): JsonResponse
    {
        $store = Store::find($id);
        if ($store) {
            $store->update([
                'status' => $request->status,
            ]);
            return response()->json(["message" => "Store updated successfully"]);
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function deleteStore($id): JsonResponse
    {
        $store = Store::find($id);
        if ($store) {
            $store->delete();
            return response()->json(["message" => "Store deleted successfully"]);
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function getStoreStatus($id){
        $store = Store::find($id);
        if ($store) {
            return $store->status;
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

    public function getStoreCreator($id){
        $store = Store::find($id);
        if ($store) {
            return $store->user_id;
        } else {
            return response()->json(['message'=>'Store not found']);
        }
    }

}
