<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Hamcrest\Text\IsEmptyString;
use Illuminate\Support\Facades\Auth;
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
            return view('products')->with('cats',$cats);

    }
    public function getProdImages($id){
        $obj= Product::select('path1','path2','path3','path4')->where('product_id',$id)->get();
        return $obj;
    }
    public function getProd($id){
        // $isWished=Wishlist::getUserStatus($id);
        $storeCheck=Store::where('status','1')->pluck('store_id')->toArray();
        $cats=Category::where('parent_id',null)->get();
        $wishlists=Wishlist::where('product_id',$id)->count();
        $obj= Product::findOrFail($id);

        $itemAddedToCart=collect();
        //retrieving if its added to users current active cart
        if(Auth::check() && !is_null(Auth::id())){
        $activeCart = Cart::select('cart_id')->where('status', 0)->where('buyer_id',Auth::id())->get();
        $itemAddedToCart = CartItem::select('quantity', 'cartItem_id', 'product_id')->where('cart_id', $activeCart[0]->cart_id)->where('product_id', $id)->get();
    }


        if(count($obj->getUserStatus(Auth::id()))>0){
            $wished=true;
        }else{
            $wished=false;
        }

        if($itemAddedToCart->isNotEmpty()){
            
                if ($obj && in_array($obj->store_id,$storeCheck)) {
                    $obj->category_id = $obj->getCatName();
                    $obj->store_name = $obj->getStoreName();
                    $obj->wish=$wishlists>0?$wishlists." User(s) wished this product":"Be the first to add it to your wishlist!";
                    // return $obj;
                    return view('viewProd')->with('obj',$obj)->with('cartItem_id', $itemAddedToCart[0]->cartItem_id)->with('cats',$cats)->with('wished',$wished)->with('quantity', $itemAddedToCart[0]->quantity);
                } else {
                    //    return response()->json(['message'=>'Product not found']);
                    return view('viewProd')->with('cats',$cats)->with('cartItem_id', $itemAddedToCart[0]->cartItem_id)->with('quantity', $itemAddedToCart[0]->quantity)->withErrors(["Product not found"]);

                }

        }
        else{
            if ($obj && in_array($obj->store_id,$storeCheck)) {
                $obj->category_id = $obj->getCatName();
                $obj->store_name = $obj->getStoreName();
                $obj->wish=$wishlists>0?$wishlists." User(s) wished this product":"Be the first to add it to your wishlist!";
                // return $obj;
                return view('viewProd')->with('obj',$obj)->with('cats',$cats)->with('wished',$wished)->with('quantity', 0);
            } else {
                //    return response()->json(['message'=>'Product not found']);
                return view('viewProd')->with('cats',$cats)->withErrors(["your_custom_error"=>"Product not found"])->with('quantity', 0);

            }
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
        $obj= Product::select('product_id','name', 'description','price','category_id','path1','store_id')->whereIn('store_id', $storeCheck)->orderBy('price',$request->order)->paginate(6);
        }else{
         $obj= Product::select('product_id','name', 'description','price','category_id','path1','store_id')->whereIn('store_id', $storeCheck)->paginate(6);

        }
        if (count($obj)>0) {$fullAnswers = [];
            foreach ($obj as $key) {
            $key->category_id = $key->getCatName();
            $key->description=Str::limit($key->description, 69);
            $key->store_name = $key->getStoreName()[0];
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
        $cat2=Category::find($request->category_id);
        if ($cat2 !== null) {
            $cat2 = $cat2->getChildrensId()->toArray();
        }
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
        // $cats=Category::where('store_id',$request->store_id)->get();
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
    public function getProdSmallStoreCat(Request $request){
        $request->validate([
            'order'=>'in:asc,desc',
            'store_id'=>'exists:stores,store_id',
            'category_id'=>'exists:categories,category_id'
            ]);

                $categories = CategoryForStores::where('store_id', $request->store_id)->get();
            foreach ($categories as $key) {
                $key->name = $key->getCatNameStore();
                }

        $storeCheck=Store::where('store_id',$request->store_id)->where('status','1')->get();
        if ($storeCheck->isNotEmpty()) {
            if($request->order){
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('store_id', $request->store_id)->where('category_id',$request->category_id)->orderBy('price',$request->order)->paginate(6);
    } else{
        $obj= Product::select('product_id','name', 'description','price','category_id','path1')->where('store_id', $request->store_id)->where('category_id',$request->category_id)->paginate(6);
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
           'path1'=>'required|mimes:jpeg,png,jpg,gif|max:10000',
           'path2'=>'required|mimes:jpeg,png,jpg,gif|max:10000',
           'path3'=>'required|mimes:jpeg,png,jpg,gif|max:10000',
           'path4'=>'required|mimes:jpeg,png,jpg,gif|max:10000',
           'store_id'=>'required|exists:stores,store_id|numeric',
            ]);
            $newPath1= time(). "-" . $request->file('path1')->getClientOriginalName();
            $request->file('path1')->move('frontRessource/images',$newPath1);

            $newPath2= time(). "-" . $request->file('path2')->getClientOriginalName();
            $request->file('path2')->move('frontRessource/images',$newPath2);

            $newPath3= time(). "-" . $request->file('path3')->getClientOriginalName();
            $request->file('path3')->move('frontRessource/images',$newPath3);

            $newPath4= time(). "-" . $request->file('path4')->getClientOriginalName();
            $request->file('path4')->move('frontRessource/images',$newPath4);

        Product::create([
            'name'=> $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'quantity'=>$request->quantity,
            'path1'=>$newPath1,
            'path2'=>$newPath2,
            'path3'=>$newPath3,
            'path4'=>$newPath4,
            'store_id'=>$request->store_id,
        ]);
        return response()->json(["message"=>"Product added successfully"]);
}
    public function EditProd(Request $request){
        $request->validate([
            'id'=>'required|exists:products,product_id|numeric',
            'name'=>'required|min:3',
            'description'=>'required|min:3',
            'price'=>'required|numeric',
           'category_id' => 'required|exists:categories,category_id|numeric',
           'quantity'=>'required|numeric',
           'path1'=>'nullable|mimes:jpeg,png,jpg,gif|max:10000',
           'path2'=>'nullable|mimes:jpeg,png,jpg,gif|max:10000',
           'path3'=>'nullable|mimes:jpeg,png,jpg,gif|max:10000',
           'path4'=>'nullable|mimes:jpeg,png,jpg,gif|max:10000',
           'store_id'=>'required|exists:stores,store_id|numeric',
            ]);
        $obj= Product::find($request->id);
            $obj->name = $request->name;
            $obj->description = $request->description;
            $obj->price = $request->price;
            $obj->category_id = $request->category_id;
            $obj->quantity = $request->quantity;

        if ($request->hasFile('path1')) {
            $newPath1= time(). "-" . $request->file('path1')->getClientOriginalName();
            $request->file('path1')->move('frontRessource/images',$newPath1);
            $obj->path1 = $newPath1;
        } 
        if ($request->hasFile('path2')) {
            $newPath2= time(). "-" . $request->file('path2')->getClientOriginalName();
            $request->file('path2')->move('frontRessource/images',$newPath2);
            $obj->path2 = $newPath2;
        }
        if ($request->hasFile('path3')) {
            $newPath3= time(). "-" . $request->file('path3')->getClientOriginalName();
            $request->file('path3')->move('frontRessource/images',$newPath3);
            $obj->path3 = $newPath3;
        }
         if ($request->hasFile('path4')) {
            $newPath4= time(). "-" . $request->file('path4')->getClientOriginalName();
            $request->file('path4')->move('frontRessource/images',$newPath4);
            $obj->path4 = $newPath4;
        }    
            $obj->store_id = $request->store_id;
            $obj->save();
        return response()->json(["message"=>"Product edited successfully"]);
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
