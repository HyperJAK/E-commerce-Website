<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;



Route::get('/', function () {
    return view('welcome');
});


//Products routes
Route::get('getProd/{id}',[ProductController::class,'getProd']);
Route::get('getAllProd',[ProductController::class,'getAllProd']);
Route::get('getProdName/{name}',[ProductController::class,'getProdName']);
Route::get('getProdCategory/{category_id}',[ProductController::class,'getProdCategory']);
Route::get('getProdStore/{store}',[ProductController::class,'getProdStore']);
Route::get('getProdImages/{id}',[ProductController::class,'getProdImages']);
Route::get('getAllProdSmall',[ProductController::class,'getAllProdSmall']);
Route::get('getProdSmallCat/{category_id}',[ProductController::class,'getProdSmallCat']);
Route::get('getProdSmallStore/{store_id}',[ProductController::class,'getProdSmallStore']);
Route::get('getProdSmallSearch/{search}',[ProductController::class,'getProdSmallSearch']);
Route::get('getWishlist/{user_id}',[WishlistController::class,'getWishlist']);

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






//Sign up routes
Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');



Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook/redirect', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

Route::get('/auth/microsoft/redirect', [SocialAuthController::class, 'redirectToMicrosoft'])->name('auth.microsoft');
Route::get('/auth/microsoft/callback', [SocialAuthController::class, 'handleMicrosoftCallback']);



Route::get('/signin', [UserController::class, 'showSignInForm'])->name('signin');
Route::post('/signin', [UserController::class, 'signin']);

Route::get('/verify-email', [UserController::class, 'verifyEmail'])->name('verify.email');

Route::get('/verify-email/{token}', [UserController::class, 'verifyEmail']);


//sending to mailpit
// Route::get('/test-email', function () {
//     Mail::raw('This is a test email.', function ($message) {
//         $message->to('charbelse01@gmail.com')
//                 ->subject('Test Email');
//     });
//     return 'Test email sent!';
// });


Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('charbelse01@gmail.com')  
                ->subject('Test Email');
    });
    return 'Test email sent!';
});


Route::get('/password/forgot', [UserController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/password/forgot', [UserController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('password.update');



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


Route::middleware('auth')->group(function() {
    Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});