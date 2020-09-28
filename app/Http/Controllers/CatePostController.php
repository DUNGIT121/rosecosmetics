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
use App\Model\tbl_post;
use Carbon\carbon;

class CatePostController extends Controller
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
    public function add_cate_post(){
    	$this->AuthLogin();
        return view('admin.cate_post.add_catepost');
    }
    public function save_cate_post(Request $request){
        $this->AuthLogin();
        $dt = $request->all();
        $cate_post = new tbl_category_post();
        $cate_post->cate_post_name = $dt['cate_post_name'];
        $cate_post->cate_post_status = $dt['cate_post_status'];
        $cate_post->cate_post_desc = $dt['cate_post_desc'];
        $cate_post->created_at = carbon::now()->toDateString();
        $cate_post->save();
        Session::put('message','Thêm danh mục bài viết thành công');
        return Redirect()->back();
       }
   public function all_cate_post(){
        $this->AuthLogin();
        $cate_post = tbl_category_post::orderby('cate_post_id','DESC')->paginate(5);
        
        return view('admin.cate_post.all_catepost')->with(compact('cate_post'));
    }
    public function active_catepost($cate_post_id){
       $this->AuthLogin();
       tbl_category_post::where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>1]);
       Session::put('message','Kích hoạt danh mục bài viết thành công');
       return Redirect()->back();
   }
   public function unactive_catepost($cate_post_id){
       $this->AuthLogin();
       tbl_category_post::where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>0]);
       Session::put('messages','Ẩn danh mục bài viết thành công');
       return Redirect()->back();
   }
   public function edit_catepost($cate_post_id){
    $this->AuthLogin();
    $cate_post = tbl_category_post::find($cate_post_id);
    
    return view('admin.cate_post.edit_catepost')->with(compact('cate_post'));
	}
	public function update_cate_post(Request $request,$cate_post_id){
	    $this->AuthLogin();
	    
	    $dt = $request->all();
        $cate_post = tbl_category_post::find($cate_post_id);
        $cate_post->cate_post_name = $dt['cate_post_name'];
        $cate_post->cate_post_desc = $dt['cate_post_desc'];
        $cate_post->updated_at = carbon::now()->toDateString();
        $cate_post->save();
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return Redirect('/all-cate-post');
	}

   public function view_cate_post(Request $request, $cate_post_id){

      $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
      $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
      $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
      $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
      $catepost = tbl_category_post::where('cate_post_id',$cate_post_id)->get();
      //seo
      foreach ($catepost as $key => $cate) {
          $meta_desc =$cate->cate_post_desc;
          $meta_keywords = "Danh muc bai viet";
          $meta_title = $cate->cate_post_name;
          $meta_canonical = $request->url();
      }
      $post = tbl_post::with('cate_post')->where('post_status',1)->where('cate_post_id',$cate_post_id)->paginate(10);
            
      // return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('search_product',$search_product);
      
      return view('pages.posts.cate_posts')->with(compact('category','brand','catepost','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post','post'));
   }
}
