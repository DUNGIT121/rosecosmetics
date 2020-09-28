@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm mã giảm giá
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
					<form role="form" action="{{URL::to('/save-coupon')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="exampleInputEmail1">Tên chương trình giảm giá</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên chương trình khuyến mãi" name="coupon_name" class="form-control" id="exampleInputEmail1" style="font-size: 15px;">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mã giảm giá</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập mã giảm giá" name="coupon_code" class="form-control" id="exampleInputEmail1" style="font-size: 15px;">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ngày bắt đầu khuyến mãi</label>
							<input type="date" data-validation="date" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng ngày" name="start_coupon" class="form-control" id="exampleInputEmail1" placeholder="Hạn sửa dụng">
						</div>	
						<div class="form-group">
							<label for="exampleInputEmail1">Ngày kết thúc khuyến mãi</label>
							<input type="date" data-validation="date" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng ngày" name="end_coupon" class="form-control" id="exampleInputEmail1" placeholder="Hạn sửa dụng">
						</div>	
						<div class="form-group">
							<label for="exampleInputPassword1">Tính năng</label>
							<select name="coupon_condition" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng chọn tính năng giảm giá" class="form-control input-sm m-bot15" style="font-size: 15px;">
								<option value="">-------chọn-------</option>
								<option value="1">Giảm theo phần trăm</option>
								<option value="2">Giảm theo tiền</option>
								
							</select>
						</div>  
						<div class="form-group">
							<label for="exampleInputEmail1">Số % hoặc tiền giảm</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập số % hoặc tiền giảm" name="coupon_number" class="form-control" id="exampleInputEmail1" style="font-size: 15px;">
						</div>
						
						<button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
					</form>
				</div>

			</div>
		</section>

	</div>
</div>
@endsection