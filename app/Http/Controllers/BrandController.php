<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_Brand;
use App\Model\tbl_category;
use App\Model\tbl_product;
use App\Model\tbl_slide;
use App\Model\tbl_category_post;

use Carbon\carbon;
session_start();


class BrandController extends Controller
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
    public function add_Brand(){
        $this->AuthLogin();
        return view('admin.add_Brand');
    }
    public function all_Brand(){
        $this->AuthLogin();
        $all_Brand = tbl_Brand::orderby('brand_id','desc')->paginate(5);
        $manager_Brand = view('admin.all_Brand')->with('all_brand',$all_Brand);
        return view('admin_layout')->with('admin.all_Brand',$manager_Brand);
    }
    public function save_Brand(Request $request){
        $this->AuthLogin();
        $dt = array();
        $dt['brand_name'] = $request->brand_name;
        $dt['brand_desc'] = $request->brand_desc;
        $dt['meta_keywords'] = $request->meta_keywords;
        $dt['status'] = $request->status;
        $dt['created_at'] = carbon::now()->toDateString();
        if($request->brand_name == NULL ){
            Session::put('messages','vui lòng nhập tên thương hiệu');
            return Redirect::to('add-brand');
        }else{
            tbl_Brand::insert($dt);
            Session::put('message','Thêm thương hiệu thành công');
            return Redirect::to('add-brand');
        }

    }
    public function active_brand($brand_id){
        $this->AuthLogin();
        tbl_Brand::where('brand_id',$brand_id)->update(['status'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand');
    }
    public function unactive_brand($brand_id){
        $this->AuthLogin();
        tbl_Brand::where('brand_id',$brand_id)->update(['status'=>0]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('all-brand');
    }
    public function edit_brand($brand_id){
        $this->AuthLogin();
        $edit_Brand = tbl_Brand::where('brand_id',$brand_id)->get();
        $manager_Brand = view('admin.edit_Brand')->with('edit_brand',$edit_Brand);
        return view('admin_layout')->with('admin.edit_Brand',$manager_Brand);
    }
    public function update_Brand(Request $request,$brand_id){
        $this->AuthLogin();
        $dt = array();
        $dt['brand_name'] = $request->brand_name;
        $dt['brand_desc'] = $request->brand_desc;
        $dt['meta_keywords'] = $request->meta_keywords;
        $dt['updated_at'] = carbon::now()->toDateString();
        tbl_Brand::where('brand_id',$brand_id)->update($dt);
        Session::put('message','Cập nhật thương hiệu thành công');
        return Redirect::to('all-brand');
    }
    public function delete_brand($brand_id){
        $this->AuthLogin();
        tbl_Brand::where('brand_id',$brand_id)->delete();
        Session::put('message','Xóa thương hiệu thành công');
        return Redirect::to('all-brand');
    }

// end function admin pages
    public function View_brand(Request $request, $brand_id){
        
        $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
        $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
        $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
        $brand_by_id = tbl_product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->paginate(6);
        $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
        $brand_name = tbl_brand::where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        foreach ($brand_name as $key => $val) {
          $meta_desc = $val->brand_desc;
          $meta_keywords = $val->meta_keywords;
          $meta_title = $val->brand_name;
          $meta_canonical=$request->url();
        }
        
        // return view('pages.brand.show_brand')->with('category',$category)->with('brand',$brand)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
        return view('pages.brand.show_brand')->with(compact('category','brand','brand_by_id','brand_name','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post'));
    }
}
