<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CategoryForStores;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function index()
    {
        $dailyOrders = new Order();

        return view('/seller/dashboard/index')->with('dailyOrders', $dailyOrders->getOrdersSortedByDay())->with('monthlyOrders', $dailyOrders->getOrdersSortedByMonth())->with('dailyIncome', $dailyOrders->getTodayIncome())->with('todayClients', $dailyOrders->getTodayClients())->with('todayNewClients', $dailyOrders->getTodayNewClients())->with('totalSales', $dailyOrders->getTotalSales())->with('bestSelling', $dailyOrders->getBestSellingProductsThisMonth());
    }

    public function specificStoreDashboard(Request $request)
    {
        $dailyOrders = new Order();

        return view('/seller/dashboard/specificStoreDashboard')->with('dailyOrders', $dailyOrders->getOrdersSpecificStoreSortedByDay($request->store_id))->with('monthlyOrders', $dailyOrders->getOrdersSpecificStoreSortedByMonth($request->store_id))->with('dailyIncome', $dailyOrders->getTodayIncomeSpecificStore($request->store_id))->with('todayClients', $dailyOrders->getTodaySpecificStoreClients($request->store_id))->with('todayNewClients', $dailyOrders->getTodaySpecificStoreNewClients($request->store_id))->with('totalSales', $dailyOrders->getTotalSalesSpecificStore($request->store_id))->with('bestSelling', $dailyOrders->getSpecificStoreBestSellingProductsThisMonth($request->store_id));
    }

    //This function takes us to the page where we add a store to our seller
    public function createStoreViewRedirect(){
        return view('/seller/functionalities/createStore');
    }

    public function editStoreViewRedirect(Request $request){
        $store = Store::where('store_id', $request->store_id)->get();


        if ($store) {
                $categoriesIds = CategoryForStores::select('category_id')->where('store_id', $store[0]->store_id)->distinct()->get();
                $storeCategories = [];

                foreach ($categoriesIds as $categoryId) {
                    $category = Category::select('name')->where('category_id', $categoryId->category_id)->first();
                    if ($category) {
                        $storeCategories[] = $category->name;
                    }
                }

                $store['categories'] = $storeCategories;

        }

/*        return $store;*/


        return view('/seller/functionalities/editStoreOptions')->with('store', $store);
    }

    public function storeOrdersViewRedirect(Request $request){
        $store = Store::where('store_id', $request->store_id)->first();

        $noDuplicatesOrders = new collection();
        if ($store) {
            //function to get all orders that belong to
            $orders = Order::join('cart_items', 'orders.cart_id', '=', 'cart_items.cart_id')
                ->where('cart_items.store_id', $request->store_id)
                ->get();


            //here we are filtering the duplicate orders that were retrieved because we are joining on cartItems
            //and 1 order can have 2 cartItems with the same storeId


            foreach ($orders as $order){
                //getting the cartId

                if(!$noDuplicatesOrders->contains('order_id', $order->order_id)){
                    //we set the correct status label instead of a number
                    $statusLabel = OrderStatus::select('name')->where('order_status_id', $order->order_status_id)->first();

                    $order['order_status_id'] = $statusLabel->name;
                    $order['price'] = $order['quantity'] * $order['price'];
                    $noDuplicatesOrders->push($order);
                }

            }


        }

        return view('/seller/functionalities/viewStoreOrders')->with('store', $store)->with('orders', $noDuplicatesOrders);
    }



    //this is similar to the table function that opens page where it shows all products of our store
    public function editStoreView(Request $request){

        $storeCheck=Store::where('store_id',$request->store_id)->where('status','1')->get();
        if ($storeCheck->isNotEmpty()) {

            //getting all products
            $allStoreProducts= Product::where('store_id',$request->store_id)->get();

            //getting the store name for displaying it
            $store = Store::select('store_id', 'name', 'image')->where('store_id', $request->store_id)->get();

            if ($allStoreProducts->isNotEmpty()) {
                //adding category name to the products instead of id
                    foreach ($allStoreProducts as $prod) {
                        $prod->category_id = $prod->getCatName();
                        $prod->description = Str::limit($prod->description, 69);
                    }

                return view('/seller/functionalities/editStore')->with('store', $store[0])->with('products', $allStoreProducts);
            } else {
                return view('/seller/functionalities/editStore')->with('store', $store[0]);
            }
        }else {
            return response()->json(['message'=>'Store does not exist or not verified yet']);
        }
    }

    //This function takes us to the page where we add a product to our store
    public function createProductView(Request $request){
        $store = Store::select('store_id', 'name', 'description', 'image')->where('store_id', $request->store_id)->get();


        return view('/seller/functionalities/createProduct')->with('store', $store[0]);
    }
    public function editProductView(Request $request){
        $product = Product::where('product_id', $request->product_id)->get();

        if(count($product) > 0){
            $category = Category::select('name')->where('category_id', $product[0]->category_id)->get();

            return view('/seller/functionalities/editProductOptions')->with('product', $product[0])->with('category', $category[0]);

        }
        else{
            return view('/seller/functionalities/editProductOptions')->with('product', $product[0]);
        }

    }



    public function userProfile(Request $request)
    {

        $user = User::where('user_id', $request->seller_id)->first();

        return view('/seller/pages/laravel-examples/user-profile')->with('user', $user);
    }

    public function profile(Request $request)
    {
        $user = User::where('user_id', $request->seller_id)->first();

        return view('/seller/pages/profile')->with('user', $user);
    }

    public function userManagement()
    {
        return view('/seller/pages/laravel-examples/user-management');
    }

    public function tables(Request $request)
    {
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
        /*return $allUserStores;*/
        return view('/seller/pages/tables',['stores'=>$allUserStores]);
    }

    public function billing()
    {
        return view('/seller/pages/billing');
    }


    public function notifications()
    {
        return view('/seller/pages/notifications');
    }

    public function staticSignIn()
    {
        return view('/seller/pages/static-sign-in');
    }

    public function staticSignUp()
    {
        return view('/seller/pages/static-sign-up');
    }
}
