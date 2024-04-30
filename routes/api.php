<?php

use App\Http\Controllers\BotmanController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


// Routes for Wishlists
Route::post('AddWishlist',[WishlistController::class,'AddWishlist'])->name('AddWishlist');
Route::delete('DeleteWishlist',[WishlistController::class,'DeleteWishlist'])->name('DeleteWishlist');

//Routes for CartItems
Route::post('AddCartItem',[CartItemController::class,'AddCartItem'])->name('AddCartItem');
Route::post('EditCartItemQtt',[CartItemController::class,'EditCartItemQtt']);
Route::delete('DeleteCartItem/{cartItem_id}',[CartItemController::class,'DeleteCartItem'])->name('DeleteCartItem');

//Routes for Cart
Route::post('AddCart',[CartController::class,'AddCart']);
Route::post('EditCartStatus',[CartController::class,'EditCartStatus']);
Route::post('ActivateCartStatus',[CartController::class,'ActivateCartStatus']);
Route::delete('DeleteCart/{cart_id}',[CartController::class,'DeleteCart']);


// Update Route
Route::put('stores/{id}', [StoreController::class, 'updateStore']);
Route::put('stores/{id}/updateName', [StoreController::class, 'updateStoreName']);
Route::put('stores/{id}/updateDescription', [StoreController::class, 'updateStoreDescription']);
Route::put('stores/{id}/updateStatus', [StoreController::class, 'updateStoreStatus']);

// Delete Route
Route::delete('stores/{id}', [StoreController::class, 'deleteStore']); // Delete a specific store

Route::post('payment/process', [PaymentController::class, 'processPayment'])->name('payment/process');

Route::post('botman', [BotmanController::class, 'BotmanTest']);