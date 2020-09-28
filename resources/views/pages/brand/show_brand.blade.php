@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <div class="fb-share-button" data-href="http://localhost:81/rosecosmetics/application/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$meta_canonical}}"src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <div class="fb-like" data-href="{{$meta_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background: none;">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
      </ol>
    </nav>
    @foreach($brand_name as $key=>$name_br)
    <h2 class="title text-center">{{$name_br->brand_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key=>$pro)
    
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
<span>{!!$brand_by_id->render()!!}</span>
@endsection