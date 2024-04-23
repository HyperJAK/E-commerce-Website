<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryForStores;
use App\Models\Store;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

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
        $categories = CategoryForStores::where('category_id', $categoryId);
        $groupedData = [];

        foreach ($categories as $category) {
            $categoryId = $category->category_id;

            if (!isset($groupedData[$categoryId])) {
                $groupedData[$categoryId] = [
                    'id' => $category->id,
                    'category' => null,
                    'stores' => [],
                ];

                $groupedData[$categoryId]['category'] = Category::where('category_id', $category->category_id)->first();
            }


            $groupedData[$categoryId]['stores'][] = Store::where('store_id', $category->store_id)->first();
        }

        return view('stores')->with('categories', $groupedData);/*$groupedData*/
    }

    public function getStoresByCategory()
    {
        $categories = CategoryForStores::all();
        $groupedData = [];
        $groupedCats = [];
        $cats=CategoryForStores::all()->unique();

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

            $groupedData[$categoryId]['stores'][] = Store::where('store_id', $category->store_id)->first();

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

    public function addStore(Request $request): JsonResponse
    {
        Store::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);
        return response()->json(["message" => "Store added successfully"]);
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
