@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Cập nhật thương hiệu Sản Phẩm
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
					@foreach($edit_brand as $key=>$edit_br)
					<form role="form" action="{{URL::to('/update-brand/'.$edit_br->brand_id)}}" method="post">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên thương hiệu</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng tên thương hiệu" value="{{$edit_br->brand_name}}" name="brand_name" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả thương hiệu</label>
							<textarea type="resize: none" rows="5" class="form-control" name="brand_desc" id="ckeditor">{{$edit_br->brand_desc}}</textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="meta_keywords" id="ckeditor1">{{$edit_br->meta_keywords}}</textarea> 
						</div>  
						<button type="submit" name="update_brand" class="btn btn-info">Cập nhật thương hiệu</button>
					</form>
					@endforeach
				</div>

			</div>
		</section>

	</div>
</div>
@endsection