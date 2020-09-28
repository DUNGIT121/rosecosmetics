<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_coupon;
use Session;
use Carbon\carbon;
use App\Coupon;
use Cart;

session_start();

class CouponController extends Controller
//admin
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
	public function del_coupon(){
		$coupon = Session::get('coupon');
            if($coupon==true){
                Session::forget('coupon');
                return Redirect()->back()->with('message','Đã xóa mã khuyến mãi');
            }
	}
	public function delete_coupon($coupon_id){
        $this->AuthLogin();
		$coupon =  tbl_coupon::where('coupon_id',$coupon_id);
		$coupon->delete();
		Session::put('message','Xóa mã giảm giá thành công');
          return Redirect::to('all-coupon');
	}
	public function add_coupon(){
        $this->AuthLogin();
		return view('admin.coupon.add_coupon');
	}
	public function all_coupon(){
        $this->AuthLogin();
		$coupon = tbl_coupon::orderby('coupon_id','DESC')->paginate(5);
		return view('admin.coupon.all_coupon')->with(compact('coupon'));
	}
	public function save_coupon(Request $request){
        $this->AuthLogin();
		$data = $request->all();
        $coupon = new tbl_coupon;
        $coupon->coupon_name=$data['coupon_name'];
        $coupon->coupon_code=$data['coupon_code'];
        $coupon->start_coupon=$data['start_coupon'];
        $coupon->end_coupon=$data['end_coupon'];
        $coupon->coupon_condition=$data['coupon_condition'];
        $coupon->coupon_number=$data['coupon_number'];
        $coupon->created_at = carbon::now()->toDateString();
        $coupon->save();
        Session::put('message','Thêm mã giảm giá thành công');
          return Redirect::to('add-coupon');	
        
        
	}
    public function edit_coupon($coupon_id){
    $this->AuthLogin();
    $edit_coupon = tbl_coupon::find($coupon_id);
    
    return view('admin.coupon.edit_coupon')->with(compact('edit_coupon'));
    }
    public function update_coupon(Request $request,$coupon_id){
        $this->AuthLogin();
        $data = $request->all();
        $coupon = tbl_coupon::find($coupon_id);
        $coupon->coupon_name=$data['coupon_name'];
        $coupon->coupon_code=$data['coupon_code'];
        $coupon->start_coupon=$data['start_coupon'];
        $coupon->end_coupon=$data['end_coupon'];
        $coupon->coupon_condition=$data['coupon_condition'];
        $coupon->coupon_number=$data['coupon_number'];
        $coupon->updated_at = carbon::now()->toDateString();
        $coupon->save();
        Session::put('message','Cập nhật mã giảm giá thành công');
        return Redirect('/all-coupon');
    }
//frontend
    public function check_coupon(Request $request){
        $data = $request->all();

        $check_date = carbon::now()->toDateString();
        // $date = new tbl_coupon;
        // $start_cou = $date->start_coupon;
        // $end_cou = $date->end_coupon;
        

        $coupon = tbl_coupon::where('coupon_code',$data['coupon'])->where(function($query) use ($check_date) {$query->where('start_coupon','<=',$check_date); $query->where('end_coupon','>=',$check_date);})->first();
        if($coupon){
        	$cout_coupon = $coupon->count();
        	if($cout_coupon > 0){
        		$coupon_session = Session::get('coupon');
        		if($coupon_session==true){
        			$is_avaiable = 0;
        			if($is_avaiable==0){
        				$cou[] = array(
        					'coupon_code'=>$coupon->coupon_code,
        					'coupon_condition'=>$coupon->coupon_condition,
        					'coupon_number'=>$coupon->coupon_number,
        				); 
        				Session::put('coupon',$cou);
        			}
        		}else{
        			$cou[] = array(
        					'coupon_code'=>$coupon->coupon_code,
        					'coupon_condition'=>$coupon->coupon_condition,
        					'coupon_number'=>$coupon->coupon_number,
        				); 
        				Session::put('coupon',$cou);
        		}
        		Session::save();
        		return Redirect()->back()->with('message','nhập mã giảm giá thành công');
        	}
        }else{
        	return Redirect()->back()->with('messages','mã giảm giá không đúng');
        }
    }
}
