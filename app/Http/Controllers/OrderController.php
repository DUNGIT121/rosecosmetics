<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_order;
use App\Model\tbl_details_order;
use App\Model\tbl_feeship;
use App\Model\tbl_user;
use App\Model\tbl_coupon;
use App\Model\tbl_product;
use App\Model\tbl_slide;
use App\Model\tbl_category;
use App\Model\tbl_category_post;
use App\Model\tbl_Brand;
use Session;
use PDF;

session_start();

class OrderController extends Controller
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
	
	public function cancel_order($order_code){
		tbl_order::where('order_code',$order_code)->update(['status'=>5]);
		Session::put('messages','Hủy đơn hàng thành công');
		return Redirect()->back();
	}
	public function follow_delivery(Request $request, $order_code){
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
		//seo
		$meta_desc ="chuyên cung cấp mỹ phẩm chính hãng nội địa hàn quốc, Nhật Bản.Là một người chú ý đến sắc đẹp của bản thân thì bạn đừng bỏ qua trang web mỹ phẩm này nhé";
		$meta_keywords = "my pham chinh hang, mỹ phẩm chính hãng, my pham han quoc, mỹ phẩm hàn quốc, my pham nhat ban, mỹ phẩm nhật bản, my pham gia re, mỹ phẩm giá rẻ, my pham noi dia, mỹ phẩm nội địa";
		$meta_title="Trạng thái đơn hàng";
		$meta_canonical=$request->url();
		$follow_d = tbl_order::where('order_code',$order_code)->first();
		$order_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();
		$order = tbl_order::where('order_code',$order_code)->get();
		foreach ($order as $key => $ord) {
			$user_id = $ord->user_id;
			$order_status = $ord->status;
		}
		$customer = tbl_user::where('user_id',$user_id)->first();
		$ord_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();

		foreach ($ord_details as $key => $order_d) {
			$product_coupon = $order_d->order_coupon;
		}
		if($product_coupon!='no'){
			$coupon = tbl_coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		return view('pages.checkout.follow_delivery')->with(compact('slider','meta_desc','meta_keywords','meta_title','meta_title','meta_canonical','category','brand','follow_d','ord_details','order_status','order_details','user_id','customer','coupon_condition','coupon_number','cate_post'));
	}
	public function order_follow(Request $request, $user_id){
		//slider
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
		//seo
		$meta_desc ="chuyên cung cấp mỹ phẩm chính hãng nội địa hàn quốc, Nhật Bản.Là một người chú ý đến sắc đẹp của bản thân thì bạn đừng bỏ qua trang web mỹ phẩm này nhé";
		$meta_keywords = "my pham chinh hang, mỹ phẩm chính hãng, my pham han quoc, mỹ phẩm hàn quốc, my pham nhat ban, mỹ phẩm nhật bản, my pham gia re, mỹ phẩm giá rẻ, my pham noi dia, mỹ phẩm nội địa";
		$meta_title="Đơn hàng của bạn";
		$meta_canonical=$request->url();
		$count = tbl_order::where('user_id',$user_id)->whereIn('status',[1,2,3,4])->get();
		$order_count = $count->count();
		$order_fl = tbl_order::where('user_id',$user_id)->whereNotIn('status',[5])->orderby('created_at','DESC')->paginate(10);
		return view('pages.checkout.order_follow')->with(compact('slider','meta_desc','meta_keywords','meta_title','meta_title','meta_canonical','category','brand','order_fl','order_count','cate_post'));
	}
	public function order_details(Request $request, $order_code){
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
		//seo
		$meta_desc ="chuyên cung cấp mỹ phẩm chính hãng nội địa hàn quốc, Nhật Bản.Là một người chú ý đến sắc đẹp của bản thân thì bạn đừng bỏ qua trang web mỹ phẩm này nhé";
		$meta_keywords = "my pham chinh hang, mỹ phẩm chính hãng, my pham han quoc, mỹ phẩm hàn quốc, my pham nhat ban, mỹ phẩm nhật bản, my pham gia re, mỹ phẩm giá rẻ, my pham noi dia, mỹ phẩm nội địa";
		$meta_title="Chi tiết đơn hàng";
		$meta_canonical=$request->url();
		$order_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();
		$order = tbl_order::where('order_code',$order_code)->get();
		foreach ($order as $key => $ord) {
			$user_id = $ord->user_id;
			$order_status = $ord->status;
		}
		$customer = tbl_user::where('user_id',$user_id)->first();
		$ord_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();

		foreach ($ord_details as $key => $order_d) {
			$product_coupon = $order_d->order_coupon;
		}
		if($product_coupon!='no'){
			$coupon = tbl_coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('pages.checkout.order_details')->with(compact('slider','meta_desc','meta_keywords','meta_title','meta_title','meta_canonical','category','brand','order_details','customer','order','ord_details','coupon_condition','coupon_number','feeship','order_status','cate_post'));
	}
	public function update_qty(Request $request){
		
		$data = $request->all();
		$order_details = tbl_details_order::where('product_id',$data['order_producd_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_qty = $data['order_qty'];
		$order_details->save();
	}

	public function order_update_qty(Request $request){
		$this->AuthLogin();
		$data = $request->all();
		$order = tbl_order::find($data['order_id']);
		$order->status = $data['status'];
		$order->save();
		if($order->status == 2){
			foreach ($data['order_producd_id'] as $key => $product_id) {
				$product = tbl_product::find($product_id);
				$product_quantity = $product->total;
				$sold = $product->sold;
				foreach ($data['quantity'] as $key2 => $qty) {
					if($key==$key2){
						$product->sold = $sold + $qty;
						$product->save();
					}
					
				}
			}
		}elseif($order->status == 5){
			foreach ($data['order_producd_id'] as $key => $product_id) {
				$product = tbl_product::find($product_id);
				$product_quantity = $product->total;
				$sold = $product->sold;
				foreach ($data['quantity'] as $key2 => $qty) {
					if($key==$key2){
						$product->sold = $sold - $qty;
						$product->save();
					}
					
				}
			}
		}
	}
	public function print_order($checkout_code){
		$this->AuthLogin();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$this->AuthLogin();
		$order_details = tbl_details_order::where('order_code',$checkout_code)->get();
		$order = tbl_order::where('order_code',$checkout_code)->get();
		foreach ($order as $key => $ord) {
			$user_id = $ord->user_id;
		}
		$customer = tbl_user::where('user_id',$user_id)->first();
		$ord_details = tbl_details_order::with('product')->where('order_code',$checkout_code)->get();

		foreach ($ord_details as $key => $order_d) {
			$product_coupon = $order_d->order_coupon;
		}
		if($product_coupon!='no'){
			$coupon = tbl_coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
			if ($coupon_condition==1) {
				$echo_coupon = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$echo_coupon = number_format($coupon_number,0,',','.').' '.'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
			$echo_coupon = '0';
		}
		
		$output = '';

		$output.='<style>body{
			font-family: Dejavu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><center>Mỹ Phẩm ROSECosmetics</center></h1>
		<h4><center>cảm ơn quý khách đã đặt hàng tại shop</center></h4>
		<p>Thông Tin Người Đặt</p>
		<table class="table-styling">
			<thead>
				<tr>
					<th>Tên người đặt hàng</th>
					<th>số điện thoại</th>
					<th>địa chỉ email</th>
				</tr>
			</thead>
			<tbody>';
			
		$output.='	
				<tr>
					<td>'.$customer->user_name.'</td>
					<td>'.$customer->phone.'</td>
					<td>'.$customer->email.'</td>
				</tr>';
				
		$output.='
			</tbody>
		</table>

		<p>Thông Tin Người Nhận</p>
		<table class="table-styling">
			<thead>
				<tr>
					<th>Tên người nhận</th>
					<th>số điện thoại</th>
					<th>địa chỉ</th>
					<th>địa chỉ email</th>
					<th>ghi chú</th>
				</tr>
			</thead>
			<tbody>';
			foreach($order as $key=>$ord){
		$output.='	
				<tr>
					<td>'.$ord->customer_name.'</td>
					<td>'.$ord->phone.'</td>
					<td>'.$ord->delivery_address.'</td>
					<td>'.$ord->email.'</td>
					<td>'.$ord->description.'</td>
				</tr>';
				}
		$output.='
			</tbody>
		</table>

		<p>Thông tin đơn hàng</p>
		<table class="table-styling">
			<thead>
				<tr>
					<th>Tên sản phẩm</th>
					<th>số lượng</th>
					<th>mã giảm giá</th>
					<th>giá sản phẩm</th>
					<th>tổng tiền</th>
				</tr>
			</thead>
			<tbody>';
			$total = 0;

			foreach($ord_details as $key=>$pro){
				$subtotal = $pro->product_price*$pro->product_sales_qty;
				$total+=$subtotal;
				if ($pro->order_coupon!='no') {
					$order_coupon = $pro->order_coupon;
				}else{
					$order_coupon = 'Không có mã giảm giá';
				}
		$output.='	
				<tr>
					<td>'.$pro->product_name.'</td>
					<td>'.$pro->product_sales_qty.'</td>
					<td>'.$order_coupon.'</td>
					<td>'.number_format($pro->product_price,0,',','.').' '.'đ'.'</td>
					<td>'.number_format($subtotal,0,',','.').' '.'đ'.'</td>
				</tr>';
				}
				if ($coupon_condition==1) {
				$total_after_coupon = ($total*$coupon_number)/100;
				$total_coupon = $total - $total_after_coupon;
			}else{
				$total_coupon = $total - $coupon_number;
			}
		$output.='<tr>
			<td colspan="2">
				<p>Tổng giảm: - '.$echo_coupon.'</p>
				<p>Phí ship: '.number_format($pro->order_feeship,0,',','.').' '.'đ'.'</p>
				<p>Thành Tiền: '.number_format($total_coupon + $pro->order_feeship,0,',','.').' '.'đ'.' </p>
			</td>
		</tr>
		';		
		$output.='
			</tbody>
		</table>

		<h2><center>Ký Tên</center></h2>
		<table>
			<thead>
				<tr>
					<th width="200px">Người lập phiếu</th>
					<th width="800px">Người nhận</th>
					
				</tr>
				<tr>
					<th width="200px"><i>(ký, ghi rõ họ tên)</i></th>
					<th width="800px"><i>(ký, ghi rõ họ tên)</i></th>
					
				</tr>
			</thead>
			<tbody>';
		$output.='
			</tbody>
		</table>
		';
		return $output;
	}
	public function view_order($order_code){
		$this->AuthLogin();
		$order_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();
		$order = tbl_order::where('order_code',$order_code)->get();
		foreach ($order as $key => $ord) {
			$user_id = $ord->user_id;
			$order_status = $ord->status;
		}
		$customer = tbl_user::where('user_id',$user_id)->first();
		$ord_details = tbl_details_order::with('product')->where('order_code',$order_code)->get();

		foreach ($ord_details as $key => $order_d) {
			$product_coupon = $order_d->order_coupon;
		}
		if($product_coupon!='no'){
			$coupon = tbl_coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
 		return view('admin.view_order')->with(compact('order_details','customer','order','ord_details','coupon_condition','coupon_number','feeship','order_status'));
	}
    public function manager_order(){
    	$this->AuthLogin();
    	$order = tbl_order::orderby('created_at','DESC')->paginate(5);
    	return view('admin.manager_order')->with(compact('order'));
    }
    public function manager_order_new(){
    	$this->AuthLogin();
    	$order_new = tbl_order::where('status',1)->orderby('created_at','DESC')->paginate(5);
    	return view('admin.manager_order_new')->with(compact('order_new'));
    }
}
