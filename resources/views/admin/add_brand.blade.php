@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm thương hiệu Sản Phẩm
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
					<form role="form" action="{{URL::to('/save-brand')}}" method="post">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên thương hiệu</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên thương hiệu" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả thương hiệu</label>
							<textarea type="resize: none" rows="5" class="form-control" name="brand_desc" id="ckeditor" placeholder="mô tả thương hiệu"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="meta_keywords" id="ckeditor1" placeholder="từ khóa danh mục"></textarea> 
						</div>
						<div class="form-group">
						<label for="exampleInputPassword1">Trạng thái</label>
						<select name="status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">ẩn</option>
                            </select>
                        </div>    
						<button type="submit" name="add_brand" class="btn btn-info">Thêm thương hiệu</button>
					</form>
				</div>

			</div>
		</section>

	</div>
</div>
@endsection