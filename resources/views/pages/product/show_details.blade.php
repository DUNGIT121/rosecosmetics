@extends('layout')
@section('content')

<?php
$messages = Session::get('messages');
if($messages){
	echo '<div class="alert alert-danger">',$messages,'</div>';
	Session::put('messages',null);
}
?>
<?php
$message = Session::get('message');
if($message){
	echo '<div class="alert alert-success">',$message,'</div>';
	Session::put('message',null);
}
?>
<div class="product-details"><!--product-details-->

	<div class="fb-share-button" data-href="http://localhost:81/rosecosmetics/application/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$meta_canonical}} src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
	<div class="fb-like" data-href="{{$meta_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb" style="background: none;">
	    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
	    <li class="breadcrumb-item"><a href="{{url('/view-category/'.$category_id)}}">{{$product_cate}}</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
	  </ol>
	</nav>
	<div class="col-sm-5">
		<style type="text/css">
			.lSPager.lSGallery img {
			    display: block;
			    height: 120px;
			    max-width: 100%;
			}
			li.active{
				border: 2px solid #FE980F;
			}
		</style>
		<ul id="imageGallery">
		  <li data-thumb="{{URL::to('public/uploads/product/'.$details_Product->images)}}" data-src="{{URL::to('public/uploads/product/'.$details_Product->images)}}">
		    <img width="100%" src="{{URL::to('public/uploads/product/'.$details_Product->images)}}" />
		  </li>
		  @foreach($image as $key => $img)
		  <li data-thumb="{{URL::to('public/uploads/product/details/'.$img->images)}}" data-src="{{URL::to('public/uploads/product/details/'.$img->images)}}">
		    <img width="100%" src="{{URL::to('public/uploads/product/details/'.$img->images)}}" />
		  </li>
		  @endforeach
		</ul>

	</div>

	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->

			<img src="{{URL::to('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
			<h2>{{$details_Product->product_name}}</h2>
			<p>Mã Sản Phẩm: {{$details_Product->product_id}}</p>
			<img src="images/product-details/rating.png" alt="" />
			<form action="{{URL::to('/save-cart')}}" method="POST">
				@csrf
				<input type="hidden" value="{{$details_Product->product_id}}" class="cart_product_id_{{$details_Product->product_id}}">
				<input type="hidden" value="{{$details_Product->product_name}}" class="cart_product_name_{{$details_Product->product_id}}">
				<input type="hidden" value="{{$details_Product->images}}" class="cart_product_image_{{$details_Product->product_id}}">
				<input type="hidden" value="{{$details_Product->total - $details_Product->sold}}" class="cart_product_quantity_{{$details_Product->product_id}}">
				<input type="hidden" value="{{$details_Product->output_price}}" class="cart_product_price_{{$details_Product->product_id}}">
				
				<span>
					<span>{{number_format($details_Product->output_price,0,',','.').'VNĐ'}}</span>
					
					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" class="cart_product_qty_{{$details_Product->product_id}}"  value="1" />
					<input name="productid_hidden" type="hidden"  value="{{$details_Product->product_id}}" />
				</span>
				<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$details_Product->product_id}}" name="add-to-cart">
			</form>
			<p><b>Tình Trạng:</b> Còn hàng</p>
			<p><b>Đã bán: </b> {{$details_Product->sold}} Sản phẩm</p>
			<p><b>Thương hiệu:</b> {{$details_Product->brand_name}}</p>
			<p><b>Danh mục:</b> {{$details_Product->category_name}}</p>
			<a href=""><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Bình luận</a></li>
			<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<p><b>- Dung tích/khối lượng:</b> {!!$details_Product->weight!!} (ml/g)</p>
			<p><b>- Hạn sử Dụng:</b> {!!$details_Product->expire!!}</p>
			<p><b>- Mô tả sản phẩm:</b> {!!$details_Product->description!!}</p>			
		</div>

		<div class="tab-pane fade" id="companyprofile" >
			<div class="fb-comments" data-href="{{$meta_canonical}}" data-numposts="10" data-width=""></div>
			
		</div>

		<div class="tab-pane fade" id="reviews" >
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>

				<form action="#">
					<span>
						<input type="text" placeholder="Your Name"/>
						<input type="email" placeholder="Email Address"/>
					</span>
					<textarea name="" ></textarea>
					<b>Rating: </b> <img src="{{URL::to('public/frontend/images/rating.png')}}" alt="" />
					<button type="button" class="btn btn-default pull-right">
						Submit
					</button>
				</form>
			</div>
		</div>

	</div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm liên quan</h2>


	<div class="carousel-inner">
		<div class="item active">
			@foreach($related_Product as $key => $relate)
			<a href="{{URL::to('/details-product/'.$relate->product_id)}}">	
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<form>
									@csrf
									<input type="hidden" value="{{$relate->product_id}}" class="cart_product_id_{{$relate->product_id}}">
									<input type="hidden" value="{{$relate->product_name}}" class="cart_product_name_{{$relate->product_id}}">
									<input type="hidden" value="{{$relate->images}}" class="cart_product_image_{{$relate->product_id}}">
									<input type="hidden" value="{{$relate->output_price}}" class="cart_product_price_{{$relate->product_id}}">
									<input type="hidden" value="1" class="cart_product_qty_{{$relate->product_id}}">
									<a href="{{URL::to('/details-product/'.$relate->product_id)}}">
										<img src="{{URL::to('public/uploads/product/'.$relate->images)}}" height="250" width="200" alt="" />
										<h2>{{number_format($relate->output_price).' '.'VNĐ'}}</h2>
										<p>{{$relate->product_name}}</p>

									</a> 
									<input name="qty" type="hidden" value="1" />
									<input name="productid_hidden" type="hidden" value="{{$relate->product_id}}" />
									<button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$relate->product_id}}" name="add-to-cart">
										Thêm giỏ hàng
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</a>
			@endforeach
		</div>
	</div>	

	
</div><!--/recommended_items-->
<span>{!!$related_Product->render()!!}</span>
@endsection
