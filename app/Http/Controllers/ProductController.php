<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Hamcrest\Text\IsEmptyString;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Category;
use App\Models\CategoryForStores;
use Illuminate\Http\Request;

// As a buyer i want to be able to add a product to my cart, to my Wishlist or normally browse it
// (Buyers can browse products, add to cart, and add to Wishlist.)
class ProductController extends Controller
{
    public function index(){
        // $cats=Category::all();
        $cats=Category::where('parent_id',null)->get();                  
            return view('index')->with('cats',$cats);
    }
    public function getProdImages($id){
        $obj= Product::select('path1','path2','path3','path4')->where('product_id',$id)->get();
        return $obj;
    }
    public function getProd($id){
        $storeCheck=Store::where('status','1')->pluck('store_id')->toArray();
        $cats=Category::where('parent_id',null)->get(); 
        $obj= Product::find($id);
        if ($obj && in_array($obj->store_id,$storeCheck)) { 
            $obj->category_id = $obj->getCatName();
            $obj->store_name = $obj->getStoreName();
            // return $obj;
            return view('viewProd')->with('obj',$obj)->with('cats',$cats);
        } else {
        //    return response()->json(['message'=>'Product not found']);
        return view('viewProd')->with('cats',$cats)->withErrors(["your_custom_error"=>"Product not found"]);

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

    public function getAllProdSmall(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            ]);
        $storeCheck=Store::where('status','1')->pluck('store_id')->toArray();
        $cats=Category::where('parent_id',null)->get(); 
        if($request->order){             
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->whereIn('store_id', $storeCheck)->orderBy('price',$request->order)->paginate(6);
        }else{
         $obj= Product::select('product_id','name', 'description','price','category_id','path1')->whereIn('store_id', $storeCheck)->paginate(6);
      
        }
        if (count($obj)>0) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
                $fullAnswers[] = $key;
            }
            return $request->order? view('products')->with('objs',$obj)->with('cats',$cats)->with('order',$request->order):view('products')->with('objs',$obj)->with('cats',$cats);
            // return $obj;
        } else {
            return view('products');
        //    return response()->json(['message'=>'Products not found']);
        }

    }
    public function getProdSmallCat(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            'category_id'=>'exists:categories,category_id'
            ]);
        $storeCheck=Store::where('status','1')->pluck('store_id')->toArray();
        $cats=Category::where('parent_id',null)->get(); 
        $cat2=Category::find($request->category_id)->getChildrensId()->toArray(); 
        $cat2[]=intval($request->category_id);
        if($request->order){    
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->whereIn('category_id', $cat2)->whereIn('store_id', $storeCheck)->orderBy('price',$request->order)->paginate(9);
        } else{
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->whereIn('category_id', $cat2)->whereIn('store_id', $storeCheck)->paginate(9);
        }
       
        if ($obj) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
                $fullAnswers[] = $key;
            }
            return $request->order?view('products')->with('objs',$obj)->with('cats',$cats)->with('title',$obj->first()->category_id[0])->with('order',$request->order):view('products')->with('objs',$obj)->with('cats',$cats)->with('title',$obj->first()->category_id[0]);
        } else {
           return response()->json(['message'=>'Products not found']);
        }
    
    }
    public function getProdSmallSearch(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            ]);
        $storeCheck=Store::where('status','1')->pluck('store_id')->toArray();
        $cats=Category::where('parent_id',null)->get(); 
        if(empty($request->search) || $request->search === null){
           return redirect()->to('products');
        }
        if($request->order){  
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('name','like',"%$request->search%")->orWhere('description','like',"%$request->search%")->whereIn('store_id', $storeCheck)->orderBy('price',$request->order)->paginate(9);
        } else{
             $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('name','like',"%$request->search%")->orWhere('description','like',"%$request->search%")->whereIn('store_id', $storeCheck)->paginate(9);
        }   
        if (count($obj)>0) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
                $fullAnswers[] = $key;
            }
            return $request->order?view('products')->with('objs',$obj)->with('cats',$cats)->with('title','Search Result')->with('order',$request->order):view('products')->with('objs',$obj)->with('cats',$cats)->with('title','Search Result');
        } else {
            return view('products');
        }
    }
    public function getProdSmallSearchStore(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            'store_id'=>'exists:stores,store_id'
            ]);
        $storeCheck=Store::where('store_id',$request->store_id)->where('status','1')->get();
        $categories = CategoryForStores::where('store_id', $request->store_id)->get();
        foreach ($categories as $key) {
            $key->name = $key->getCatNameStore();
            }
        if($storeCheck){
        if($request->order){  
        $obj= Product::select('product_id','name', 'description','price','category_id','path1') ->where('store_id', $request->store_id)
        ->where(function($query) use ($request) {
            $query->where('name', 'like', "%$request->search%")
                  ->orWhere('description', 'like', "%$request->search%");
        })->orderBy('price',$request->order)->paginate(9);
        } else{
             $obj= Product::select('product_id','name', 'description','price','category_id','path1') ->where('store_id', $request->store_id)
             ->where(function($query) use ($request) {
                 $query->where('name', 'like', "%$request->search%")
                       ->orWhere('description', 'like', "%$request->search%");
             })->paginate(9);
        }   
        if (count($obj)>0) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
                $fullAnswers[] = $key;
            }
          return $request->order?view('viewProdStore')->with('objs',$obj)->with('cats',$categories)->with('title',$storeCheck->first()->name)->with('order',$request->order):view('viewProdStore')->with('objs',$obj)->with('cats',$categories)->with('title','Search Result');
            
        } else {
            return view('viewProdStore');
        }
    }
    }
    public function getProdSmallStore(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            'store_id'=>'exists:stores,store_id'
            ]);

            //this returns the product in a certain category ymkin la2 b3t2d m8albat
            // $categories = CategoryForStores::where('store_id', $request->store_id)->get();
            // foreach ($categories as $key) {
            //     $key->category_id = $key->getCatNameStore();
            //         $fullAnswers[] = $key;
            //     }
                
            //this now returns name of categories in reuqest store
                $categories = CategoryForStores::where('store_id', $request->store_id)->get();
            foreach ($categories as $key) {
                $key->name = $key->getCatNameStore();
                }

        $storeCheck=Store::where('store_id',$request->store_id)->where('status','1')->get();
        $cats=Category::where('store_id',$request->store_id)->get();
        if ($storeCheck->isNotEmpty()) {
            if($request->order){ 
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('store_id', $request->store_id)->orderBy('price',$request->order)->paginate(6);
    } else{
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('store_id', $request->store_id)->paginate(6);
    }
        
        if (count($obj)>0) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
    // $storeCheck->first()->name;
                $fullAnswers[] = $key;
            }
            return $request->order? view('viewProdStore')->with('objs',$obj)->with('cats',$categories)->with('title',$storeCheck->first()->name)->with('order',$request->order):view('viewProdStore')->with('objs',$obj)->with('cats',$categories)->with('title',$storeCheck->first()->name);
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
