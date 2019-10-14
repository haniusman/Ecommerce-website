<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/welcome',function(){
    return view('welcome');
});*/

//Front Routes are listed below
//Index page
Route::get('/','IndexController@index');
Auth::routes();
//category listing page/Home page
Route::get('/products/{url}','ProductsController@products');
//Category detail page
Route::get('product/{id}','ProductsController@product');
//Cart Page
Route::match(['get','post'],'/cart','ProductsController@cart');
//Add to cart route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');
//Update quantity
Route::get('cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
//Delete from cart
Route::get('cart/delete-product/{id}','ProductsController@deleteCartProduct');
//Apply Coupon code
Route::post('cart/apply-coupon','ProductsController@applyCoupon');
//Get product attribute price
Route::get('/get-product-price','ProductsController@getProductPrice');
//user login route are listed below
Route::get('/login-register','UsersController@userloginRegister');
//user register
Route::post('/user-register','UsersController@register');
//user login
Route::post('/user-login','UsersController@login');
//user logout
Route::get('/user-logout','UsersController@logout');

//Routes after user login
Route::group(['middleware'=>['frontlogin']],function(){
    //User Account
    Route::match(['get','post'],'account','UsersController@account');
    //check current pass
    Route::post('check-user-pwd','UsersController@chkUserPassword');
    //update user password
    Route::post('/update-user-pwd','UsersController@updatePassword');
    //checkout page
    Route::match(['get','post'],'checkout','ProductsController@checkout');
    //order review page
    Route::match(['get','post'],'order-review','ProductsController@orderReview');
    //place order
    Route::match(['get','post'],'place-order','ProductsController@placeOrder');
    //Thankyou page
    Route::get('thanks','ProductsController@thanks');
    //Users orders page
    Route::Get('orders','ProductsController@userOrders');
    //Users ordered products page
    Route::Get('orders/{id}','ProductsController@userOrderDetails');
    // Paypal Page
    Route::get('paypal','ProductsController@paypal');
});
//Route::match(['get','post'],'/login-register','UsersController@register');

//Check if user already exists
Route::match(['get','post'],'/check-email','UsersController@checkEmail');

/*  Admin routes are listed below    */

Route::group(['prefix'=>'admin1'],function(){
    Route::match(['get','post'],'/','AdminController@login');
    Route::get('register','AdminController@register');
    Route::post('newuser','AdminController@store');
    Route::get('dashboard', 'AdminController@dashboard')->middleware('admin');
    Route::group(['middleware'=>'auth'],function() {

        Route::get('changepassword', 'HomeController@showChangePasswordForm');
        Route::post('change', 'HomeController@changePassword');
        /* Routes for user option */
        Route::get('userslist','UserController@index');
        Route::resource('users','UserController');

        //Category routes
        Route::match(['get','post'],'add-category','CategoryController@addCategory');
        Route::match(['get','post'],'edit-category/{id}','CategoryController@editCategory');
        Route::match(['get','post'],'delete-category/{id}','CategoryController@deleteCategory');
        Route::get('categorieslist','CategoryController@showCategories');

        //Product routes
        Route::match(['get','post'],'add_product','ProductsController@addProduct');
        Route::get('productslist','ProductsController@showProducts');
        Route::match(['get','post'],'edit-product/{id}','ProductsController@editProduct');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
        Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
        Route::get('delete-alt-image/{id}','ProductsController@deleteAltImage');


        //Products Attribute routes
        Route::match(['get','post'],'add-attribute/{id}','ProductsController@addAttributes');
        Route::match(['get','post'],'edit-attribute/{id}','ProductsController@editAttributes');
        Route::get('delete-attribute/{id}','ProductsController@deleteAttributes');

        //Alternate product images
        Route::match(['get','post'],'add-images/{id}','ProductsController@addImages');

        //Coupon Routes
        Route::match(['get','post'],'add-coupon','CouponsController@addCoupon');
        Route::get('couponslist','CouponsController@showCoupons');
        Route::match(['get','post'],'edit-coupon/{id}','CouponsController@editCoupon');
        Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');

        //Banners Routes
        Route::match(['get','post'],'add-banner','BannersController@addBanner');
        Route::get('bannerslist','BannersController@showBanners');
        Route::match(['get','post'],'edit-banner/{id}','BannersController@editBanner');
        Route::get('delete-banner/{id}','BannersController@deleteBanner');

        //Orders Routes
        Route::get('orderslist','ProductsController@showOrders');
        // User Ordered Products Details
        Route::get('orderslist/{id}','ProductsController@viewOrderDetails');

//        Route::get('bannerslist/getposts','BannersController@getPosts')->name('bannerslist.getposts');
//        Route::get('bannerslist/getposts', ['as'=>'bannerslist.getposts','uses'=>'BannersController@getPosts']);
    });
});
Route::get('/logout','AdminController@logout');

//Route::get('/admin1','AdminController@login');


Route::group(['prefix'=>'user'] ,function(){
    Route::get('/',function(){
        return view('welcome');
    });
    Route::group(['middleware'=>'auth'],function() {
        Route::get('/home','HomeController@index');
    });

});



