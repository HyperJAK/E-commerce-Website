<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::post('AddProd',[ProductController::class,'AddProd']);
Route::post('EditProd',[ProductController::class,'EditProd']);
Route::delete('DeleteProd/{prod_id}',[ProductController::class,'DeleteProd']);
Route::post('AddWishlist',[WishlistController::class,'AddWishlist']);

