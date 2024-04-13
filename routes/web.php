<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Products routes
Route::get('getProd/{id}',[ProductController::class,'getProd']);
Route::get('getAllProd',[ProductController::class,'getAllProd']);
Route::get('getProdName/{name}',[ProductController::class,'getProdName']);
Route::get('getProdCategory/{category}',[ProductController::class,'getProdCategory']);
Route::get('getProdStore/{store}',[ProductController::class,'getProdStore']);
Route::get('getProdImages/{id}',[ProductController::class,'getProdImages']);


Route::get('/', [MainPageController::class, 'site']); // Show a specific store

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Show a specific store
Route::get('/user-profile', [DashboardController::class, 'userProfile'])->name('user-profile');
Route::get('/user-management', [DashboardController::class, 'userManagement'])->name('user-management');
Route::get('/tables', [DashboardController::class, 'tables'])->name('tables');
Route::get('/billing', [DashboardController::class, 'billing'])->name('billing');
Route::get('/rtl', [DashboardController::class, 'rtl'])->name('rtl');
Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
Route::get('/static-sign-up', [DashboardController::class, 'staticSignUp'])->name('static-sign-up');
Route::get('/static-sign-in', [DashboardController::class, 'staticSignIn'])->name('static-sign-in');



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


