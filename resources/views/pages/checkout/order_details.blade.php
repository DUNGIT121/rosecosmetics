@extends('layout')
@section('content')
	<div class="table-agile-info">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background: none;">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
        <?php
         $user_id = Session::get('user_id');
        ?>
        <li class="breadcrumb-item"><a href="{{url('/order-follow/'.$user_id)}}">Đơn Hàng Của Bạn</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
      </ol>
    </nav>
  <div class="panel panel-default">
    <div class="panel-heading" style="color:red; font-size: 18px ">
      Thông tin Người đặt hàng
    </div>
    
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
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th class="text-center" style="background-color: #FF9900">Tên Người </br> đặt hàng</th>
            <th class="text-center" style="background-color: #FF9900">Tài khoản </br> đặt hàng</th>
            <th class="text-center" style="background-color: #FF9900">Số điện thoại </br> Người đặt hàng</th>
          </tr>
        </thead>
        <tbody>

          <tr>

            <td class="text-center">{{$customer->user_name}}</td>
            <td class="text-center">{{$customer->email}}</td>
            <td class="text-center">{{$customer->phone}}</td>
            
          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>

</br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:red; font-size: 18px ">
      Thông tin người nhận
    </div>
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{session()->get('message')}}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">
      {{session()->get('error')}}
    </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th class="text-center" style="background-color: #FF9900">Tên Người </br> nhận hàng</th>
            <th class="text-center" style="background-color: #FF9900">Địa chỉ </br> Nhận hàng</th>
            <th class="text-center" style="background-color: #FF9900">Số </br> điện thoại</th>
            <th class="text-center" style="background-color: #FF9900">Ghi chú </br> đơn hàng</th>
            <th class="text-center" style="background-color: #FF9900">Ngày </br> đặt hàng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order as $key => $cate_ord)
          <tr>
            
            <td class="text-center">{{$cate_ord->customer_name}}</td>
            <td class="text-center">{{$cate_ord->delivery_address}}</td>
            <td class="text-center">{{$cate_ord->phone}}</td>
            <td class="text-center">{{$cate_ord->description}}</td>
            <td class="text-center">{{$cate_ord->created_at}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:red; font-size: 18px ">
      Chi tiết đơn hàng
    </div>
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{session()->get('message')}}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">
      {{session()->get('error')}}
    </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900">STT</th>
            <th class="text-center" style="background-color: #FF9900">Tên </br> sản phẩm</th>
            <th class="text-center" style="background-color: #FF9900">Số lượng</th>
            <th class="text-center" style="background-color: #FF9900"> Mã </br> giảm giá</th>
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

            <td>@if($details->order_coupon!='no')
                {{$details->order_coupon}}
              @else
                Không có mã giảm giá
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