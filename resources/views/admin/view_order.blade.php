@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
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

            <th>Tên Người đặt hàng</th>
            <th>email Người đặt hàng</th>
            <th>Sô điên thoại Người đặt hàng</th>

            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>

            <td>{{$customer->user_name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->phone}}</td>
            
          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>

</br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin giao hàng
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
            <th style="width:50px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Người nhận hàng</th>
            <th>Địa chỉ Nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Ghi chú đơn hàng</th>
            <th>Hình thức thanh toán</th>
            

            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($order as $key => $cate_ord)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            
            <td>{{$cate_ord->customer_name}}</td>
            <td>{{$cate_ord->delivery_address}}</td>
            <td>{{$cate_ord->phone}}</td>
            <td>{{$cate_ord->description}}</td>
            <td>@if($cate_ord->payment_method == 0)
                Thanh toán online
            @else
                Thanh toán khi nhận hàng
            @endif
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
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
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
            <th>
              STT
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Số lượng</th>
            <th> Mã giảm giá</th>
            <th>Giá sản phẩm</th>
            <th>Phí Ship</th>
            <th>Tổng tiền</th>
            
            <th style="width:50px;"></th>
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
            <td>{{$details->product->total - $details->product->sold}}</td>
            <td>
              @if($order_status!=1)
              <input type="number" min="1" disabled max="1000" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_qty}}" name="product_sales_qty">
              @else
              <input type="number" min="1" max="1000" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_qty}}" name="product_sales_qty">
              @endif
              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->total-$details->product->sold}}">
              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
              @if($order_status==1)
              <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập nhật</button>
              @endif
            </td>

            <td>@if($details->order_coupon!='no')
                {{$details->order_coupon}}
              @else
                Không có mã giảm giá
              @endif
            </td>
            <td>{{number_format($details->product_price,0,',','.')}} đ</td>
            <td>{{number_format($details->order_feeship,0,',','.')}} đ</td>
            <td>{{number_format($subtotal,0,',','.')}} đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="2">
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
              <h4 style="font-size: 20px; color:black;">Thành Tiền: {{number_format($total_coupon,0,',','.')}} đ</h4>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              @foreach($order as $key => $or)
              @if($or->status==1)
              <form>
                @csrf
              <select class="form-control order_details">
                <option value="">-----xử lý đơn hàng-----</option>
                <option id="{{$or->order_id}}" selected value="1">Chờ xử lý</option>
                <option id="{{$or->order_id}}" value="2">Xác nhận đơn hàng</option>
                <option id="{{$or->order_id}}" value="3">Đang giao hàng</option>
                <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                <option id="{{$or->order_id}}" value="5">Đơn hàng đã bị hủy</option>
              </select>
              </form>
              @elseif($or->status==2)
              <form>
                @csrf
              <select class="form-control order_details">
                <option value="">-----xử lý đơn hàng-----</option>
                <option id="{{$or->order_id}}" value="1">Chờ xử lý</option>
                <option id="{{$or->order_id}}" selected value="2">Xác nhận đơn hàng</option>
                <option id="{{$or->order_id}}" value="3">Đang giao hàng</option>
                <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                <option id="{{$or->order_id}}" value="5">Đơn hàng đã bị hủy</option>
              </select>
              </form>
              @elseif($or->status==3)
              <form>
                @csrf
              <select class="form-control order_details">
                <option value="">-----xử lý đơn hàng-----</option>
                <option id="{{$or->order_id}}" value="1">Chờ xử lý</option>
                <option id="{{$or->order_id}}" value="2">Xác nhận đơn hàng</option>
                <option id="{{$or->order_id}}" selected value="3">Đang giao hàng</option>
                <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                <option id="{{$or->order_id}}" value="5">Đơn hàng đã bị hủy</option>
              </select>
              </form>
              @elseif($or->status==4)
              <form>
                @csrf
              <select class="form-control order_details">
                <option value="">-----xử lý đơn hàng-----</option>
                <option id="{{$or->order_id}}" value="1">Chờ xử lý</option>
                <option id="{{$or->order_id}}" value="2">Xác nhận đơn hàng</option>
                <option id="{{$or->order_id}}" value="3">Đang giao hàng</option>
                <option id="{{$or->order_id}}" selected value="4">Đã giao hàng</option>
                <option id="{{$or->order_id}}" value="5">Đơn hàng đã bị hủy</option>
              </select>
              </form>
              @else
              <form>
                @csrf
              <select class="form-control order_details">
                <option value="">-----xử lý đơn hàng-----</option>
                <option id="{{$or->order_id}}" value="1">Chờ xử lý</option>
                <option id="{{$or->order_id}}" value="2">Xác nhận đơn hàng</option>
                <option id="{{$or->order_id}}" value="3">Đang giao hàng</option>
                <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                <option id="{{$or->order_id}}" selected value="5">Đơn hàng đã bị hủy</option>
              </select>
              </form>
              @endif
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In Hóa Đơn</a>
    </div>
  </div>
</div> 
@endsection