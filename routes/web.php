<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotmanController;
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

use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminStoreController;

use App\Http\Controllers\MapsController;
use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\EventController;


// ->middleware('is_admin') to be added for routes l lezim tkun admin
Route::get('home', [StoreController::class, 'getStoresByCategory'])->name('home')->middleware('auth');
Route::get('index', [StoreController::class, 'getIndex'])->name('index');
Route::get('/',[StoreController::class,'getStoresByCategory'])->name('/');

//Products routes

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

Route::middleware('regular_user')->group(function() {
Route::get('getProd/{id}',[ProductController::class,'getProd'])->name('getProd');

Route::get('getWishlist/{user_id}',[WishlistController::class,'getWishlist'])->name('getWishlist');
Route::get('getNumberWishlist/{product_id}',[WishlistController::class,'getNumberWishlist']);

Route::get('getCartItem/{cart_id}',[CartItemController::class,'getCartItem']);
Route::get('getCarts/{buyer_id}',[CartController::class,'getCarts']);
Route::get('getActiveCart/{buyer_id}',[CartController::class,'getActiveCart'])->name('getActiveCart');
Route::get('getCartItemsBuyerId/{buyer_id}',[CartController::class,'getCartItemsBuyerId']);

});
//Manage products routes
Route::middleware(['is_seller'])->group(function () {
    Route::post('AddProd',[ProductController::class,'AddProd'])->name('seller-add-product');
    Route::post('EditProd',[ProductController::class,'EditProd'])->name('seller-edit-product');
    Route::delete('DeleteProd/{prod_id}',[ProductController::class,'DeleteProd'])->name('seller-delete-product');
});

/*Route::get('getAllProdSmall/{page}',[ProductController::class,'getAllProdSmall']);
Route::get('getProdSmallCat/{category_id}/{page}',[ProductController::class,'getProdSmallCat']);
Route::get('getProdSmallStore/{store_id}',[ProductController::class,'getProdSmallStore']);
Route::get('getProdSmallSearch/{search}',[ProductController::class,'getProdSmallSearch']);*/




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


Route::middleware(['is_seller'])->group(function () {
    //routes for dashboards
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller-dashboard');
    Route::get('seller/specificStoreDashboard', [SellerController::class, 'specificStoreDashboard'])->name('specificStoreDashboard');

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



    //seller reports functions are here:

    //these routes to get today income
    Route::get('seller/getTodayIncome', [OrderController::class, 'getTodayIncome'])->name('getTodayIncome');
    Route::get('seller/getTodayIncomeSpecificStore', [OrderController::class, 'getTodayIncomeSpecificStore'])->name('getTodayIncomeSpecificStore');

    //these routes to get today clients (general so doesnt have to be new)
    Route::get('seller/getTodayClients', [OrderController::class, 'getTodayClients'])->name('getTodayClients');
    Route::get('seller/getTodaySpecificStoreClients', [OrderController::class, 'getTodaySpecificStoreClients'])->name('getTodaySpecificStoreClients');

    //these routes to get today NEW clients
    Route::get('seller/getTodayNewClients', [OrderController::class, 'getTodayNewClients'])->name('getTodayNewClients');
    Route::get('seller/getTodaySpecificStoreNewClients', [OrderController::class, 'getTodaySpecificStoreNewClients'])->name('getTodaySpecificStoreNewClients');

    //these routes to get total sales
    Route::get('seller/getTotalSales', [OrderController::class, 'getTotalSales'])->name('getTotalSales');
    Route::get('seller/getTotalSalesSpecificStore', [OrderController::class, 'getTotalSalesSpecificStore'])->name('getTotalSalesSpecificStore');

    //these routes to get sorted orders by month
    Route::get('seller/getOrdersSortedByMonth', [OrderController::class, 'getOrdersSortedByMonth'])->name('getOrdersSortedByMonth');
    Route::get('seller/getOrdersSpecificStoreSortedByMonth', [OrderController::class, 'getOrdersSpecificStoreSortedByMonth'])->name('getOrdersSpecificStoreSortedByMonth');

    //these routes to get sorted orders by day
    Route::get('seller/getOrdersSortedByDay', [OrderController::class, 'getOrdersSortedByDay'])->name('getOrdersSortedByDay');
    Route::get('seller/getOrdersSpecificStoreSortedByDay', [OrderController::class, 'getOrdersSpecificStoreSortedByDay'])->name('getOrdersSpecificStoreSortedByDay');

    //routes for best selling products
    Route::get('seller/getBestSellingProductsThisMonth', [OrderController::class, 'getBestSellingProductsThisMonth'])->name('getBestSellingProductsThisMonth');
    Route::get('seller/getSpecificStoreBestSellingProductsThisMonth', [OrderController::class, 'getSpecificStoreBestSellingProductsThisMonth'])->name('getSpecificStoreBestSellingProductsThisMonth');

    //Route for store to change status from open to closed
    Route::get('seller/store-status-change', [StoreController::class, 'updateStoreStatus'])->name('store-status-change');
});


Route::middleware('auth')->group(function() {
    Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});


Route::post('/logout',  [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/account', [UserAccountController::class, 'show'])->name('myaccount')->middleware('auth');
Route::post('/account/update', [UserAccountController::class, 'update'])->name('updatemyaccount')->middleware('auth');

Route::get('payment', [PaymentController::class, 'createPayment'])->middleware('regular_user')->name('payment');
Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment/success');
Route::get('payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment/failure');


/*Route::get('/maps', [MapsController::class, 'mapShow'])->name('myMap');
Route::post('/save-location', [MapsController::class, 'saveLocation'])->name('savemyLocation')->middleware('auth');*/


Route::get('/currency-converter', [CurrencyConverterController::class, 'index'])->name('currency_converter.index');
Route::post('/currency-converter/convert', [CurrencyConverterController::class, 'convert'])->name('currency_converter.convert');


Route::get('/maps', [MapsController::class, 'mapShow'])->name('myMap');
Route::post('/save-location', [MapsController::class, 'saveLocation'])->name('savemyLocation')->middleware('auth');



//messages seller routes
Route::get('messages/{id}',[MessageController::class,'index'])->name('messages');
Route::get('chat/{sellerid}/{buyerid}',[MessageController::class,'chat'])->name('chat');
Route::post('selleraddmsg',[MessageController::class,'selleraddmsg'])->name('selleraddmsg');


//messages buyer routes
Route::get('messagesbuyer/{id}',[MessageController::class,'indexBuyer'])->name('messagesBuyer');
Route::get('chatBuyer/{buyerid}/{sellerid}',[MessageController::class,'chatBuyer'])->name('chatBuyer');
Route::post('buyeraddmsg',[MessageController::class,'buyeraddmsg'])->name('buyeraddmsg');


Route::get('viewbot', [BotmanController::class, 'Botmanview']);


//Orders routes
Route::get('/order/create', [OrderController::class, 'createOrderView'])->name('createOrderView');

//Route to place an order for user from his cart
Route::post('order/placeOrder',[OrderController::class,'placeOrder'])->name('place-order');

//route to update user selected currency
Route::post('user/updateCurrency',[UserController::class,'updatePreferredCurrency'])->name('update-preferred-currency');



//admin routes


Route::middleware('is_admin')->group(function() {
    Route::get('homeAdmin/{id}', [AdminController::class, 'homeAdmin'])->name('homeAdmin');
    Route::get('infosAdmin/{id}', [AdminController::class, 'infosAdmin'])->name('infosAdmin');
    Route::post('updateInfoAdmin/{id}', [AdminController::class, 'UpdateInfoAdmin'])->name('updateInfoAdmin');
    Route::get('allUsers/{id}', [AdminController::class, 'findallUsers'])->name('allUsers');

    Route::get('updateUser/{id}/{idUser}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::post('saveUpdateUser/{id}/{idUser}', [AdminController::class, 'saveUpdateUser'])->name('saveUpdateUser');

    Route::get('deleteUser/{id}/{idUser}', [AdminController::class, 'deleteUser'])->name('deleteUser');

    Route::get('AllStores/{id}', [AdminStoreController::class, 'allStore'])->name('AllStores');
    Route::get('searchStores/{id}', [AdminStoreController::class, 'searchStores'])->name('searchStores');
    Route::post('searchStores/{id}', [AdminStoreController::class, 'searchByName'])->name('searchStores1');


    Route::get('deleteStore/{id}/{idStore}', [AdminStoreController::class, 'deleteStore'])->name('deleteStore');
    Route::get('storeActivate/{id}/{idStore}', [AdminStoreController::class, 'storeActivate'])->name('storeActivate');

    Route::post('saveActivation/{id}/{idStore}', [AdminStoreController::class, 'saveActivation'])->name('saveActivation');



//event routes


Route::get('storeevents/{storeid}',[EventController::class,'index'])->name('index');

Route::post('addevent',[EventController::class,'addevent'])->name('addevent');

