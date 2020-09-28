@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Cập nhật danh mục bài viết
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
					<form role="form" action="{{URL::to('/update-cate-post/'.$cate_post->cate_post_id)}}" method="post">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên danh mục bài viết</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập bài viết" name="cate_post_name" value="{{$cate_post->cate_post_name}}" class="form-control" onkeyup="ChangeToSlug();" id="exampleInputEmail1" placeholder="Tên bài viết">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả danh mục bài viết</label>
							<textarea type="resize: none" rows="5" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập nội dung mô tả" class="form-control" name="cate_post_desc" id="ckeditor">{{$cate_post->cate_post_desc}}</textarea> 
						</div>
						<!-- <div class="form-group">
						<label for="exampleInputPassword1">Trạng thái</label>
						<select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">ẩn</option>
                            </select>
                        </div>    --> 
						<button type="submit" name="add_cate_post" class="btn btn-info">Cập nhật danh mục bài viết</button>
					</form>
				</div>

			</div>
		</section>

	</div>
</div>
@endsection