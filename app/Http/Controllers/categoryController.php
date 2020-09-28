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

class categoryController extends Controller
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
    public function add_category(){
        $this->AuthLogin();
        return view('admin.add_category');
    }
    public function all_category(){
        $this->AuthLogin();
        $all_category = tbl_category::orderby('category_id','desc')->paginate(5);
        $manager_category = view('admin.all_category')->with('all_category',$all_category);
        return view('admin_layout')->with('admin.all_category',$manager_category);
    }
    public function save_category(Request $request){
        $this->AuthLogin();
        $dt = array();
        $dt['category_name'] = $request->category_name;
        $dt['category_desc'] = $request->category_desc;
        $dt['meta_keywords'] = $request->meta_keywords;
        $dt['status'] = $request->status;
        $dt['created_at'] = carbon::now()->toDateString();
        if($request->category_name == NULL ){
            Session::put('messages','vui lòng nhập tên Danh mục');
            return Redirect::to('add-category');
        }else{
           tbl_category::insert($dt);
           Session::put('message','Thêm danh mục sản phẩm thành công');
           return Redirect::to('add-category');
       }
   }
   public function active_category($category_id){
       $this->AuthLogin();
       tbl_category::where('category_id',$category_id)->update(['status'=>1]);
       Session::put('message','Kích hoạt danh mục sản phẩm thành công');
       return Redirect::to('all-category');
   }
   public function unactive_category($category_id){
       $this->AuthLogin();
       tbl_category::where('category_id',$category_id)->update(['status'=>0]);
       Session::put('message','Ẩn danh mục sản phẩm thành công');
       return Redirect::to('all-category');
   }
   public function edit_category($category_id){
    $this->AuthLogin();
    $edit_category = tbl_category::where('category_id',$category_id)->get();
    $manager_category = view('admin.edit_category')->with('edit_category',$edit_category);
    return view('admin_layout')->with('admin.edit_category',$manager_category);
}
public function update_category(Request $request,$category_id){
    $this->AuthLogin();
    $dt = array();
    $dt['category_name'] = $request->category_name;
    $dt['category_desc'] = $request->category_desc;
    $dt['meta_keywords'] = $request->meta_keywords;
    $dt['updated_at'] = carbon::now()->toDateString();
    tbl_category::where('category_id',$category_id)->update($dt);
    Session::put('message','Cập nhật danh mục sản phẩm thành công');
    return Redirect::to('all-category');
}
public function delete_category($category_id){
    $this->AuthLogin();
    tbl_category::where('category_id',$category_id)->delete();
    Session::put('message','Xóa danh mục sản phẩm thành công');
    return Redirect::to('all-category');
}

//end function admin page
public function View_category(Request $request, $category_id){
    
    $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
    $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
    $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
    $category_by_id = tbl_product::join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->paginate(6);
    $category_name = tbl_category::where('tbl_category_product.category_id',$category_id)->limit(1)->get();
    $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
    foreach ($category_name as $key => $val) {
      $meta_desc =$val->category_desc;
      $meta_keywords = $val->meta_keywords;
      $meta_title=$val->category_name;
      $meta_canonical=$request->url();
    }
    
        // return view('pages.category.show_category')->with('category',$category)->with('brand',$brand)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('meta_canonical',$meta_canonical);
    return view('pages.category.show_category')->with(compact('category','brand','category_by_id','category_name','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post'));
}
}

