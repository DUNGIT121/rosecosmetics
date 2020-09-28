@extends('admin_layout')
@section('admin_contend')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    	Liệt kê danh mục sản phẩm
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
            <th class="text-center" style="background-color: #FF9900; color: black">Tên danh mục</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Mô tả danh mục</th>
            <th class="text-center" style="background-color: #FF9900; color: black">Trạng thái</th>
            <th style="width:50px;background-color: #FF9900"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          ?>
          @foreach($all_category as $key => $cate_desc)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$cate_desc->category_name}}</td>
            <td><span class="text-ellipsis">{{$cate_desc->category_desc}}</span></td>
            <td><span class="text-ellipsis">
            	<?php
            	if($cate_desc->status == 0){
               ?>
               <a href="{{URL::to('/active-category/'.$cate_desc->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
               <?php
             }else{
               ?>
               <a href="{{URL::to('/unactive-category/'.$cate_desc->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
               <?php
             }
             ?>
           </span></td>
           <td>
            <a href="{{URL::to('/edit-category/'.$cate_desc->category_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <!-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" href="{{URL::to('/delete-category/'.$cate_desc->category_id)}}" class="active styling-delete" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a> -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <span>{!!$all_category->render()!!}</span>
      <footer class="panel-footer">
        
      </footer>
    </div>
  </div>
  @endsection