@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm Tài khoản user
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
					<form role="form" action="{{URL::to('/save-user')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="exampleInputEmail1">Tên Người dùng</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên người dùng" name="user_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Người Dùng">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Tài khoản Email</label>
							<input type="Email" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập đúng Email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tài Khoản Email">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Thêm Mật khẩu</label>
							<input type="text" data-validation="length" data-validation-length="min8" data-validation-error-msg="Mật khẩu phải có ít nhất 8 ký tự" name="password" class="form-control" id="exampleInputEmail1" placeholder="Nhập Mật Khẩu">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Thêm Địa Chỉ</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập Địa chỉ" name="address" class="form-control" id="exampleInputEmail1" placeholder="nhập Địa Chỉ">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Thêm Số điện thoại</label>
							<input type="number" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng nhập đúng Số Điện Thoại" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Nhập Số Điện Thoại">
						</div><div class="form-group">
						<label for="exampleInputPassword1">Trạng thái</label>
						<select name="status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">ẩn</option>
                            </select>
                        </div>   
						<div class="form-group">
						<label for="exampleInputPassword1">Quyền Người Dùng</label>
						<select name="role_id" class="form-control input-sm m-bot15">
                                <option value="1">Khách Hàng</option>
                                <option value="2">Nhân Viên</option>
                                <option value="3">Quản Trị Viên</option>
                            </select>
                        </div>
                        <div class="form-group">
						<label for="exampleInputPassword1">Cấp độ khách hàng</label>
						<select name="level" class="form-control input-sm m-bot15">
                                <option value="1">Khách Hàng Mới</option>
                                <option value="2">Khách Hàng Tiềm Năng</option>
                            </select>
                        </div>        
						<button type="submit" name="add_user" class="btn btn-info">Thêm Tài Khoản</button>
					</form>
				</div>

			</div>
		</section>
		
	</div>
</div>
@endsection