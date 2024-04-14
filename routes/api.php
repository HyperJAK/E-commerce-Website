<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::post('AddProd',[ProductController::class,'AddProd']);
Route::post('EditProd',[ProductController::class,'EditProd']);
Route::post('DeleteProd',[ProductController::class,'DeleteProd']);
Route::post('AddWishlist',[WishlistController::class,'AddWishlist']);

