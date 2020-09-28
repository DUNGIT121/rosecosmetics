@extends('layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background: none;">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
      </ol>
    </nav>

    <div class="panel-heading">
      Đơn Hàng Của Bạn (<i>{{$order_count}} đơn hàng</i>)
    </div>
    <div class="row w3-res-tb">
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
      
      

    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900">STT</th>
            <th class="text-center" style="background-color: #FF9900"> Mã </br> Đơn Hàng</th>
            <th class="text-center" style="background-color: #FF9900">Tên </br> Người Nhận</th>
            <th class="text-center" style="background-color: #FF9900">Số </br> Điện Thoại</th>
            <th class="text-center" style="background-color: #FF9900">Địa Chỉ </br>  Giao Hàng</th>
            <th class="text-center" style="background-color: #FF9900">Hình Thức </br> Thanh toán</th>
            <th class="text-center" style="background-color: #FF9900">Ngày Giao Hàng </br> Dự kiến</th>
            <th style="width:50px; background-color: #FF9900"></th>
          </tr>
        </thead>
        <tbody>
        	<?php
         $i = 0;
         ?>
         @foreach($order_fl as $key => $cate_fl)
         <?php
         $i++;
         ?>
         @if($cate_fl->status==4)
         <tr>
          <td class="text-center" style=" background-color: #00FF00"><i>{{$i}}</i></td>
          <td class="text-center" style=" background-color: #00FF00"><a href="{{URL::to('/order-details/'.$cate_fl->order_code)}}">{{$cate_fl->order_code}}</a></td>
          <td class="text-center" style=" background-color: #00FF00">{{$cate_fl->customer_name}}</td>
          <td class="text-center" style=" background-color: #00FF00">{{$cate_fl->phone}}</td>
          <td class="text-center" style=" background-color: #00FF00">{{$cate_fl->delivery_address}}</td>
          <td class="text-center" style=" background-color: #00FF00">
           @if($cate_fl->payment_method == 1)
           Thanh Toán Bằng Tiền Mặt
           @else
           Thanh Toán Online
           @endif
         </td>

         <td class="text-center" style=" background-color: #00FF00">{{$cate_fl->delivery_date}}</td>
         <td class="text-center" style=" background-color: #00FF00">
          <a href="{{URL::to('/follow-delivery/'.$cate_fl->order_code)}}" class="active styling-edit" ui-toggle-class="" style="font-size: 20px">
            <i class="fa fa-eye text-success text-active"></i></a>
            </td>
          </tr>
         @elseif($cate_fl->status==5)
         <tr>
          <td class="text-center" style=" background-color: #FF3300"><i>{{$i}}</i></td>
          <td class="text-center" style=" background-color: #FF3300"><a href="{{URL::to('/order-details/'.$cate_fl->order_code)}}">{{$cate_fl->order_code}}</a></td>
          <td class="text-center" style=" background-color: #FF3300">{{$cate_fl->customer_name}}</td>
          <td class="text-center" style=" background-color: #FF3300">{{$cate_fl->phone}}</td>
          <td class="text-center" style=" background-color: #FF3300">{{$cate_fl->delivery_address}}</td>
          <td class="text-center" style=" background-color: #FF3300">
           @if($cate_fl->payment_method == 1)
           Thanh Toán Bằng Tiền Mặt
           @else
           Thanh Toán Online
           @endif
         </td>

         <td class="text-center" style=" background-color: #FF3300">{{$cate_fl->delivery_date}}</td>
         <td class="text-center" style=" background-color: #FF3300">
          <a href="{{URL::to('/follow-delivery/'.$cate_fl->order_code)}}" class="active styling-edit" ui-toggle-class="" style="font-size: 20px">
            <i class="fa fa-eye text-success text-active"></i></a>
            </td>
          </tr>
         @else
         <tr>
          <td class="text-center"><i>{{$i}}</i></td>
          <td class="text-center"><a href="{{URL::to('/order-details/'.$cate_fl->order_code)}}">{{$cate_fl->order_code}}</a></td>
          <td class="text-center">{{$cate_fl->customer_name}}</td>
          <td class="text-center">{{$cate_fl->phone}}</td>
          <td class="text-center">{{$cate_fl->delivery_address}}</td>
          <td class="text-center">
           @if($cate_fl->payment_method == 1)
           Thanh Toán Bằng Tiền Mặt
           @else
           Thanh Toán Online
           @endif
         </td>

         <td class="text-center">{{$cate_fl->delivery_date}}</td>
         <td class="text-center">
          <a href="{{URL::to('/follow-delivery/'.$cate_fl->order_code)}}" class="active styling-edit" ui-toggle-class="" style="font-size: 20px">
            <i class="fa fa-eye text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có chắc chắn muốn Hủy Đơn hàng này?')" href="{{URL::to('/cancel-order/'.$cate_fl->order_code)}}" class="active styling-delete" ui-toggle-class="" style="font-size: 20px">
              <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <span>{!!$order_fl->render()!!}</span>
  </div>
</div>
@endsection