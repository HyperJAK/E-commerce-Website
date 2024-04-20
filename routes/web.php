<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'getStoresByCategory'])->name('/');


//Products routes
Route::get('getProd/{id}',[ProductController::class,'getProd']);
Route::get('getAllProd',[ProductController::class,'getAllProd']);
Route::get('getProdName/{name}',[ProductController::class,'getProdName']);
Route::get('getProdCategory/{category_id}',[ProductController::class,'getProdCategory']);
Route::get('getProdStore/{store}',[ProductController::class,'getProdStore']);
Route::get('getProdImages/{id}',[ProductController::class,'getProdImages']);
Route::get('getAllProdSmall/{page}',[ProductController::class,'getAllProdSmall']);
Route::get('getProdSmallCat/{category_id}/{page}',[ProductController::class,'getProdSmallCat']);
Route::get('getProdSmallStore/{store_id}',[ProductController::class,'getProdSmallStore']);
Route::get('getProdSmallSearch/{search}',[ProductController::class,'getProdSmallSearch']);
Route::get('getWishlist/{user_id}',[WishlistController::class,'getWishlist']);
Route::get('getNumberWishlist/{product_id}',[WishlistController::class,'getNumberWishlist']);

Route::get('getCartItem/{cart_id}',[CartItemController::class,'getCartItem']);
Route::get('getCarts/{buyer_id}',[CartController::class,'getCarts']);
Route::get('getCartItemsBuyerId/{buyer_id}',[CartController::class,'getCartItemsBuyerId']);

//Stores routes
// Read Routes
Route::get('stores/{id}', [StoreController::class, 'getStore']); // Show a specific store
Route::get('stores', [StoreController::class, 'getAllStores']); // Show a specific store
Route::get('stores/getActiveByUserId/{userId}', [StoreController::class, 'getActiveStoresByUserId']); // Show all active stores for specific user
Route::get('stores/getPendingByUserId/{userId}', [StoreController::class, 'getPendingStoresByUserId']); // Show all pending stores for specific user


// Get Route for Store Status
Route::get('stores/{id}/getStatus', [StoreController::class, 'getStoreStatus']);
// Get Route for Store Creator
Route::get('stores/{id}/getCreator', [StoreController::class, 'getStoreCreator']);
Route::get('SortByCategory', [StoreController::class, 'SortByCategory'])->name('SortByCategory');



//Orders routes
// Routes for Order management
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');

//Post doesnt work here, put in api.php
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');

//Delete doesnt work here, put in api.php
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');


Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard'); // Show a specific store
Route::get('admin/user-profile', [AdminController::class, 'userProfile'])->name('user-profile');
Route::get('admin/user-management', [AdminController::class, 'userManagement'])->name('user-management');
Route::get('admin/tables', [AdminController::class, 'tables'])->name('tables');
Route::get('admin/billing', [AdminController::class, 'billing'])->name('billing');
Route::get('admin/notifications', [AdminController::class, 'notifications'])->name('notifications');
Route::get('admin/profile', [AdminController::class, 'profile'])->name('profile');
Route::get('admin/static-sign-up', [AdminController::class, 'staticSignUp'])->name('static-sign-up');
Route::get('admin/static-sign-in', [AdminController::class, 'staticSignIn'])->name('static-sign-in');
