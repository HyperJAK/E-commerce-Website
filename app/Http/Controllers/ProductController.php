<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;

// As a buyer i want to be able to add a product to my cart, to my Wishlist or normally browse it
// (Buyers can browse products, add to cart, and add to Wishlist.)
class ProductController extends Controller
{
    public function getProdImages($id){
        $obj= Product::select('path1','path2','path3','path4')->where('product_id',$id)->get();
        return $obj;
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
            //   $key->category_id = $key->getCategories()->pluck('name')->toArray();
            $key->category_id = $key->getCatName();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }

    public function getAllProdSmall($page){
        $page = intval($page) ?: 1;
        $pageSize = 6;
        $offset = ($page - 1) * $pageSize;
        
        if ($page >= 0) {
                            
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->offset($offset)->limit($pageSize)->get();
       
        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }

    }
    public function getProdSmallCat($category_id,$page){
        $page = intval($page) ?: 1;
        $pageSize = 6;
        $offset = ($page - 1) * $pageSize;
        
        if ($page >= 0) {
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('category_id', $category_id)->offset($offset)->limit($pageSize)->get();
       
        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }
    }
    public function getProdSmallSearch($search){
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('name','like',"%$search%")->orWhere('description','like',"%$search%")->get();

        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }
    public function getProdSmallStore($store_id){
        $storeCheck=Store::where('store_id',$store_id)->where('status','1')->get();
        if ($storeCheck->isNotEmpty()) {
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('store_id', $store_id)->get();

        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
                $fullAnswers[] = $key;
            }
            return $fullAnswers;
        } else {
           return response()->json(['message'=>'Products not found']);
        } }else {
            return response()->json(['message'=>'Store does not exist or not verified yet']);
         }
    }
    public function getProdName($name){
        $obj= Product::where('name','like',"%$name%")->get();
        if ($obj->isNotEmpty()) { return $obj;
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    }
    public function getProdCategory($category_id){
        $obj= Product::where('category_id',$category_id)->get();
        if ($obj->isNotEmpty()) { return $obj;
        } else {
           return response()->json(['message'=>'No product found']);
        }
    }
    public function getProdStore($store){
        $storeCheck=Store::where('store_id',$store)->where('status','1')->get();
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
        $request->validate([
            'name'=>'required|min:3',
            'description'=>'required|min:3',
            'price'=>'required|numeric',
           'category_id' => 'required|exists:categories,category_id|numeric',
           'quantity'=>'required|numeric',
           'path1'=>'required',
           'path2'=>'required',
           'path3'=>'required',
           'path4'=>'required',
           'store_id'=>'required|exists:stores,store_id|numeric',
            ]);
        // $str= Store::find($request->store_id);
        // $cat= Category::find($request->category_id);
        // if($str && $cat){
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
    // }else{
    //     return response()->json(['message'=>'Store or category does not exist!']);
    // }

}
    public function EditProd(Request $request){
        $request->validate([
            'id'=>'required|exists:products,product_id|numeric',
            'name'=>'required|min:3',
            'description'=>'required|min:3',
            'price'=>'required|numeric',
           'category_id' => 'required|exists:categories,category_id|numeric',
           'quantity'=>'required|numeric',
           'path1'=>'required',
           'path2'=>'required',
           'path3'=>'required',
           'path4'=>'required',
           'store_id'=>'required|exists:stores,store_id|numeric',
            ]);
        $obj= Product::find($request->id);
        // $str= Store::find($request->store_id);
        // $cat= Category::find($request->category_id);
        // if ($obj && $str && $cat) {
            $obj->name = $request->name;
            $obj->description = $request->description;
            $obj->price = $request->price;
            $obj->category_id = $request->category_id;
            $obj->quantity = $request->quantity;
            $obj->path1 = $request->path1;
            $obj->path2 = $request->path2;
            $obj->path3 = $request->path3;
            $obj->path4 = $request->path4;
            $obj->store_id = $request->store_id;
            $obj->save();
        return response()->json(["message"=>"Product edited successfully"]);
    //     } else {
    //         return response()->json(['message'=>'Product, store or category does not exist!']);
    // }
        }

    public function DeleteProd($prod_id){
        $obj= Product::find($prod_id);
        if ($obj) {
            $obj->delete();        
        return response()->json(["message"=>"Product deleted successfully"]);
        } else {
        return response()->json(['message'=>'Product does not exist or delete product failed']);
    }
        }
}
