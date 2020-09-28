@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Cập nhật danh mục Sản Phẩm
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
					@foreach($edit_category as $key=>$edit_cate)
					<form role="form" action="{{URL::to('/update-category/'.$edit_cate->category_id)}}" method="post">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên danh mục</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng điền tên danh mục" value="{{$edit_cate->category_name}}" name="category_name" class="form-control" id="exampleInputEmail1">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="category_desc" id="ckeditor">{{$edit_cate->category_desc}}</textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="meta_keywords" id="ckeditor1">{{$edit_cate->meta_keywords}}</textarea> 
						</div>  
						<button type="submit" name="update_category" class="btn btn-info">Cập nhật danh mục</button>
					</form>
					@endforeach
				</div>

			</div>
		</section>

	</div>
</div>
@endsection