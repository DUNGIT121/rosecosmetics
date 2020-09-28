@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục bài viết
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
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th class="text-center" style="background-color: #FF9900; color: black">
              STT
            </th>
            <th class="text-center" style="background-color: #FF9900; color: black">Tên danh mục Bài Viết</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Mô tả danh mục Bài Viết</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Trạng thái</th>
            <th style="width:50px;background-color: #FF9900"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          ?>
          @foreach($cate_post as $key => $cate_p)
          <tr>
            <td>{{$i++}}</td>

            <td>{{$cate_p->cate_post_name}}</td>
            <td><span class="text-ellipsis">{{$cate_p->cate_post_desc}}</span></td>
            <td><span class="text-ellipsis">
              <?php
              if($cate_p->cate_post_status == 0){
                ?>
                <a href="{{URL::to('/active-catepost/'.$cate_p->cate_post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
              }else{
                ?>
                <a href="{{URL::to('/unactive-catepost/'.$cate_p->cate_post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-catepost/'.$cate_p->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <!-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')" href="{{URL::to('/delete-brand/'.$cate_p->brand_id)}}" class="active styling-delete" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <span>{!!$cate_post->render()!!}</span>
        <footer class="panel-footer">
          
        </footer>
      </div>
    </div>
    @endsection