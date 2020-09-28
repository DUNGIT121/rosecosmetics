@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
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
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>

      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
      <button class="btn btn-sm btn-default" type="button" style="background-color:#00FF00; font-size: 15px; margin-left:1035px"><a href="{{URL::to('/add-product')}}"> + Sản phẩm mới</a></button>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900; color: black">STT</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Tên sản phẩm</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Danh mục</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Thương hiệu</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Giá</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Hình ảnh</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Số lượng</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Đã bán</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Hạn sử dụng</th>

            <th class="text-center" style="background-color: #FF9900; color: black">Trạng thái</th>

            <th style="width:50px; background-color: #FF9900"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1
          ?>
          @foreach($all_product as $key => $cate_pro)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$cate_pro->product_name}}</td>
            <td><span class="text-ellipsis">{{$cate_pro->category_name}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->brand_name}}</span></td>
            <td><span class="text-ellipsis">{{number_format($cate_pro->output_price).' '.'đ'}}</span></td>
            <td><img src="public/uploads/product/{{$cate_pro->images}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">{{$cate_pro->total}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->sold}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->expire}}</span></td>
            <td><span class="text-ellipsis">
              <?php
              if($cate_pro->status == 0){
                ?>
                <a href="{{URL::to('/active-product/'.$cate_pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
              }else{
                ?>
                <a href="{{URL::to('/unactive-product/'.$cate_pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$cate_pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <!-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="{{URL::to('/delete-product/'.$cate_pro->product_id)}}" class="active styling-delete" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <span>{!!$all_product->render()!!}</span>
        <footer class="panel-footer">
         
        </footer>
      </div>
    </div>
    @endsection