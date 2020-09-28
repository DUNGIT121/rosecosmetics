@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Cập nhật tài khoản user
			</header>

			<div class="panel-body">
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
				<div class="position-center">
					@foreach($edit_user as $key=>$edit_u)
					<form role="form" action="{{URL::to('/update-user/'.$edit_u->user_id)}}" method="post">
						@csrf
						<div class="form-group">
							<label for="exampleInputEmail1">Tên Người Dùng</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên người dùng" value="{{$edit_u->user_name}}" name="user_name" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Tài khoản Email</label>
							<input type="Email" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập đúng Email" value="{{$edit_u->email}}" name="email" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mật khẩu</label>
							<input type="text" data-validation="length" data-validation-length="min8" data-validation-error-msg="Mật khẩu phải có ít nhất 8 ký tự" value="{{$edit_u->password}}" name="password" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Địa chỉ người dùng</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng Nhập địa chỉ người dùng" value="{{$edit_u->address}}" name="address" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Số Điện Thoại</label>
							<input type="number" data-validation="length" data-validation-length="min10" data-validation-error-msg="vui lòng nhập đúng số điện thoại" value="{{$edit_u->phone}}" name="phone" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
						<label for="exampleInputPassword1">Quyền Người Dùng</label>
						@if($edit_u->role_id==1)
						<select name="role_id" class="form-control input-sm m-bot15">
                                <option selected value="1">Khách Hàng</option>
                                <option value="2">Nhân Viên</option>
                                <option value="3">Quản Trị Viên</option>
                            </select>
                        @elseif($edit_u->role_id==2)
                        <select name="role_id" class="form-control input-sm m-bot15">
                                <option value="1">Khách Hàng</option>
                                <option selected value="2">Nhân Viên</option>
                                <option value="3">Quản Trị Viên</option>
                            </select>
                        @else
                        <select name="role_id" class="form-control input-sm m-bot15">
                                <option value="1">Khách Hàng</option>
                                <option value="2">Nhân Viên</option>
                                <option selected value="3">Quản Trị Viên</option>
                            </select>
                        @endif
                        </div>
                        <div class="form-group">
						<label for="exampleInputPassword1">Cấp độ khách hàng</label>
						@if($edit_u->level==1)
						<select name="level" class="form-control input-sm m-bot15">
                                <option selected value="1">Khách Hàng Mới</option>
                                <option value="2">Khách Hàng Tiềm Năng</option>
                            </select>
                        @elseif($edit_u->level==2)
                        <select name="level" class="form-control input-sm m-bot15">
                                <option value="1">Khách Hàng Mới</option>
                                <option selected value="2">Khách Hàng Tiềm Năng</option>
                            </select>   
                        @endif
                        </div>       
						<button type="submit" name="update_user" class="btn btn-info">Cập nhật tài khoản</button>
					</form>
					@endforeach
				</div>

			</div>
		</section>

	</div>
</div>
@endsection