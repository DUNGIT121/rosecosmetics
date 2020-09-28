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
use App\Model\tbl_user;
use App\Model\tbl_order;
use App\Model\tbl_slide;
use App\Model\tbl_details_order;
use carbon\carbon;
use Cart;
use App\Model\tbl_tinhthanhpho;
use App\Model\tbl_quanhuyen;
use App\Model\tbl_xaphuongthitran;
use App\Model\tbl_feeship;
use App\Model\tbl_category_post;
use Mail;

session_start();

class checkoutController extends Controller
{
	public function AuthLogin(){
        $user_id = session::get('user_id');
        $role = session::get('role_id');
        if($user_id && $role == 3){
            return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('trang-chu')->send(); 
        }
    }
	public function confirm_order(Request $request){
		

		$data = $request->all();
		$order = new tbl_order();
		$order->user_id = Session::get('user_id');
		$order->customer_name = $data['customer_name'];
		$order->email = $data['email'];
		$order->delivery_address = $data['delivery_address'];
		$order->phone = $data['phone'];
		$order->description = $data['description'];
		$order->payment_method = $data['payment_method'];
		$order->status = 1;
		$checkout_code = substr(md5(microtime()),rand(0,26),10);
		$order->order_code = $checkout_code;
		$order->created_at = carbon::now()->toDateString();
		$order->delivery_date = carbon::now()->addday(7)->toDateString();
		if($data['customer_name']=='' || $data['email']=='' || $data['delivery_address']=='' || $data['phone']=='' || $data['payment_method']==''){
			Session::put('messages','Vui lòng điền đầy đủ thông tin trước khi đặt hàng');
		}else{
			$order->save();
		}
		
		$order_id = $order->order_id;	
		$cart_items = Session::get('cart');
		$user_name = Session::get('user_name');
		$email = Session::get('email');
		if(Session::get('cart')==true){
			foreach(Session::get('cart') as $key=>$cart){

				$order_details = new tbl_details_order();
				$order_details->order_code = $checkout_code;
				$order_details->product_id = $cart['product_id'];
				$order_details->order_id = $order_id;
				$order_details->product_name = $cart['product_name'];
				$order_details->product_price = $cart['product_price'];
				$order_details->product_sales_qty = $cart['product_qty'];
				$order_details->order_coupon = $data['order_coupon'];
				$order_details->order_feeship = $data['order_fee'];
				$order_details->created_at = carbon::now()->toDateString();
				$order_details->save();
			}
		}
		Mail::send('mail.send_order',[
	        'order' => $order,
	        'cart'=> $cart_items,
	        'user_name'=>$user_name,
	        ],function($send) use($user_name,$request){
	            $send->to($request->email,$user_name);
	            $send->from('rosecosmetics121@gmail.com');
	            $send->subject('Theo Dõi Đơn Hàng');
	        });
		Mail::send('mail.send_manage',[
	        'order' => $order,
	        'cart'=> $cart_items,
	        'user_name'=>$user_name,
	        ],function($send) use($user_name,$request){
	            $send->to('rosecosmetics121@gmail.com',$user_name);
	            $send->from($request->email);
	            $send->subject('Đơn Hàng Mới');
	        });
		Session::forget('coupon');
		Session::forget('fee');
		Session::forget('cart');
	}
	public function del_fee(){
		Session::forget('fee');
		return Redirect()->back();
	}
	public function calculate_fee(Request $request){
		$data = $request->all();
		if($data['matp']){
			$feeship = tbl_feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
			if($feeship){
				$count_fee = $feeship->count();
				if($count_fee>0){
					foreach ($feeship as $key => $fee) {
						Session::put('fee',$fee->fee_feeship);
						Session::save();
					}
				}else{
					Session::put('fee',30000);
					Session::save();
				}
			}
			
		}
	}
	public function select_delivery_home(Request $request){
		$data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action']=="city"){
				$select_province = tbl_quanhuyen::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
				$output.='<option>-----chọn Quận/Huyện----</option>';
				foreach($select_province as $key => $province){
				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = tbl_xaphuongthitran::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
				$output.='<option>-----chọn Xã/Phường/Thị Trấn----</option>';
				foreach($select_wards as $key => $ward){
				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
				}
			}
		}
		echo $output;
	}
	public function view_order($orderId){

		$this->AuthLogin();
		$order_by_id = tbl_order::join('tbl_user','tbl_order.user_id','=','tbl_user.user_id')
		->join('tbl_details_order','tbl_order.order_id','=','tbl_details_order.order_id')
		->select('tbl_order.*','tbl_user.*','tbl_details_order.*')->first();

		$manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
		return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
	}
	public function login_checkout(Request $request){
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
			$meta_desc ="trang kiểm tra đăng nhập";
	        $meta_keywords = "trang kiem tra dang nhap";
	        $meta_title = "Đăng nhập thanh toán";
	        $meta_canonical = $request->url();
		// return view('pages.checkout.login_check')->with('category',$category)->with('brand',$brand);
		return view('pages.checkout.login_check')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical','slider'));
	}
	// public function add_user(Request $request){
	// 	$dt = array();
	// 	$dt['user_name'] = $request->name;
	// 	$dt['email'] = $request->email;
	// 	$dt['password'] = md5($request->password);
	// 	$dt['phone'] = $request->phone;
	// 	$dt['address'] = $request->address;
	// 	$dt['status'] = 1;
	// 	$dt['role_id']=1;
	// 	$dt['level']=1;
	// 	$dt['created_at']=carbon::now()->toDateString();

	// 	$user_id=tbl_user::insertGetId($dt);

	// 	Session::put('user_id',$user_id);
	// 	Session::put('user_name',$request->name);
	// 	return Redirect::to('/payment');
	// }
	// public function checkout(Request $request){
	// 	$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
	// 	$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
	// 	$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
	// 		$meta_desc ="trang kiểm tra đăng nhập";
	//         $meta_keywords = "trang kiem tra dang nhap";
	//         $meta_title = "Đăng nhập thanh toán";
	//         $meta_canonical = $request->url();
	// 	// return view('pages.checkout.show_checkout')->with('category',$category)->with('brand',$brand);
	// 	return view('pages.checkout.show_checkout')->with(compact('category','brand','slider','meta_desc','meta_keywords','meta_title','meta_canonical'));
	// }
	// public function save_info_order(Request $request){
	// 	$dt = array();
	// 	$dt['email'] = $request->email;
	// 	$dt['customer_name'] = $request->customer_name;
	// 	$dt['phone'] = $request->phone;
	// 	$dt['address'] = $request->address;
	// 	$dt['description'] = $request->description;
	// 	$dt['created_at']=carbon::now()->toDateString();

	// 	$order_id=tbl_order::insertGetId($dt);

	// 	Session::put('order_id',$order_id);
	// 	return Redirect::to('/payment');
	// }
	public function payment(Request $request){
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
			$meta_desc ="trang thanh toán";
	        $meta_keywords = "trang thanh toan";
	        $meta_title = "Thanh toán giỏ hàng";
	        $meta_canonical = $request->url();
		// return view('pages.checkout.payment')->with('category',$category)->with('brand',$brand);
	        $city = tbl_tinhthanhpho::orderby('matp','ASC')->get();
		return view('pages.checkout.payment')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical','city','slider','cate_post'));
	}
	public function order_place(Request $request){
		//get payment method
		// $dt = array();
		// $dt['payment_method'] = $request->payment_options;
		// $dt['payment_status'] = 'Đang chờ xử lý';
		// $dt['created_at']=carbon::now()->toDateString();
		// $payment_id=tbl_payment::insertGetId($dt);
		// insert order
		

		$order_dt = array();
		$order_dt['user_id'] = Session::get('user_id');
		$order_dt['payment_method'] = $request->payment_method;
		$order_dt['email'] = $request->email;
		$order_dt['customer_name'] = $request->customer_name;
		$order_dt['phone'] = $request->phone;
		$order_dt['address'] = $request->address;
		$order_dt['description'] = $request->description;
		$order_dt['status'] = 'Đang chờ xử lý';
		$order_dt['delivery_date']=carbon::now()->addday(7)->toDateString();
		$order_dt['transport_fee'] = 0;
		$order_dt['total_order'] = Cart::total();
		$order_dt['created_at']=carbon::now()->toDateString();

		$order_id=tbl_order::insertGetId($order_dt);
		//insert order details
		$content = Cart::content();
		foreach ($content as $v_content) {
			$order_details_dt['order_id'] = $order_id;
			$order_details_dt['product_id'] = $v_content->id;
			$order_details_dt['product_name'] = $v_content->name;
			$order_details_dt['product_price'] = $v_content->price;
			$order_details_dt['product_sales_qty'] = $v_content->qty;
			$order_details_dt['created_at']=carbon::now()->toDateString();

			tbl_details_order::insert($order_details_dt);	
		}
		if ($dt['payment_method']==1) {
			echo 'Thanh toán online';
		}else{
			
			Cart::destroy();
			$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
			$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
				$meta_desc ="theo dõi đơn hàng";
		        $meta_keywords = "theo doi don hang";
		        $meta_title = "Quản lý đơn hàng";
		        $meta_canonical = $request->url();
			// return view('pages.checkout.handcash')->with('category',$category)->with('brand',$brand);
			return view('pages.checkout.handcash')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical'));
		}
		
		// return Redirect::to('/payment');
	}
	public function logout_checkout(){
		Session::flush();
		return Redirect()->back();
	}
	public function login_user(Request $request){
		$email = $request->account;
		$password = md5($request->pass);
		$result = tbl_user::where('email',$email)->where('password',$password)->first();
		if($result){
			Session::put('user_id',$result->user_id);
			Session::put('user_name',$result->user_name);
			return Redirect::to('/payment');
		}else{
			return Redirect::to('/login-checkout');
		}
		

	}
	public function manager_order(){
		$this->AuthLogin();
		$all_order = tbl_order::join('tbl_user','tbl_order.user_id','=','tbl_user.user_id')
		->select('tbl_order.*','tbl_user.user_name')
		->orderby('tbl_order.order_id','desc')->get();
		$manager_order = view('admin.manager_order')->with('all_order',$all_order);
		return view('admin_layout')->with('admin.manager_order',$manager_order);
	}

}