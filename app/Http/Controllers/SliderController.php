<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\tbl_slide;
use Illuminate\Support\Facades\Redirect;
use Session;

class SliderController extends Controller
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
    public function manage_slider(){
      $this->AuthLogin();
    	$all_slide = tbl_slide::orderBy('slide_id','DESC')->get();
    	return view('admin.slider.list_slide')->with(compact('all_slide'));
    }
    public function add_slider(){
      $this->AuthLogin();
    	return view('admin.slider.add_slide');
    }
    public function active_slide($slide_id){
        $this->AuthLogin();
        tbl_slide::where('slide_id',$slide_id)->update(['slide_status'=>1]);
        Session::put('message','Kích hoạt slider thành công');
        return Redirect::to('manage-slider');
    }
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        tbl_slide::where('slide_id',$slide_id)->update(['slide_status'=>0]);
        Session::put('message','ẩn slider thành công');
        return Redirect::to('manage-slider');
    }
    public function insert_slider(Request $request){
    	$data = $request->all();
    	$this->AuthLogin();
    	
        $get_img = $request->file('slide_image');
        if($get_img){
          $get_name_img = $get_img->getClientOriginalName();
          $name_img = current(explode('.', $get_name_img));
          $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
          $get_img->move('public/uploads/slider',$new_img);
          
          $slider = new tbl_slide();
          $slider->slide_name = $data['slide_name'];
          $slider->slide_image = $new_img;
          $slider->slide_description = $data['slide_description'];
          $slider->slide_status = $data['slide_status'];
          $slider->save();
          Session::put('message','Thêm slider thành công');
          return Redirect::to('add-slider');
      }else{
      	Session::put('messages','Vui lòng thêm hình ảnh slider');
        return Redirect::to('add-slider');
      }
     
        
    }
    
    
}
