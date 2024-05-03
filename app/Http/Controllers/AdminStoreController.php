<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;


class AdminStoreController extends Controller
{
    public function allStore($id){
        $stores=Store::all();
        if($stores->isempty()){
            return view('admin.AllStores')->withErrors("No Stores Found")->with('id',$id)->with('stores',$stores);
        }else{
             return view('admin.AllStores')->with('id',$id)->with('stores',$stores);
        }
    }

    public function searchStores($id){
                return view('admin.searchStores')->with('id',$id);
    }

    public function searchByName(request $request ,$id){

        $searchName=$request->input('name');


        if(empty($searchName)){
            return redirect()->back()->withErrors('Please provide a name to search!');
        }else{
            $stores=Store::query();
            $stores->where('name','like',"%$searchName%");
            $stores=$stores->get();

            if($stores->isempty()){
               return redirect()->back()->withErrors('Nothing Found!');
            }else{
                return view('admin.searchStores')->with('id',$id)->with('stores',$stores);
            }


        }
    }
    public function deleteStore($id,$idStore){

        $store=Store::find($idStore);
        $store->delete();
        return redirect()->back();
    }


    public function storeActivate($id,$idStore){

        $store=Store::find($idStore);
        return view('admin.Activation')->with('id',$id)->with('store',$store);
    }



    public function saveActivation(Request $request, $id,$idStore){
        $store=Store::find($idStore);
        if($request->has('status')){
            $store->status=true;
        }else $store->status=false;
        $store->save();
        return redirect()->route('AllStores',["id"=>$id]);

    }
}
