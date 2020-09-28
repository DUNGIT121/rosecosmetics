<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_product;
use App\Model\tbl_category;
use App\Model\tbl_Brand;
use App\Model\tbl_slide;
use App\Model\tbl_category_post;
use Carbon\carbon;
use Cart;

session_start();

class cartController extends Controller
{
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            $message = '';
            foreach ($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach ($cart as $session => $val){
                    $i++;
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:green">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message',$message);
        }else{
            return Redirect()->back()->with('messages','Cập nhật số lượng sản phẩm trong giỏ hàng Không thành công');
        }
    }

    public function delete_cart_pr($session_id ){
        $cart = Session::get('cart');
        if($cart == true){
            foreach ($cart as $key => $val) {
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Xóa sản phẩm trong giỏ hàng thành công');
        }else{
            return Redirect()->back()->with('messages','Xóa sản phẩm trong giỏ hàng Không thành công');
        }
    }
    public function gio_hang(Request $request){
        $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
        $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
        $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
        $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
      $meta_desc ="giỏ hàng của bạn";
      $meta_keywords = "gio hang cua ban";
      $meta_title = "giỏ hàng";
      $meta_canonical = $request->url();
      return view('pages.cart.cart_ajax')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post'));
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable ++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name'=> $data['cart_product_name'],
                    'product_id'=> $data['cart_product_id'],
                    'product_image'=> $data['cart_product_image'],
                    'product_quantity'=> $data['cart_product_quantity'],
                    'product_qty'=> $data['cart_product_qty'],
                    'product_price'=> $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=> $data['cart_product_id'],
                'product_image'=> $data['cart_product_image'],
                'product_quantity'=> $data['cart_product_quantity'],
                'product_qty'=> $data['cart_product_qty'],
                'product_price'=> $data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }
        
        Session::save();
    }
    
    public function save_cart(Request $request){
    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;

    	$dt=tbl_product::where('product_id',$productId)->first();
    	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    	// Cart::destroy();
    	$data['id'] = $productId;
    	$data['qty'] = $quantity;
    	$data['name'] = $dt->product_name;
    	$data['price'] = $dt->output_price;
    	$data['weight'] = $dt->weight;
    	$data['options']['image'] = $dt->images;
    	Cart::add($data);
    	return Redirect()->back()->with('message','thêm vào giỏ hàng thành công');
        // Cart::destroy();
    }
    public function show_cart(Request $request){
    	$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
    	$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
      $meta_desc ="giỏ hàng của bạn";
      $meta_keywords = "gio hang cua ban";
      $meta_title = "giỏ hàng";
      $meta_canonical = $request->url();
      return view('pages.cart.show_cart')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical'));
  }
//   public function delete_to_cart($rowId){
//    Cart::update($rowId,0);
//    return Redirect::to('/show-cart');
// }
public function delete_all_cart(){
    $cart = Session::get('cart');
    if($cart == true){
        Session::forget('cart');
        return Redirect()->back()->with('message','Xóa giỏ hàng thành công');
    }
}
public function update_cart_qty(Request $request){
   $rowId = $request->rowId_cart;
   $qty = $request->cart_quantity;
   Cart::update($rowId,$qty);
   return Redirect()->back();
}
}
