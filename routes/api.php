<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// Routes for Products
Route::post('AddProd',[ProductController::class,'AddProd']);
Route::post('EditProd',[ProductController::class,'EditProd']);
Route::delete('DeleteProd/{prod_id}',[ProductController::class,'DeleteProd']);

// Routes for Wishlists
Route::post('AddWishlist',[WishlistController::class,'AddWishlist']);
Route::delete('DeleteWishlist/{wishlist_id}',[WishlistController::class,'DeleteWishlist']);

// Routes for Store
Route::post('/stores', [StoreController::class, 'addStore']); // Create a new store
// Update Route
Route::put('stores/{id}', [StoreController::class, 'updateStore']);
Route::put('stores/{id}/updateName', [StoreController::class, 'updateStoreName']);
Route::put('stores/{id}/updateDescription', [StoreController::class, 'updateStoreDescription']);
Route::put('stores/{id}/updateStatus', [StoreController::class, 'updateStoreStatus']);

// Delete Route
Route::delete('stores/{id}', [StoreController::class, 'deleteStore']); // Delete a specific store
