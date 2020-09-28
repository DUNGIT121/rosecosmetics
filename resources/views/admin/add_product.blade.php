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
					<form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="exampleInputEmail1">Tên sản Phẩm</label>
							<input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="vui lòng nhập tên sản phẩm" name="Product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Tên danh mục</label>
							<select type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
								@foreach($category as $key=>$cate)
								<option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
								@endforeach
							</select> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Tên Thương hiệu</label>
							<select type="text" name="Brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
								@foreach($brand as $key=>$brand)
								<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
								@endforeach
							</select> 
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Trạng thái</label>
							<select name="status" class="form-control input-sm m-bot15">
								<option value="1">Hiển thị</option>
								<option value="0">ẩn</option>
							</select>
						</div>    
						<div class="form-group">
							<label for="exampleInputEmail1">Giá Gốc</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng giá tiền" name="input_price" class="form-control input-sm m-bot15">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Giá Bán</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng giá tiền" name="output_price" class="form-control input-sm m-bot15">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Số lượng</label>
							<input type="number" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng số lượng" name="total" min="1" max="1000" class="form-control" id="exampleInputEmail1" placeholder="số lượng sản phẩm">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Dung tích/Khối lượng</label>
							<input type="text" data-validation="number" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng dung tích/khối lượng" name="weight" class="form-control" id="exampleInputEmail1" placeholder="dung tích">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hạn sửa dụng</label>
							<input type="date" data-validation="date" data-validation-length="min1" data-validation-error-msg="vui lòng điền đúng ngày" name="expire" class="form-control" id="exampleInputEmail1" placeholder="Hạn sửa dụng">
						</div>						
						<div class="form-group">
							<label for="exampleInputEmail1">Mô tả sản phẩm</label>
							<textarea type="resize: none" rows="5" class="form-control" name="description" id="ckeditor" placeholder="ghi chú"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Từ khóa danh mục</label>
							<textarea type="resize: none" rows="5" class="form-control" name="meta_keywords" placeholder="từ khóa danh mục"></textarea> 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
							<input type="file" name="image" class="form-control" id="exampleInputEmail1" accept="image/*">
						</div>
						<div class="col-md-0"></div>
						<div class="col-md-0">
							@for($i=1;$i<=5;$i++)
						<div class="form-group">
							<label>Ảnh Kèm {!!$i!!}</label>
							<input type="file" name="name_img[]" class="form-control" id="exampleInputEmail1" accept="image/*" />
						</div>
						@endfor
						</div>
						<button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
					</form>
				</div>
				
			</div>
		</section>

	</div>
</div>
@endsection