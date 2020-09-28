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

class PostController extends Controller
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
    public function add_post(){
    	$this->AuthLogin();
    	$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();

    	return view('admin.post.add_post')->with(compact('cate_post'));
    }
    public function save_post(Request $request){
    	$this->AuthLogin();
    	$dt = $request->all();
    	$post = new tbl_post();

    	$post->post_title = $dt['post_title'];
    	$post->cate_post_id = $dt['cate_post_id'];
    	$post->post_desc = $dt['post_desc'];
    	$post->post_content = $dt['post_content'];
    	$post->post_meta_keyword = $dt['post_meta_keyword'];
    	$post->post_status = $dt['post_status'];

    	$get_img = $request->file('post_image');
    	if($get_img){
    		$get_name_img = $get_img->getClientOriginalName(); // lấy tên của hình ảnh
    		$name_img = current(explode('.', $get_name_img));
    		$new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
    		$get_img->move('public/uploads/posts',$new_img);
    		$post->post_image = $new_img;
    		$post->save();
    		Session::put('message','Thêm bài viết thành công');
    		return redirect()->back();
    	}else{
    		Session::put('messages','Vui lòng thêm hình ảnh cho bài viết');
    		return redirect()->back();
    	}
    }
    public function all_post(){
    	$this->AuthLogin();
    	$all_post = tbl_post::with('cate_post')->orderBy('post_id','DESC')->paginate(10);

    	return view('admin.post.all_post')->with(compact('all_post'));
    }
    public function active_post($post_id){
       $this->AuthLogin();
       tbl_post::where('post_id',$post_id)->update(['post_status'=>1]);
       Session::put('message','Kích hoạt bài viết thành công');
       return Redirect()->back();
   }
   public function unactive_post($post_id){
       $this->AuthLogin();
       tbl_post::where('post_id',$post_id)->update(['post_status'=>0]);
       Session::put('messages','Ẩn bài viết thành công');
       return Redirect()->back();
   }
   public function edit_post($post_id){
      $this->AuthLogin();
      $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
      $post = tbl_post::find($post_id);
      return view('admin.post.edit_post')->with(compact('post','cate_post'));
   }
   public function update_post(Request $request, $post_id){
      $this->AuthLogin();
      $dt = $request->all();
      $post = tbl_post::find($post_id);

      $post->post_title = $dt['post_title'];
      $post->cate_post_id = $dt['cate_post_id'];
      $post->post_desc = $dt['post_desc'];
      $post->post_content = $dt['post_content'];
      $post->post_meta_keyword = $dt['post_meta_keyword'];

      $get_img = $request->file('post_image');

      if($get_img){
        $post_image_old = $post->post_image;
        $path = 'public/uploads/posts/'.$post_image_old;
        unlink($path);

        $get_name_img = $get_img->getClientOriginalName(); // lấy tên của hình ảnh
        $name_img = current(explode('.', $get_name_img));
        $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
        $get_img->move('public/uploads/posts',$new_img);
        $post->post_image = $new_img;
        
      }
      $post->save();
      Session::put('message','Cập nhật bài viết thành công');
      return redirect()->back();
   }

//view post
    public function view_post(Request $request, $post_id){
      $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
      $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
      $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
      $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
      $post = tbl_post::with('cate_post')->where('post_status',1)->where('post_id',$post_id)->first();
      //seo
      
          $meta_desc =$post->post_desc;
          $meta_keywords = $post->post_meta_keyword;
          $meta_title = $post->post_title;
          $meta_canonical = $request->url();
          $cate_post_id = $post->cate_post_id;
      
      
       $related = tbl_post::with('cate_post')->where('post_status',1)->where('cate_post_id',$cate_post_id)->whereNotIn('post_id',[$post_id])->take(5)->get();
      // return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('search_product',$search_product);
      
      return view('pages.posts.view_post')->with(compact('category','brand','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post','post','related'));
    }   
}
