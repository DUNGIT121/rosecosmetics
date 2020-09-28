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
use App\Model\tbl_slide;
use App\Model\tbl_category_post;
use App\Model\tbl_user;

session_start();

class HomeController extends Controller
{
	public function autocomplete_ajax(Request $request){
		$data = $request->all();
		if($data['query']){
			$product = tbl_product::where('status',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
			$output = '<ul class="dropdown-menu" style="display:block; position:relative">';
			foreach ($product as $key => $val) {
				$output .='
				<li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
				';
			}
			$output .= '</ul>';
			echo $output;
		}
	}
	public function index(Request $request){
		//cate post
		$cate_post = tbl_category_post::orderby('cate_post_id','DESC')->where('cate_post_status','1')->get();
		//slider
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		//seo
		$meta_desc ="chuyên cung cấp mỹ phẩm chính hãng nội địa hàn quốc, Nhật Bản.Là một người chú ý đến sắc đẹp của bản thân thì bạn đừng bỏ qua trang web mỹ phẩm này nhé";
		$meta_keywords = "my pham chinh hang, mỹ phẩm chính hãng, my pham han quoc, mỹ phẩm hàn quốc, my pham nhat ban, mỹ phẩm nhật bản, my pham gia re, mỹ phẩm giá rẻ, my pham noi dia, mỹ phẩm nội địa";
		$meta_title="ROSE cosmetics";
		$meta_canonical=$request->url();

		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$product_sold = tbl_product::where('status','1')->orderby('sold','desc')->paginate(3);
		$product_view = tbl_product::where('status','1')->orderby('view','desc')->paginate(3);
		$all_Product = tbl_product::where('status','1')->orderby('product_id','desc')->paginate(6);
		$user = tbl_user::where('status','1')->get();
		// return view('pages.home')->with('category',$category)->with('brand',$brand)->with('product',$all_Product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('meta_canonical',$meta_canonical);
		return view('pages.home')->with(compact('category','brand','all_Product','meta_desc','meta_keywords','meta_title','meta_canonical','slider','product_sold','product_view','user','cate_post'));
	}
	public function search(Request $request){
		$keywords = $request->search;
		$category = tbl_category::where('status','1')->orderby('category_id','desc')->get();
		$brand = tbl_Brand::where('status','1')->orderby('brand_id','desc')->get();
		$slider = tbl_slide::orderBy('slide_id','DESC')->where('slide_status','1')->take(3)->get();
		$cate_post = tbl_category_post::orderBy('cate_post_id','DESC')->get();
		$search_product = tbl_product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_name','like','%'.$keywords.'%')->orWhere('brand_name','like','%'.$keywords.'%')->orWhere('category_name','like','%'.$keywords.'%')->paginate(6);
        	$meta_desc ="tìm kiếm sản phẩm";
	        $meta_keywords = "tim kiem san pham";
	        $meta_title = "Trang tìm kiếm";
	        $meta_canonical = $request->url();
		// return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('search_product',$search_product);
		return view('pages.product.search')->with(compact('category','brand','search_product','meta_desc','meta_keywords','meta_title','meta_canonical','slider','cate_post'));
	}
}
