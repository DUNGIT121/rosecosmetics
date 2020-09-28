<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\alert;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_user;
use Carbon\carbon;
use App\Model\tbl_product;
use App\Model\tbl_order;
use Mail;
// use RealRashid\SweetAlert\Facades\Alert;
session_start();

class AdminController extends Controller
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
    public function revenue(){
        return view('admin.revenue');
    }
    public function add_user(){
        $this->AuthLogin();
        return view('admin.add_user');
    }
    public function all_user(){
        $this->AuthLogin();
        $all_user = tbl_user::orderby('user_id','desc')->paginate(5);
        $manager_user = view('admin.all_user')->with('all_user',$all_user);
        return view('admin_layout')->with('admin.all_user',$manager_user);
    }
    public function active_user($user_id){
        $this->AuthLogin();
        tbl_user::where('user_id',$user_id)->update(['status'=>1]);
        Session::put('message','Kích hoạt tài khoản thành công');
        return Redirect::to('all-user');
    }
    public function unactive_user($user_id){
        $this->AuthLogin();
        tbl_user::where('user_id',$user_id)->update(['status'=>0]);
        Session::put('message','Khóa tài khoản thành công');
        return Redirect::to('all-user');

    }
    public function edit_user($user_id){
        $this->AuthLogin();
        $edit_user = tbl_user::where('user_id',$user_id)->get();
        $manager_user = view('admin.edit_user')->with('edit_user',$edit_user);
        return view('admin_layout')->with('admin.edit_user',$manager_user);
    }
    public function update_user(Request $request,$user_id){
        $this->AuthLogin();
        $dt = array();
        $dt['user_name'] = $request->user_name;
        $dt['email'] = $request->email;
        $dt['password'] = md5($request->password);
        $dt['address'] = $request->address;
        $dt['phone'] = $request->phone;
        $dt['role_id'] = $request->role_id;
        $dt['level'] = $request->level;
        $dt['updated_at'] = carbon::now()->toDateString();
        tbl_user::where('user_id',$user_id)->update($dt);
        Session::put('message','Cập nhật tài khoản thành công');
        return Redirect::to('all-user');
    }
    public function save_user(Request $request){
        $this->AuthLogin();
        $dt = array();
        $dt['user_name'] = $request->user_name;
        $dt['email'] = $request->email;
        $dt['password'] = md5($request->password);
        $dt['address'] = $request->address;
        $dt['phone'] = $request->phone;
        $dt['status'] = $request->status;
        $dt['role_id'] = $request->role_id;
        $dt['level'] = $request->level;
        $dt['created_at'] = carbon::now()->toDateString();
        $mail = $request->email;
        $result = tbl_user::where('email',$mail)->first();
        if($result){
            Session::put('messages','Tài khoản đã sử dụng');
            return Redirect::to('add-user');
        }else{
            tbl_user::insert($dt);
            Session::put('message','Thêm tài khoản thành công');
            return Redirect::to('add-user');
        }

    }
    public function delete_user($user_id){
        $this->AuthLogin();
        tbl_user::where('user_id',$user_id)->delete();
        Session::put('message','Xóa tài khoản thành công');
        return Redirect::to('all-user');
    }
    public function register(){
        return view('register');
    }
    public function login(){
    	return view('login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        $user_count = tbl_user::count();
        $product_count = tbl_product::count();
        $order_count = tbl_order::count();
        $order_new = tbl_order::where('status','1')->get();
        $order_count_new = $order_new->count();
    	return view('admin.dashboard',compact('user_count','product_count','order_count','order_count_new'));
    }
    public function check_register(Request $request){
        
        $dt = array();
        $dt['user_name'] = $request->hoten;
        $dt['email'] = $request->account;
        $dt['password'] = md5($request->password);
        $dt['address'] = $request->address;
        $dt['phone'] = $request->phone;
        $dt['status'] = 0;
        $dt['role_id']=1;
        $dt['level']=1;
        $dt['created_at']=carbon::now()->toDateString();
        $acc = $request->account;
        $result = tbl_user::where('email',$acc)->first();
        if($result){
            Session::put('messages','Email đã sử dụng');
            return Redirect::to('/register');
        }else{
        
        Mail::send('mail.send_mail',[
        'user_name' => $request->hoten,
        $check_code = substr(md5(microtime()),rand(0,26),6),
        'check_code'=> $check_code,
        ],function($send) use($request){
            $send->to($request->account,$request->hoten);
            $send->from('rosecosmetics121@gmail.com');
            $send->subject('Xác thực tài khoản');
        });
        $user_id=tbl_user::insertGetId($dt);
        Session::put('user_id',$user_id);
        Session::put('user_name',$request->hoten);
        Session::put('email',$request->account);
        Session::put('check_code',$check_code);
        // Session::put('role_id',$role_id);
        
        Session::put('message','Vui lòng kiểm tra email để xác thực tài khoản!');
        return Redirect::to('/check-auth');

        }  
    }
    public function check_auth(){
        $user_idcode = tbl_user::orderby('user_id','desc')->first();
        return view('checkcode_auth')->with(compact('user_idcode'));
    }
    public function checkcode_auth(request $request, $user_id){
        $code = Session::get('check_code');
        if($request->checkcode == $code){
            $dt = array();
            $dt['status'] = 1;
            tbl_user::where('user_id',$user_id)->update($dt);
            Session::put('message','Đăng ký tài khoản thành công');
            
            return Redirect::to('/trang-chu');
        }else
        Session::put('messages','Mã xác thực không chính xác. Vui lòng kiểm tra lại!');
        
        return Redirect::to('/check-auth');
    }
    public function dashboard(Request $request){
        // $this->AuthLogin();
    	$account = $request->account;
    	$password = md5($request->password);

    	$result = tbl_user::where('email',$account)->where('password',$password)->where('status',1)->first();
    	if($result){
    		Session::put('user_name',$result->user_name);
    		Session::put('user_id',$result->user_id);
            Session::put('role_id',$result->role_id);
            Session::put('email',$result->email);
            $role = session::get('role_id');
            if($role==3){
                return Redirect::to('/dashboard');
            }
            elseif($role==1){
                return Redirect::to('/trang-chu');
            }
    	 }else{
    	 	Session::put('messages','Tài khoản hoặc mật khẩu không chính xác');
    	 	return Redirect::to('/login');
    	 }
    	}
    public function logout(){
        $this->AuthLogin();
    	Session::flush();
    	return Redirect::to('/trang-chu');
    }	 
}
