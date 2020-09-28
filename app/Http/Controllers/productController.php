<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_product;
use App\Model\tbl_product_image;
use App\Model\tbl_category;
use App\Model\tbl_Brand;
use App\Model\tbl_slide;
use App\Model\tbl_category_post;
// use Input;
use Illuminate\Support\Facades\Input;
use Carbon\carbon;


session_start();

class productController extends Controller
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
    public function add_Product(){
    	$this->AuthLogin();
        $category = tbl_category::orderby('category_id','desc')->get();
        $brand = tbl_Brand::orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('category',$category)->with('brand',$brand);
    }
    public function all_Product(){
    	$this->AuthLogin();
    	$all_Product = tbl_product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->paginate(5);
        $manager_Product = view('admin.all_Product')->with('all_product',$all_Product);
        return view('admin_layout')->with('admin.all_Product',$manager_Product);
    }
    public function save_Product(Request $request){
    	$this->AuthLogin();
      $file_name = $request->file('image')->getClientOriginalName();
      $product = new tbl_product;
      $product->product_name = $request->Product_name;
      $product->category_id = $request->category_name;
      $product->brand_id = $request->Brand_name;
      $product->status = $request->status;
      $product->input_price = $request->input_price;
      $product->output_price = $request->output_price;
      $product->sold = 0;
      $product->view = 0;
      $product->total = $request->total;
      $product->weight = $request->weight;
      $product->expire = $request->expire;
      $product->description = $request->description;
      $product->meta_keywords = $request->meta_keywords;
      $product->created_at = carbon::now()->toDateString();
      // $product->product_name = $file_name;
      if($file_name){
        $product->images = $file_name;
        $request->file('image')->move('public/uploads/product',$file_name);
        $product->save();
      }
      // $get_img = $request->file('image');
      // if($get_img){
      //   $get_name_img = $get_img->getClientOriginalName(); // lấy tên của hình ảnh
      //   $name_img = current(explode('.', $get_name_img));
      //   $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
      //   $get_img->move('public/uploads/product',$new_img);
      //   $product->images = $new_img;
      //   $product->save();
      // }
      else{
        $product->images = 'dangcapnhat.jpg';
        $product->save();
      }
      

      $product_id = $product->product_id;
      if($request->hasFile('name_img')){
        foreach ($request->file('name_img') as $key => $file) {
          $product_img = new tbl_product_image;
          if(isset($file)){
            $product_img->images = $file->getClientOriginalName();
            $product_img->product_id = $product_id;
            $product_img->created_at = carbon::now()->toDateString();
            $file->move('public/uploads/product/details/',$file->getClientOriginalName());
            $product_img->save();
          }
        }
      }
      Session::put('message','Thêm sản phẩm thành công');
      return Redirect::to('add-product');

}
public function active_product($product_id){
        $this->AuthLogin();
        tbl_product::where('product_id',$product_id)->update(['status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        tbl_product::where('product_id',$product_id)->update(['status'=>0]);
        Session::put('messages','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }
public function edit_Product($product_id){
   $this->AuthLogin();
   $category = tbl_category::orderby('category_id','desc')->get();
   $brand = tbl_Brand::orderby('brand_id','desc')->get();
   $edit_Product = tbl_product::where('product_id',$product_id)->get();
   $manager_Product = view('admin.edit_product')->with('edit_product',$edit_Product)->with('category',$category)->with('brand',$brand);
   return view('admin_layout')->with('admin.edit_product',$manager_Product);
}
public function update_Product(Request $request,$product_id){
   $this->AuthLogin();
   $dt = array();
   $dt['product_name'] = $request->Product_name;
   $dt['category_id'] = $request->category_name;
   $dt['brand_id'] = $request->Brand_name;
   $dt['input_price'] = $request->input_price;
   $dt['output_price'] = $request->output_price;
   $dt['total'] = $request->total;
   $dt['weight'] = $request->weight;
   $dt['expire'] = $request->expire;
   $dt['description'] = $request->description;
   $dt['meta_keywords'] = $request->meta_keywords;
   $dt['updated_at'] = carbon::now()->toDateString();
   $get_img=$request->file('image');
   if($get_img){
    $get_name_img = $get_img->getClientOriginalName();
    $name_img = current(explode('.', $get_name_img));
    $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
    $get_img->move('public/uploads/product',$new_img);
    $dt['images'] = $new_img;
    tbl_product::where('product_id',$product_id)->update($dt);
    Session::put('message','Cập nhật sản phẩm thành công');
    return Redirect::to('all-product');
}
tbl_product::where('product_id',$product_id)->update($dt);
Session::put('message','Cập nhật sản phẩm thành công');
return Redirect::to('all-product');
}
public function delete_Product($product_id){
   $this->AuthLogin();
   tbl_product::where('product_id',$product_id)->delete();
   Session::put('message','Xóa sản phẩm thành công');
   return Redirect::to('all-product');
}
    //end function admin pages
public function details_product(Request $request, $product_id){
    $category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
    $brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
    $slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
    $details_Product = tbl_product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    ->where('tbl_product.product_id',$product_id)->first();
    $image = tbl_product_image::select('id','images')->where('product_id',$product_id)->get();
    $cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
    $view_pro = tbl_product::find($product_id);
    $view = $view_pro->view;
    $view_pro->view=$view + 1;
    $view_pro->save();
        
        $category_id = $details_Product->category_id;
        $brand_id = $details_Product->brand_id;
        $product_cate = $details_Product->category_name;

        //seo
          $meta_desc =$details_Product->description;
          $meta_keywords = $details_Product->meta_keywords;
          $meta_title = $details_Product->product_name;
          $meta_canonical = $request->url();
        //seo
    
    
    $related_Product = tbl_product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    ->where('tbl_category_product.category_id',$category_id)
    ->orwhere('tbl_brand.brand_id',$brand_id)
    ->whereNotIn('tbl_product.product_id',[$product_id])->paginate(3);

    // return view('pages.product.show_details')->with('category',$category)->with('brand',$brand)->with('related',$related_Product)->with('product_details',$details_Product);
    return view('pages.product.show_details')->with(compact('category','brand','related_Product','details_Product','meta_desc','meta_keywords','meta_title','meta_canonical','slider','image','product_cate','category_id','cate_post'));
}
}
