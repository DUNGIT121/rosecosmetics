@extends('admin_layout')
@section('admin_contend')
<div class="row">
	<div class="col-lg-12">

		<section class="panel">

			<header class="panel-heading">
				Thêm Sản Phẩm
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
					@foreach($edit_product as $key => $pro)
					<form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Tên sản Phẩm</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng điền tên sản phẩm" name="Product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Tên danh mục</label>
							<select type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
								@foreach($category as $key=>$cate)
								@if($cate->category_id==$pro->category_id)
								<option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
								@else
								<option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
								@endif
								@endforeach
							</select> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Tên Thương hiệu</label>
							<select type="text" name="Brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
								@foreach($brand as $key=>$brand)
								@if($brand->brand_id==$pro->brand_id)
								<option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
								@else
								<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
								@endif
								@endforeach
							</select> 
						</div>  
						<div class="form-group">
							<label for="exampleInputEmail1">Giá gốc</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng giá tiền" value="{{$pro->input_price}}" name="input_price" class="form-control input-sm m-bot15">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Giá Bán</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng giá tiền" value="{{$pro->output_price}}" name="output_price" class="form-control input-sm m-bot15">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Số lượng</label>
							<input type="number" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng số lượng sản phẩm" name="total" min="1" max="1000" class="form-control" id="exampleInputEmail1" value="{{$pro->total}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Dung tích/Khối lượng</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng dung tích/khối lượng" name="weight" class="form-control" id="exampleInputEmail1" value="{{$pro->weight}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hạn sửa dụng</label>
							<input type="date" data-validation="date" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng ngày" name="expire" class="form-control" id="exampleInputEmail1" value="{{$pro->expire}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả sản phẩm</label>
							<textarea type="resize: none" rows="5" class="form-control" name="description" id="ckeditor">{{$pro->description}}</textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="meta_keywords">{!!$pro->meta_keywords!!}</textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
							<input type="file" name="image" multiple="true" class="form-control" id="exampleInputEmail1" accept="image/*">
							<img src="{{URL::to('public/uploads/product/'.$pro->images)}}" height="100" width="100">
						</div>
						
						<button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
					</form>
					@endforeach
				</div>

			</div>
		</section>

	</div>
</div>
@endsection