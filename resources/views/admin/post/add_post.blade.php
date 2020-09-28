@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm bài viết
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
					<form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên bài viết</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên bài viết" name="post_title" class="form-control" id="exampleInputEmail1" placeholder="Tên bài viết">
						</div>
						<div class="form-group">
						<label for="exampleInputPassword1">Danh mục bài viết</label>
						<select name="cate_post_id" class="form-control input-sm m-bot15">
							@foreach($cate_post as $key=>$cate)
                                <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                            @endforeach()
                            </select>
                        </div> 
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả bài viết</label>
							<textarea type="resize: none" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập mô tả bài viết" rows="5" class="form-control" name="post_desc" id="ckeditor" placeholder="mô tả bài viết"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Nội dung bài viết</label>
							<textarea type="resize: none" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập nội dung bài viết" rows="5" class="form-control" name="post_content" id="ckeditor1" placeholder="nội dung bài viết"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa bài viết</label>
							<textarea type="resize: none" rows="5" class="form-control" name="post_meta_keyword"  placeholder="từ khóa bài viết"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hình ảnh bài viết</label>
							<input type="file" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng thêm hình ảnh cho bài viết" name="post_image" class="form-control" id="exampleInputEmail2" accept="image/*">
						</div>
						<div class="form-group">
						<label for="exampleInputPassword1">Trạng thái</label>
						<select name="post_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">ẩn</option>
                            </select>
                        </div>    
						<button type="submit" name="add_post" class="btn btn-info">Thêm bài viết</button>
					</form>
				</div>

			</div>
		</section>

	</div>
</div>
@endsection