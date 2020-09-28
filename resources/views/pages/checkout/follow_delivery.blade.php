@extends('layout')
@section('content')
<div class="styles__StyledOrderStatus-sc-15shxrw-1 kMZEDT">
	<!-- <p class="title" style="font-size: 18px">Trạng Thái Đơn Hàng</p> -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
      <?php
         $user_id = Session::get('user_id');
        ?>
      <li class="breadcrumb-item"><a href="{{url('/order-follow/'.$user_id)}}">Đơn hàng của bạn</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
    </ol>
  </nav>
	<div class="status-block">
		<p><b>Mã Đơn Hàng:</b><a href="{{URL::to('/order-details/'.$follow_d->order_code)}}"><i> {{$follow_d->order_code}} </i></a></p>
		<p></p>
		<span class="status-text"><p><b style="font-size: 18px">Trạng thái:</b><i>
			<?php
			if($follow_d->status == 1){
				echo 'Đặt Hàng Thành Công';
			}
			elseif ($follow_d->status == 2) {
				echo 'Đang Đóng Gói';
			}
			elseif ($follow_d->status == 3) {
				echo 'Đang Giao Hàng';
			}
			elseif ($follow_d->status == 4) {
				echo 'Giao Hàng Thành Công';
			}
			elseif ($follow_d->status == 5) {
				echo 'Đã Hủy Đơn Hàng';
			}
			?>
		 </i></p></span>
		<div class="progress">
			@if($follow_d->status == 1)
			<div class="progress-bar" role="progressbar" style="width: 25%;background-color: green" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đặt Hàng Thành Công</div>

			@elseif($follow_d->status == 2)
			<div class="progress-bar" role="progressbar" style="width: 50%;background-color: green" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đã Xác Nhận Và Đóng Gói</div>

			@elseif($follow_d->status == 3)
			<div class="progress-bar" role="progressbar" style="width: 75%;background-color: green" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đang Giao Hàng</div>
			
			@elseif($follow_d->status == 4)
			<div class="progress-bar" role="progressbar" style="width: 100%;background-color: green" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Giao Hàng Thành Công</div>
			
			@elseif($follow_d->status == 5)
			<div class="progress-bar" role="progressbar" style="width: 100%;background-color: red" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đơn Hàng Đã Hủy</div>
			@endif
		</div>
          <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:red; font-size: 18px ">
      Tổng Đơn Hàng
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900">STT</th>
            <th class="text-center" style="background-color: #FF9900">Tên </br> sản phẩm</th>
            <th class="text-center" style="background-color: #FF9900">Số lượng</th>
            <th class="text-center" style="background-color: #FF9900">Giá </br> sản phẩm</th>
            <th class="text-center" style="background-color: #FF9900">Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 0;
            $total = 0;
          ?>
          @foreach($ord_details as $key => $details)
          <?php
            $i++;
            $subtotal = $details->product_price*$details->product_sales_qty;
            $total+=$subtotal;
          ?>
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>
              @if($order_status!=1)
              <input type="number" disabled min="1" disabled max="1000" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_qty}}" name="product_sales_qty">
              @else
              <input type="number" disabled min="1" max="1000" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_qty}}" name="product_sales_qty">
              @endif
              
            </td>

            
            <td>{{number_format($details->product_price,0,',','.')}} đ</td>
            <td>{{number_format($subtotal,0,',','.')}} đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="2" style="background-color: #FF9900">
              <?php
              $total_coupon = 0;
              ?>
              @if($coupon_condition ==1)
              <?php
                $total_after_coupon = ($total*$coupon_number)/100;
                echo 'Tổng Giảm: - '.number_format($total_after_coupon,0,',','.').' '.'đ'.'</br>';
                $total_coupon = $total - $total_after_coupon + $details->order_feeship;
              ?>
              @else
              <?php
              echo 'Tổng Giảm: - '.number_format($coupon_number,0,',','.').' '.'đ'.'</br>';
              $total_coupon = $total - $coupon_number + $details->order_feeship;
              ?>
              @endif
              Phí ship: {{number_format($details->order_feeship,0,',','.')}} đ
              <h4 style="font-size: 20px; color:black;">Tổng thanh toán: {{number_format($total_coupon,0,',','.')}} đ</h4>
            </td>
          </tr>
          
        </tbody>
      </table>
      
    </div>
  </div>
</div> 
        
@endsection