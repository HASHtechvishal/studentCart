<?php

use Illuminate\Support\Facades\Route;
use App\Category;

Route::get('/', function () {
    return view('welcome');
}); 
Route::view('str','e-com_str');
Route::view('str2','e-com_str2');
Route::view('str3','e-com_str3');
Route::view('str4','e-com_str4');
Route::view('str5','e-com_str5');
Route::view('str6','e-com_str6');
Route::view('str7','e-com_str7'); 
Route::view('str8','e-com_str8');

//Route::view('lay','layouts.e-com admin layout.admin_layout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 
///////////////admin routes//////////////////////////////////

Route::prefix('/admin')->namespace('admin')->group(function(){//namespacep controller folder
	//all admin route place here
	Route::group(['middleware' => ['admin']],function(){
			Route::get('/dashboard','admin_controller@dash');
			Route::get('/setting','admin_controller@set'); 
			Route::get('/logout','admin_controller@out');
			Route::post('/check-current-pwd','admin_controller@check_pass');
			Route::post('/update','admin_controller@update');
			Route::match(['get','post'],'update_admin_data','admin_controller@update_admin'); 
///////////////////////////////////////////////////////////////////
//sections
            Route::get('section','section_controller@section');	
            Route::post('update-section-status',' section_controller@updateSectionStatus');

//brands
            Route::get('brand','brand_controller@brands');
            Route::post('update_brand','brand_controller@updateBrandStatus');
            Route::match(['get','post'],'add_edit_brand/{id?}','brand_controller@add_edit_brand'); 
            Route::get('delete_brand/{id}','brand_controller@delete_brand');             

//categories
            Route::get('categories','category_controller@cate');
            Route::post('update-category-status','category_controller@updateCategoryStatus');
            Route::match(['get','post'],'add_edit_category/{id?}','category_controller@add_edit');//?in id means it may come or may not come  or id is optional
            Route::post('category_level','category_controller@cateLevel'); 
            Route::get('delete_category_image/{id}','category_controller@delete_image');
            Route::get('delete_category/{id}','category_controller@delete_category');
//products
            Route::get('products','product_controller@items');
            Route::post('update-product-status','product_controller@updateProductStatus');
            Route::get('delete_product/{id}','product_controller@delete_product');
            Route::match(['get','post'],'add_edit_product/{id?}','product_controller@add_edit_pro');
            Route::get('delete_product_image/{id}','product_controller@delete_pro_image');
            Route::get('delete_product_video/{id}','product_controller@delete_pro_video');

//attributes 

            Route::match(['get','post'],'add_attri/{id}','product_controller@add_attribute');    
            Route::post('edit_attr/{id}','product_controller@edit_attribute');
            Route::post('update_attribute','product_controller@updateAttribute');
            Route::get('delete_attribute/{id}','product_controller@deleteAttribute'); 

 //images route           
            Route::match(['get','post'],'add_image/{id}','product_controller@add_image'); 
            Route::post('update_image','product_controller@updateImage');
           Route::get('delete_image/{id}','product_controller@deleteImage');

//banner 
           Route::get('banner','banner_controller@banner');
           Route::post('update_banner','banner_controller@updateBanner');
           Route::get('delete_banner/{id}','banner_controller@deleteBanner');
           Route::match(['get','post'],'add_edit_banner/{id?}','banner_controller@addedit_banner');
//coupons
           Route::get('coupons','CouponsController@coupons');
           Route::post('update-coupon-status','CouponsController@updateCouponStatus');
           Route::match(['get','post'],'add_edit_coupon/{id?}','CouponsController@addedit_coupon');
           Route::get('delete_coupon/{id}','CouponsController@deleteCoupon');

//orders        
           Route::get('orders','OrdersController@orders');
           Route::get('orders/{id}','OrdersController@ordersDetails');
           Route::post('update-order-status','OrdersController@updateOrderStatus');
           Route::get('view-order-invoice/{id}','OrdersController@viewOrderInvoice');            

}); 
    Route::match(['get','post'],'login','admin_controller@login');//use match for admin login us we use both get and post
});

//as it is the front route so we dont need to give prefix
Route::namespace('front')->group(function(){
    Route::get('/','IndexController@index');

    //listing/categories Route
    //Route::get('index/{url}','product_controller@listing');
    $cate_url = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
    ///echo "<pre>"; print_r($cate_url); die;
    foreach ($cate_url as $url) {
        Route::get('/'.$url,'product_controller@listing');
    }

    Route::get('/product_details/{id}','product_controller@details');
    //get product detail route
    Route::post('get-product-price','product_controller@getProductPrice');


    Route::get('/contact-us',function(){
        echo "test"; die;
    });

    // add to ca rt

    Route::post('/add-to-cart','product_controller@addtocart');

    //shopping cart
    Route::get('/cart','product_controller@cart');

    //update cart item qty
    Route::post('/update-cart-item-qty','product_controller@updateCartItemQty');

    //delete cart items
    Route::post('/delete-cart-item','product_controller@deletCartItem');

    //login register page
    Route::get('/login-register',['as'=>'login','uses'=>'UsersController@loginRegister']);

    //login user 
    Route::post('/login','UsersController@loginUser');

    //register user
    Route::post('/register','UsersController@RegisterUser');

    //logout user
    Route::get('/logout','UsersController@logoutUser');

    //check ifemail is already exist
    Route::match(['get','post'],'/check-email','UsersController@checkEmail');

    //confirm account
    Route::match(['get','post'],'/confirm/{code}','UsersController@confirmAccount');


    Route::group(['middleware'=>['auth']],function(){

    //user account page
    Route::match(['get','post'],'account','UsersController@account');

    //user orders
    Route::get('/orders','OrdersController@orders');

    //USERorder details
     Route::get('/orders/{id}','OrdersController@ordersDetails');

    //user update password
    Route::post('/update-user-password','UsersController@updateUserPassword');

    //check user current password
    Route::post('/check-user-pwd','UsersController@chkUserPassword');

    //apply coupon
        Route::post('/apply-coupon','product_controller@applyCoupon');

    //checkout
        Route::match(['get','post'],'checkout','product_controller@checkout');
    //add edit address
        Route::match(['get','post'],'/add_editAddess/{id?}','product_controller@addEditAddress');

    //delete address
        Route::get('/DeleteAddess/{id}','product_controller@delete_address');

    //thanks page
        Route::get('/thanks','product_controller@thanks');
        
    });

            //forgiot password
    Route::match(['get','post'],'forgot_password','UsersController@forgotPassword');

}); 

 






 
























