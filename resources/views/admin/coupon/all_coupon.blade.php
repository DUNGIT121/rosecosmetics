@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
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
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên chương trình giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Ngày khuyến mãi</th>
            <th>Ngày kết thúc</th>
            <th>Điểu kiện giảm giá</th>
            <th>Số % hoặc tiền giảm</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
           

            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->start_coupon}}</td>
            <td>{{$cou->end_coupon}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($cou->coupon_condition == 1){
                ?>
                Giảm theo %
                <?php
              }else{
                ?>
                Giảm theo tiền
                <?php
              }
              ?>
            </span></td>
            <td><span class="text-ellipsis">
              <?php
              if($cou->coupon_condition == 1){
                ?>
                Giảm {{$cou->coupon_number}} %
                <?php
              }else{
                ?>
                Giảm {{$cou->coupon_number}} đ
                <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <!-- <a onclick="return confirm('Bạn có chắc chắn muốn mã giảm giá này?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-delete" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a> -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <span>{!!$coupon->render()!!}</span>
      <footer class="panel-footer">
        
      </footer>
    </div>
  </div>
  @endsection
  