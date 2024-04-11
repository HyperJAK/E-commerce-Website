<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

// As a buyer i want to be able to add a product to my cart, to my Wishlist or normally browse it 
// (Buyers can browse products, add to cart, and add to Wishlist.)
class ProductController extends Controller
{
    public function getProdImages($id){
        $obj= Product::find($id);
        $p1=$obj->path1;
        $p2=$obj->path2;
        $p3=$obj->path3;
        $p4=$obj->path4;
        $full=[
            'p1'=>$p1,
            'p2'=>$p2,
            'p3'=>$p3,
            'p4'=>$p4
        ];
        return $full;
    }
    public function getProd($id){
        $obj= Product::find($id);
        if ($obj) { return $obj;
        } else {
           return response()->json(['message'=>'Product not found']);
        }
    }
    public function getAllProd(){
        $obj= Product::all();
       
        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
              $key->category_id = $key->getCategories()->pluck('name')->toArray();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }
    public function getProdName($name){
        $obj= Product::where('name','like',"%$name%")->get();
        if ($obj->isNotEmpty()) { return $obj;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }
    public function getProdCategory($category){
        $obj= Product::where('category',$category)->get();
        if ($obj->isNotEmpty()) { return $obj;
        } else {
           return response()->json(['message'=>'No product found']);
        }
    }
    public function getProdStore($store){
        $storeCheck=Store::where('store_id',$store)->where('status','1')->get(); //not only exist but also verified by admin and active
    if ($storeCheck->isNotEmpty()) {
        $obj= Product::where('store_id',$store)->get();
        if ($obj->isNotEmpty()) { 
            return $obj;
        } else {
           return response()->json(['message'=>'No product found']);
        }
    }else {
           return response()->json(['message'=>'Store does not exist or not verified yet']);
        }
    }
    public function AddProd(Request $request){
        Product::create([
            'name'=> $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'quantity'=>$request->quantity,
            'path1'=>$request->path1,
            'path2'=>$request->path2,
            'path3'=>$request->path3,
            'path4'=>$request->path4,
            'store_id'=>$request->store_id,
        ]);
        return response()->json(["message"=>"Product added successfully"]);
    }
}
