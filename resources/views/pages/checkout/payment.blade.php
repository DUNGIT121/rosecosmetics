@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<!-- <div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/trang-chu')}}">Tiếp tục mua hàng</a></li>
			</ol>
		</div> -->
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb" style="background: none;">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
		    <li class="breadcrumb-item"><a href="{{url('/gio-hang')}}">Giỏ Hàng</a></li>
		    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
		  </ol>
		</nav>
		<div class="payment-options">
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<form style="margin: 30px">
								@csrf
								<div class="form-group">
									<label for="exampleInputPassword1" style=" font-size: 17px; color: orange;">Chọn tỉnh/thành phố</label>
									<select name="city" id="city" class="form-control input-sm m-bot15 choose city" style="width: 400px">
										<option value="">----Chọn tỉnh/thành phố----</option>
										@foreach($city as $key => $tp)
										<option value="{{$tp->matp}}">{{$tp->name_city}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1" style=" font-size: 17px; color: orange;">Chọn Quận/huyện</label>
									<select name="province" id="province" class="form-control input-sm m-bot15 choose province" style="width: 400px">           
										<option value="">----Chọn Quận/huyện----</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1" style=" font-size: 17px; color: orange;">Chọn xã/phương/thị trấn</label>
									<select name="wards" id="wards" class="form-control input-sm m-bot15 wards" style="width: 400px">                           
										<option value="">----Chọn xã/phương/thị trấn----</option>
									</select>
								</div>  
								<input type="button" value="Tính phí vận chuyển" style="font-size: 15px; width: 400px" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
							</form>
							<p><h4 style="color: orange; margin: 30px" >Thông tin khách hàng</h4></p>
							<div class="form-one">
								<form method="POST" style="margin: 30px">
									@csrf
									<input type="email" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập địa chỉ email" name="email" class="email" placeholder="Địa chỉ email" style="width: 400px" required="" >
									<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên đầy đủ" name="customer_name" class="customer_name" placeholder="Tên khách hàng" style="width: 400px" required="">
									<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập đúng địa chỉ giao hàng" name="delivery_address" class="delivery_address" placeholder="Địa chỉ giao hàng" style="width: 400px" required="">
									<input type="text" data-validation="number" data-validation-length="min10" data-validation-error-msg="vui lòng Đúng só điện thoại" name="phone" class="phone" placeholder="Số điện thoại" style="width: 400px" required="">
									<textarea name="description" class="description"  placeholder="Lưu ý về đơn hàng của bạn" style="font-size: 18px; width: 400px" rows="5"></textarea>

									@if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else
									<input type="hidden" name="order_fee" class="order_fee" value="50000">
									@endif

									@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key => $cou)
									<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
									@endforeach
									@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif
									
									
									<div class="">
										<div class="form-group">
											<label for="exampleInputPassword1"><h3 style=" font-size: 20px; color: orange;">Hình thức thanh toán</h3></label>
											<select name="payment_method" class="form-control input-sm m-bot15 payment_method" style="width: 400px">    
												<option value="1">Nhận hàng thanh toán</option>                       
												<option value="0">Thanh toán online</option>
												
											</select>
										</div> 
									</div>
									@if(Session::get('cart'))
									<input type="button" value="xác nhận đặt hàng" style="font-size: 15px; width: 400px" name="send_order" class="btn btn-primary btn-sm send_order">
									@else
									<?php
									echo '';
									?>
									@endif
								</form>
								
								<div class="col-sm-12 clearfix">
									<div class="container">
										<div class="table-responsive cart_info">
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
											<?php
											$content = Session::get('cart');
											?>
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

																	
																	<input class="cart_quantity" type="number" min="1" max="100" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
																	
																	

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
											@if(Session::get('cart'))
											<form>
												<tr>
													<td colspan="2">
														<li>Tổng Tiền: <span>{{number_format($total,0,',','.').' '.'VNĐ'}}</span></li>
														@if(Session::get('coupon'))
														<li>  							
															@foreach(Session::get('coupon') as $key => $cou)
															@if($cou['coupon_condition'] == 1)
															Mã giảm: {{$cou['coupon_number']}} %
															<p>
																<?php
																$total_coupon = ($total*$cou['coupon_number'])/100;
																
																?>
															</p>
															<p>
																<?php
																$total_after_coupon = $total - $total_coupon;
																?>
															</p>
															<!-- <p><li>Thành tiền:  {{number_format($total_after_coupon,0,',','.')}} VNĐ</li></p> -->
															@elseif($cou['coupon_condition'] == 2)
															Mã giảm: -{{number_format($cou['coupon_number'],0,',','.')}} VNĐ
															<p>
																<?php
																$total_after_coupon = $total-$cou['coupon_number'];
																?>
															</p>
															<!-- <p><li>Thành tiền: {{number_format($total_after_coupon,0,',','.')}} VNĐ</li></p> -->
															@endif
															@endforeach						
														</li>
														@endif
														@if(Session::get('fee'))
														<li>
															<a class="cart_quantity_delete" href="{{URL::to('/del-fee')}}"><i class="fa fa-times"></i></a>
															Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}} VNĐ</span>
														</li>
														@endif
														<?php 
														$feeship = Session::get('fee');
														$total_after_fee = $total + $feeship;
														?>
														<li> Thành Tiền:
															<?php
															if(Session::get('fee') && !Session::get('coupon')){
																$total_after = $total_after_fee;
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(!Session::get('fee') && Session::get('coupon')){
																$total_after = $total_after_coupon;
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(Session::get('fee') && Session::get('coupon')){
																$total_after = $total_after_coupon + $feeship;
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(!Session::get('fee') && !Session::get('coupon')){
																$total_after = $total;
																echo number_format($total_after,0,',','.').'VNĐ';
															}
															?>
														</li>
													</td>

													
													<td>
														<input type="submit" value="Cập nhật giỏ hàng" name="update_qty" style="margin: 25px; width: 200px" class="check_out btn btn-default btn-sm">
													</td>
													<td><a class="btn btn-default check_out" style="margin: 25px; width: 200px" href="{{URL::to('/delete-all-cart')}}">Xóa giỏ hàng</a></td>
													<td><a class="btn btn-default check_out" style="margin: 25px; width: 200px" href="{{URL::to('/delete-coupon')}}">Xóa mã giảm giá</a></td>
												</tr>
											</form>
											<td>
												<form method="POST" action="{{url('/check-coupon')}}">
													@csrf
													<input type="text" class="form-control" name="coupon" placeholder="nhập mã giảm giá" style="width: 300px"></br>
													<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="mã giảm giá" style="width: 300px">

												</form>
											</td>
											
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection