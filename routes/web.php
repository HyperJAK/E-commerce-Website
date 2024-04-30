<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\MicrosoftAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\CurrencyConverterController;

// ->middleware('is_admin') to be added for routes l lezim tkun admin
Route::get('home', [StoreController::class, 'getStoresByCategory'])->name('home')->middleware('auth');
Route::get('index', [StoreController::class, 'getIndex'])->name('index');
Route::get('/',[StoreController::class,'getStoresByCategory'])->name('/');

//Products routes
Route::get('getProd/{id}',[ProductController::class,'getProd'])->name('getProd');
Route::get('getAllProd',[ProductController::class,'getAllProd']);
Route::get('getProdName/{name}',[ProductController::class,'getProdName']);
Route::get('getProdCategory/{category_id}',[ProductController::class,'getProdCategory']);
Route::get('getProdStore/{store}',[ProductController::class,'getProdStore']);
Route::get('getProdImages/{id}',[ProductController::class,'getProdImages']);
Route::get('products',[ProductController::class,'getAllProdSmall'])->name('products');
Route::get('getByCat',[ProductController::class,'getProdSmallCat'])->name('getByCat');
Route::get('getByStore',[ProductController::class,'getProdSmallStore'])->name('getByStore');
Route::get('getByStoreCat',[ProductController::class,'getProdSmallStoreCat'])->name('getByStoreCat');
Route::get('prodSearch',[ProductController::class,'getProdSmallSearch'])->name('prodSearch');
Route::get('prodSearchStore',[ProductController::class,'getProdSmallSearchStore'])->name('prodSearchStore');


//Manage products routes
Route::middleware(['auth'/*, 'admin'*/])->group(function () {
    Route::post('AddProd',[ProductController::class,'AddProd'])->name('seller-add-product');
    Route::post('EditProd',[ProductController::class,'EditProd'])->name('seller-edit-product');
    Route::delete('DeleteProd/{prod_id}',[ProductController::class,'DeleteProd'])->name('seller-delete-product');
});

/*Route::get('getAllProdSmall/{page}',[ProductController::class,'getAllProdSmall']);
Route::get('getProdSmallCat/{category_id}/{page}',[ProductController::class,'getProdSmallCat']);
Route::get('getProdSmallStore/{store_id}',[ProductController::class,'getProdSmallStore']);
Route::get('getProdSmallSearch/{search}',[ProductController::class,'getProdSmallSearch']);*/


Route::get('getWishlist/{user_id}',[WishlistController::class,'getWishlist'])->name('getWishlist')->middleware('auth');
Route::get('getNumberWishlist/{product_id}',[WishlistController::class,'getNumberWishlist']);

Route::get('getCartItem/{cart_id}',[CartItemController::class,'getCartItem']);
Route::get('getCarts/{buyer_id}',[CartController::class,'getCarts']);
Route::get('getActiveCart/{buyer_id}',[CartController::class,'getActiveCart'])->name('getActiveCart');
Route::get('getCartItemsBuyerId/{buyer_id}',[CartController::class,'getCartItemsBuyerId']);

//Stores routes
// Read Routes
Route::get('stores/{id}', [StoreController::class, 'getStore']); // Show a specific store
Route::get('getAllStores', [StoreController::class, 'getAllStores'])->name('getAllStores'); // Show a specific store
Route::get('stores/getActiveByUserId/{userId}', [StoreController::class, 'getActiveStoresByUserId']); // Show all active stores for specific user
Route::get('stores/getPendingByUserId/{userId}', [StoreController::class, 'getPendingStoresByUserId']); // Show all pending stores for specific user


// Get Route for Store Status
Route::get('stores/{id}/getStatus', [StoreController::class, 'getStoreStatus']);
// Get Route for Store Creator
Route::get('stores/{id}/getCreator', [StoreController::class, 'getStoreCreator']);
Route::get('SortStoresByCategory/{category_id}', [StoreController::class, 'SortStoresByCategory'])->name('SortStoresByCategory');



//Orders routes
Route::get('/order/create', [OrderController::class, 'createOrderView'])->name('createOrderView');



//Sign up routes
Route::get('/register', [UserController::class, 'showSignUpForm'])->name('register');
Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [UserController::class, 'signup'])->name('signup.process');




Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Route::get('/auth/facebook/redirect', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
// Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

// Route::get('/auth/microsoft/redirect', [MicrosoftAuthController::class, 'redirectToMicrosoft'])->name('auth.microsoft');
// Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'handleMicrosoftCallback']);

Route::get('/auth/microsoft-graph', [MicrosoftAuthController::class, 'redirectToMicrosoftGraph'])->name('auth.microsoft-graph');
Route::get('/auth/microsoft-graph/callback', [MicrosoftAuthController::class, 'handleMicrosoftGraphCallback'])->name('auth.microsoft-graph.callback');


Route::get('/login', [UserController::class, 'showSignInForm'])->name('login');
Route::get('/signin', [UserController::class, 'showSignInForm'])->name('signin');
Route::post('/signin', [UserController::class, 'signin'])->name('signin.process');

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



Route::middleware(['auth'/*, 'admin'*/])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('admin/user-profile', [AdminController::class, 'userProfile'])->name('user-profile');
    Route::get('admin/user-management', [AdminController::class, 'userManagement'])->name('user-management');
    Route::get('admin/tables', [AdminController::class, 'tables'])->name('tables');
    Route::get('admin/billing', [AdminController::class, 'billing'])->name('billing');
    Route::get('admin/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('admin/static-sign-up', [AdminController::class, 'staticSignUp'])->name('static-sign-up');
    Route::get('admin/static-sign-in', [AdminController::class, 'staticSignIn'])->name('static-sign-in');
});


Route::middleware(['auth'/*, 'admin'*/])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller-dashboard');
    Route::get('seller/user-profile', [SellerController::class, 'userProfile'])->name('seller-user-profile');
    Route::get('seller/user-management', [SellerController::class, 'userManagement'])->name('seller-user-management');
    Route::get('seller/tables', [SellerController::class, 'tables'])->name('seller-tables');
    Route::get('seller/billing', [SellerController::class, 'billing'])->name('seller-billing');
    Route::get('seller/notifications', [SellerController::class, 'notifications'])->name('seller-notifications');
    Route::get('seller/profile', [SellerController::class, 'profile'])->name('seller-profile');
    Route::get('seller/static-sign-up', [SellerController::class, 'staticSignUp'])->name('seller-static-sign-up');
    Route::get('seller/static-sign-in', [SellerController::class, 'staticSignIn'])->name('seller-static-sign-in');

    //routes for stores views
    Route::get('seller/createStore', [SellerController::class, 'createStoreViewRedirect'])->name('redirect-create-store');
    Route::get('seller/editStoreOptions', [SellerController::class, 'editStoreViewRedirect'])->name('redirect-edit-store');
    Route::get('seller/editStore', [SellerController::class, 'editStoreView'])->name('view-edit-store');

    //routes for stores logic
    Route::post('seller/createNewStore', [StoreController::class, 'addStore'])->name('seller-create-store');
    Route::post('seller/addCategoryToStore', [StoreController::class, 'addStoreCategory'])->name('seller-add-store-category');
    Route::post('seller/editStore', [StoreController::class, 'updateStore'])->name('seller-edit-store');



    //products routes for views (logic routes are at the begining of this file)
    Route::get('seller/createProduct', [SellerController::class, 'createProductView'])->name('redirect-create-product');
    Route::get('seller/editProductView', [SellerController::class, 'editProductView'])->name('view-edit-product');

    Route::post('seller/updateCategoryToProduct', [ProductController::class, 'updateProductCategory'])->name('seller-update-product-category');

});


Route::middleware('auth')->group(function() {
    Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});


Route::post('/logout',  [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/account', [UserAccountController::class, 'show'])->name('myaccount')->middleware('auth');
Route::post('/account/update', [UserAccountController::class, 'update'])->name('updatemyaccount')->middleware('auth');

Route::get('payment', [PaymentController::class, 'createPayment'])->middleware('auth');
Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment/success');
Route::get('payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment/failure');

Route::get('/maps', [MapsController::class, 'mapShow'])->name('myMap');
Route::post('/save-location', [MapsController::class, 'saveLocation'])->name('savemyLocation')->middleware('auth');


Route::get('/currency-converter', [CurrencyConverterController::class, 'index'])->name('currency_converter.index');
Route::post('/currency-converter/convert', [CurrencyConverterController::class, 'convert'])->name('currency_converter.convert');


