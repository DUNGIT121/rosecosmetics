@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm phí vận chuyển
			</header>

			<div class="panel-body">
				<?php
				$messages = Session::get('messages');
				if($messages){
					echo '<span class= "text-alert">',$messages,'</span>';
					Session::put('messages',null);
				}
				?>
				
				@if(session()->has('message'))
				<div class="alert alert-success">
					{{session()->get('message')}}
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{{session()->get('error')}}
				</div>
				@endif
				<div class="position-center">
					<form>
						@csrf
						<div class="form-group">
							<label for="exampleInputPassword1">Chọn tỉnh/thành phố</label>
							<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
								<option value="">----Chọn tỉnh/thành phố----</option>
								@foreach($city as $key => $tp)
								<option value="{{$tp->matp}}">{{$tp->name_city}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Chọn Quận/huyện</label>
							<select name="province" id="province" class="form-control input-sm m-bot15 choose province">           
								<option value="">----Chọn Quận/huyện----</option>

							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Chọn xã/phương/thị trấn</label>
							<select name="wards" id="wards" class="form-control input-sm m-bot15 wards">                           
								<option value="">----Chọn xã/phương/thị trấn----</option>

							</select>
						</div>  
						<div class="form-group">
							<label for="exampleInputEmail1">phí vận chuyển</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập phí vận chuyển" name="feeship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="phí vận chuyển">
						</div>  
						<button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button></br>
					</form>
				</div>
				
				<div id="load_delivery">

				</div>
				
			</div>
		</section>

	</div>
</div>
@endsection