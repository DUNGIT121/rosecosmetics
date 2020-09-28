@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê user
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
      <button class="btn btn-sm btn-default" type="button" style="background-color:#00FF00; font-size: 15px; margin-left:1035px"><a href="{{URL::to('/add-user')}}"> + Người dùng mới</a></button>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900; color: black">
              STT
            </th>
            <th class="text-center" style="background-color: #FF9900; color: black">Tên Người Dùng</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Email</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Số Điện Thoại</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Địa Chỉ</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Quyền Hạn</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Cấp Độ</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Trạng thái</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Ngày Tạo</th>
            <th style="width:50px; background-color: #FF9900"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          ?>
          @foreach($all_user as $key => $cate_u)
          <tr>
            <td>{{$i++}}</td>

            <td>{{$cate_u->user_name}}</td>
            <td>{{$cate_u->email}}</td>
            <td>{{$cate_u->phone}}</td>
            <td>{{$cate_u->address}}</td>
            <td><span class="text-ellipsis">
            	<?php
            	if($cate_u->role_id==3){
            		echo 'Quản Trị Viên';
            	}elseif($cate_u->role_id==2){
            		echo 'Nhân Viên';
            	}else{
            		echo 'Khách hàng';
            	}
            	?>
            	</span>
            </td>
            <td><span class="text-ellipsis">
            	<?php
            	if($cate_u->level==2){
            		echo 'Khách Hàng Tiềm Năng';
            	}else{
            		echo 'Khách Hàng Mới';
            	}
            	?>
            	</span>
            </td>
            
            <td><span class="text-ellipsis">
              <?php
              if($cate_u->status == 0){
                ?>
                <a href="{{URL::to('/active-user/'.$cate_u->user_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
              }else{
                ?>
                <a href="{{URL::to('/unactive-user/'.$cate_u->user_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              }
              ?>
            </span></td>
            <td>{{$cate_u->created_at}}</td>
            <td>
              <a href="{{URL::to('/edit-user/'.$cate_u->user_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <!-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" href="{{URL::to('/delete-user/'.$cate_u->user_id)}}" class="active styling-delete" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <span>
        {!! $all_user->render() !!}
        </span>
      </div>
    </div>
    @endsection