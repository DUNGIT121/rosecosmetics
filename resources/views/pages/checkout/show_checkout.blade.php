@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Tiếp tục mua hàng</a></li>
				  <li class="active">Thanh toán Giỏ hàng</li>
				</ol>
			</div>

			<div class="register-req">
				<p>Vui lòng đăng ký hoặc đăng nhập để mua hàng và quản lý đơn hàng của bạn</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-info-order')}}" method="POST">
									{{ csrf_field() }}
									<input type="email" name="email" placeholder="email">
									<input type="text" name="customer_name" placeholder="Tên khách hàng">
									<input type="text" name="address" placeholder="Địa chỉ khách hàng">
									<input type="text" name="phone" placeholder="Số điện thoại">
									<textarea name="description"  placeholder="Lưu ý về đơn hàng của bạn" style="font-size: 18px" rows="16"></textarea>
									<input type="submit" value="Gửi" style="font-size: 18px" name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Đơn hàng của bạn</h2>
			</div>

			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên Sản Phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="50" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Mã sản phẩm: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-qty')}}" method="POST">
										@csrf
									<input class="cart_quantity_input" type="number" min="1" name="cart_quantity" value="{{$v_content->qty}}">
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="thêm" name="update_qty" class="btn btn-default btn-sm">
									</form>
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$total_oder = $v_content->price * $v_content->qty;
									echo number_format($total_oder).' '.'vnđ';

									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
	</section> <!--/#cart_items-->
@endsection