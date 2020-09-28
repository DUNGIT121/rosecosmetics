@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
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
    <h2 class="title text-center">Sản Phẩm Bán Chạy</h2>
    @foreach($product_sold as $key=>$sold)
    
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 450px; width: 270px">

            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <input type="hidden" value="{{$sold->product_id}}" class="cart_product_id_{{$sold->product_id}}">
                        <input type="hidden" value="{{$sold->product_name}}" class="cart_product_name_{{$sold->product_id}}">
                        <input type="hidden" value="{{$sold->images}}" class="cart_product_image_{{$sold->product_id}}">
                        <input type="hidden" value="{{$sold->total - $sold->sold}}" class="cart_product_quantity_{{$sold->product_id}}">
                        <input type="hidden" value="{{$sold->output_price}}" class="cart_product_price_{{$sold->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$sold->product_id}}">
                        <a href="{{URL::to('/details-product/'.$sold->product_id)}}">
                            <img src="{{URL::to('public/uploads/product/'.$sold->images)}}" height="250" width="200" alt="" />
                            <h2>{{number_format($sold->output_price).' '.'VNĐ'}}</h2>
                            <p>{{$sold->product_name}}</p>

                        </a> 
                        <input name="qty" type="hidden" value="1" />
                        <input name="productid_hidden" type="hidden" value="{{$sold->product_id}}" />
                        <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$sold->product_id}}" name="add-to-cart">
                            Thêm giỏ hàng
                        </button>
                    </form>
                    
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>   

    @endforeach
</div><!--features_items-->

<div class="features_items"><!--features_items-->
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class= "text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <h2 class="title text-center">Sản Phẩm Nổi Bật</h2>
    @foreach($product_view as $key=>$view)
    
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 450px; width: 270px">

            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <input type="hidden" value="{{$view->product_id}}" class="cart_product_id_{{$view->product_id}}">
                        <input type="hidden" value="{{$view->product_name}}" class="cart_product_name_{{$view->product_id}}">
                        <input type="hidden" value="{{$view->images}}" class="cart_product_image_{{$view->product_id}}">
                        <input type="hidden" value="{{$view->total - $view->sold}}" class="cart_product_quantity_{{$view->product_id}}">
                        <input type="hidden" value="{{$view->output_price}}" class="cart_product_price_{{$view->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$view->product_id}}">
                        <a href="{{URL::to('/details-product/'.$view->product_id)}}">
                            <img src="{{URL::to('public/uploads/product/'.$view->images)}}" height="250" width="200" alt="" />
                            <h2>{{number_format($view->output_price).' '.'VNĐ'}}</h2>
                            <p>{{$view->product_name}}</p>

                        </a> 
                        <input name="qty" type="hidden" value="1" />
                        <input name="productid_hidden" type="hidden" value="{{$view->product_id}}" />
                        <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$view->product_id}}" name="add-to-cart">
                            Thêm giỏ hàng
                        </button>
                    </form>
                    
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>   

    @endforeach
</div><!--features_items-->

<div class="features_items"><!--features_items-->
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class= "text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <h2 class="title text-center">Sản Phẩm Mới</h2>
    @foreach($all_Product as $key=>$pro)
    
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 450px; width: 270px">

            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->images}}" class="cart_product_image_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->output_price}}" class="cart_product_price_{{$pro->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->total - $pro->sold}}" class="cart_product_quantity_{{$pro->product_id}}">
                        <a href="{{URL::to('/details-product/'.$pro->product_id)}}">
                            <img src="{{URL::to('public/uploads/product/'.$pro->images)}}" height="250" width="200" alt="" />
                            <h2>{{number_format($pro->output_price).' '.'VNĐ'}}</h2>
                            <p>{{$pro->product_name}}</p>

                        </a> 
                        <input name="qty" type="hidden" value="1" />
                        <input name="productid_hidden" type="hidden" value="{{$pro->product_id}}" />
                        <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">
                            Thêm giỏ hàng
                        </button>
                    </form>
                    
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>   
    
    @endforeach
</div><!--features_items-->
<span>
    {!! $all_Product->render() !!}
</span>
@endsection