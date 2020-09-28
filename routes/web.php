<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/search','HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');

//category view
Route::get('/view-category/{category_id}','categoryController@View_category');

//brand view
Route::get('/view-brand/{brand_id}','BrandController@View_brand');

//details product view
Route::get('/details-product/{product_id}','productController@details_product');

//send mail
Route::get('/send-mail','AdminController@send_mail');

//backend
Route::get('/login','AdminController@login');
Route::get('/register','AdminController@register');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::post('/check-register','AdminController@check_register');
Route::get('/check-auth','AdminController@check_auth');
Route::post('/checkcode-auth/{user_id}','AdminController@checkcode_auth');

Route::get('/add-user','AdminController@add_user');
Route::get('/all-user','AdminController@all_user');
Route::post('/save-user','AdminController@save_user');
Route::get('/active-user/{user_id}','AdminController@active_user');
Route::get('/unactive-user/{user_id}','AdminController@unactive_user');
Route::get('/edit-user/{user_id}','AdminController@edit_user');
Route::post('/update-user/{user_id}','AdminController@update_user');
Route::get('/delete-user/{user_id}','AdminController@delete_user');
//doanh thu
Route::get('/revenue','AdminController@revenue');
//category

Route::get('/add-category','categoryController@add_category');

Route::get('/edit-category/{category_id}','categoryController@edit_category');
Route::get('/delete-category/{category_id}','categoryController@delete_category');

Route::get('/active-category/{category_id}','categoryController@active_category');
Route::get('/unactive-category/{category_id}','categoryController@unactive_category');

Route::get('/all-category','categoryController@all_category');

Route::post('/save-category','categoryController@save_category');
Route::post('/update-category/{category_id}','categoryController@update_category');

//Brand-product
Route::get('/add-brand','BrandController@add_Brand');

Route::get('/edit-brand/{brand_id}','BrandController@edit_Brand');
Route::get('/delete-brand/{brand_id}','BrandController@delete_Brand');

Route::get('/active-brand/{brand_id}','BrandController@active_brand');
Route::get('/unactive-brand/{brand_id}','BrandController@unactive_brand');

Route::get('/all-brand','BrandController@all_Brand');

Route::post('/save-brand','BrandController@save_Brand');
Route::post('/update-brand/{brand_id}','BrandController@update_Brand');
//category-post
Route::get('/add-cate-post','CatePostController@add_cate_post');
Route::post('/save-cate-post','CatePostController@save_cate_post');
Route::get('/all-cate-post','CatePostController@all_cate_post');

Route::get('/active-catepost/{cate_post_id}','CatePostController@active_catepost');
Route::get('/unactive-catepost/{cate_post_id}','CatePostController@unactive_catepost');
Route::get('/edit-catepost/{cate_post_id}','CatePostController@edit_catepost');
Route::post('/update-cate-post/{cate_post_id}','CatePostController@update_cate_post');
// cate_post
Route::get('/view-cate-post/{cate_post_id}','CatePostController@view_cate_post');
//post
Route::get('/add-post','PostController@add_post');
Route::get('/all-post','PostController@all_post');
Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::post('/update-post/{post_id}','PostController@update_post');

Route::post('/save-post','PostController@save_post');

Route::get('/active-post/{post_id}','PostController@active_post');
Route::get('/unactive-post/{post_id}','PostController@unactive_post');

//post view
Route::get('/view-post/{post_id}','PostController@view_post');

//product
Route::get('/add-product','productController@add_Product');

Route::get('/edit-product/{product_id}','productController@edit_Product');
Route::get('/delete-product/{product_id}','productController@delete_Product');

Route::get('/active-product/{product_id}','productController@active_product');
Route::get('/unactive-product/{product_id}','productController@unactive_product');

Route::get('/all-product','productController@all_Product');

Route::post('/save-product','productController@save_Product');
Route::post('/update-product/{product_id}','productController@update_Product');

// cart
Route::post('/save-cart','cartController@save_cart');
Route::post('/update-cart-qty','cartController@update_cart_qty');
Route::get('/show-cart','cartController@show_cart');
Route::get('/delete-all-cart','cartController@delete_all_cart');
// Route::get('/delete-to-cart/{rowId}','cartController@delete_to_cart');
Route::post('/add-cart-ajax','cartController@add_cart_ajax');
Route::get('/gio-hang','cartController@gio_hang');
Route::post('/update-cart','cartController@update_cart');
Route::get('/delete-cart-pr/{session_id}','cartController@delete_cart_pr');


//coupon
Route::post('/check-coupon','CouponController@check_coupon');
Route::get('/delete-coupon','CouponController@del_coupon');
//admin coupon
Route::get('/add-coupon','CouponController@add_coupon');
Route::get('/all-coupon','CouponController@all_coupon');
Route::get('/edit-coupon/{coupon_id}','CouponController@edit_coupon');
Route::post('/update-coupon/{coupon_id}','CouponController@update_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::post('/save-coupon','CouponController@save_coupon');

//checkout
Route::get('/login-checkout','checkoutController@login_checkout');
Route::get('/logout-checkout','checkoutController@logout_checkout');
// Route::post('/add-user','checkoutController@add_user');
Route::post('/order-place','checkoutController@order_place');
Route::post('/login-user','checkoutController@login_user');
Route::get('/checkout','checkoutController@checkout');
Route::get('/payment','checkoutController@payment');
Route::post('/save-info-order','checkoutController@save_info_order');
Route::post('/select-delivery-home','checkoutController@select_delivery_home');
Route::post('/calculate-fee','checkoutController@calculate_fee');
Route::get('/del-fee','checkoutController@del_fee');
Route::post('/confirm-order','checkoutController@confirm_order');


//order
Route::get('/manager-order','OrderController@manager_order');
Route::get('/manager-order-new','OrderController@manager_order_new');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/order-follow/{user_id}','OrderController@order_follow');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::post('/order-update-qty','OrderController@order_update_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::get('/follow-order/{user_id}','OrderController@show_order');
Route::get('/order-details/{order_code}','OrderController@order_details');
Route::get('/follow-delivery/{order_code}','OrderController@follow_delivery');
Route::get('/cancel-order/{order_code}','OrderController@cancel_order');

//delivery
Route::get('/delivery', 'DeliveryController@manager_delivery');
Route::post('/select-delivery', 'DeliveryController@select_delivery');
Route::post('/add-delivery', 'DeliveryController@add_delivery');
Route::post('/all-feeship', 'DeliveryController@all_feeship');
Route::post('/update-delivery', 'DeliveryController@update_delivery');

//Banner
Route::get('/manage-slider', 'SliderController@manage_slider');
Route::get('/add-slider', 'SliderController@add_slider');
Route::post('/insert-slider', 'SliderController@insert_slider');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');

