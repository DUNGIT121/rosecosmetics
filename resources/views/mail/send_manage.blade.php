<h2>{{$user_name}} Đã đặt một đơn hàng cho bạn </h2>
<p>
	<b>Đơn Hàng Mới</b>
</p>
<h4>Thông tin đơn hàng</h4>
<h4>Mã Đơn Hàng: {{$order->order_code}}</h4>
<h4>Ngày Đặt Hàng: {{$order->created_at}}</h4>

<h4>Chi Tiết Đơn Hàng</h4>

<table border="1" cellspacing="0" cellpadding="10" width="700">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên Sản Phẩm</th>
			<th>Giá sản phẩm</th>
			<th>Số lượng</th>
			<th>Thành tiền</th>

		</tr>
	</thead>
	<tbody>
		@if(Session::get('cart'))
		<?php
		$total = 0;
		$n = 1;
		?>
		@foreach(Session::get('cart') as $key => $cart)
		<?php
		$subtotal = $cart['product_price']*$cart['product_qty'];
		$total += $subtotal;
		?>
		<tr>
			<td>
				{{$n++}}
			</td>
			<td>
				{{$cart['product_name']}}
			</td>
			<td>
				{{number_format($cart['product_price'],0,',','.')}} đ
			</td>
			<td>
				{{$cart['product_qty']}}
			</td>
			<td>
				{{number_format($subtotal,0,',','.')}} đ
			</td>
			
		</tr>
		@endforeach
	</tbody>
	<tr>
		<td colspan="2">
			<li>Tổng Tiền: <span>{{number_format($total,0,',','.').' '.'VNĐ'}}</span></li>
			@if(Session::get('coupon'))
			<li>  							
				@foreach(Session::get('coupon') as $key => $cou)
				@if($cou['coupon_condition'] == 1)
				Mã giảm giá: - {{$cou['coupon_number']}} %
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
				Mã giảm giá: - {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
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
	</tr>
	@endif
</table>