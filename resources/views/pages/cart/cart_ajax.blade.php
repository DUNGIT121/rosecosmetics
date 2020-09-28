@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<!-- <div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/trang-chu')}}">Tiếp tục mua hàng</a></li>
				
			</ol>
			
		</div> -->
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
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb" style="background: none;">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
		    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
		  </ol>
		</nav>
		<div class="table-responsive cart_info">
			<form action="{{url('/update-cart')}}" method="POST">
				@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên Sản Phẩm</td>
							<td class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart'))
						<?php
						$total = 0;
						?>
						@foreach(Session::get('cart') as $key => $cart)
						<?php
						$subtotal = $cart['product_price']*$cart['product_qty'];
						$total += $subtotal;
						?>
						<tr>
							<td class="cart_product">
								<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="70" alt="{{$cart['product_name']}}">
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">

									
									<input class="cart_quantity" type="number" min="1" max="1000" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
									
									

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">

									{{number_format($subtotal,0,',','.')}} đ
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-cart-pr/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							

							<td>
								<?php
								$user_id = Session::get('user_id');
								if($user_id!=NULL ){
									?>
									<a class="btn btn-default check_out" style="margin: 25px" href="{{URL::to('/payment')}}">
									Thanh Toán</a>
									<?php 
								}else{
									?>
									<a class="btn btn-default check_out" style="margin: 25px" href="{{URL::to('/login')}}">Thanh Toán</a>
									<?php
								}
								?>
							</td>
							<td><a class="btn btn-default check_out" style="margin: 25px" href="{{url('/delete-all-cart')}}">Xóa giỏ hàng</a></td>
							<td>
								<input type="submit" value="Cập nhật giỏ hàng" name="update_qty" style="margin: 25px" class="check_out btn btn-default btn-sm">
							</td>
							<td colspan="2">
								<li>Tổng Tiền: <span>{{number_format($total,0,',','.')}} đ</span></li>

							</td>
						</tr>

					</tbody>
					@else
					<tr>
						<td colspan="5">
							<center>
								<?php 
								echo '<h4>Bạn Chưa có sản phẩm nào trong giỏ hàng</h4>';
								?>
							</center>

						</td>
					</tr>
					@endif
				</table>

			</form>
			
			
			

		</div>
	</div>
</section> <!--/#cart_items-->

@endsection