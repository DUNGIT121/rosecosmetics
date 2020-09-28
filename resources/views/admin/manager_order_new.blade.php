@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
           $i = 0;
          ?>
          @foreach($order_new as $key => $cate_order)
          <?php
            $i++;
          ?>
          <tr>
            <td><i>{{$i}}</i></td>

            <td>{{$cate_order->order_code}}</td>
            <td>@if($cate_order->status == 1)
              Đơn Hàng Mới
              @elseif($cate_order->status == 2)
              Đang Xử Lý
              @elseif($cate_order->status == 3)
              Đang Giao Hàng
              @elseif($cate_order->status == 4)
              Đã Giao Hàng
              @else
              Đơn hàng bị hủy
              @endif
            </td>
            <td>{{$cate_order->created_at}}</td>
            <td>
              <a href="{{URL::to('/view-order/'.$cate_order->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
                <!-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa Đơn hàng này?')" href="{{URL::to('/delete-order/'.$cate_order->order_code)}}" class="active styling-delete" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
       
      </div>
    </div>
    <span>{!!$order_new->render()!!}</span>
    @endsection