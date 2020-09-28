@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm Slider
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
					<form role="form" action="{{URL::to('/insert-slider')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="exampleInputEmail1">Tên slider</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên slider" name="slide_name" class="form-control" id="exampleInputEmail1" placeholder="Tên slider">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hình ảnh slider</label>
							<input type="file" name="slide_image" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả slider</label>
							<textarea type="resize: none" rows="5" class="form-control" name="slide_description" id="ckeditor" placeholder="mô tả slider"></textarea> 
						</div>
						
						<div class="form-group">
						<label for="exampleInputPassword1">Trạng thái</label>
						<select name="slide_status" class="form-control input-sm m-bot15">
								<option value="1">Hiển thị slide</option>
                                <option value="0">ẩn slide</option>
                                
                            </select>
                        </div>    
						<button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
					</form>
				</div>

			</div>
		</section>

	</div>
</div>
@endsection