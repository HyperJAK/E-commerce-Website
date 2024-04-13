<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::post('AddProd',[ProductController::class,'AddProd']);


// Routes for Store
Route::post('/stores', [StoreController::class, 'addStore']); // Create a new store


// Update Route
Route::put('stores/{id}', [StoreController::class, 'updateStore']);
Route::put('stores/{id}/updateName', [StoreController::class, 'updateStoreName']);
Route::put('stores/{id}/updateDescription', [StoreController::class, 'updateStoreDescription']);
Route::put('stores/{id}/updateStatus', [StoreController::class, 'updateStoreStatus']);

// Delete Route
Route::delete('stores/{id}', [StoreController::class, 'deleteStore']); // Delete a specific store
