@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($search_product as $key=>$pro)
    <a href="{{URL::to('/details-product/'.$pro->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 450px; width: 270px">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/uploads/product/'.$pro->images)}}" height="250" width="200" alt="" />
                    <h2>{{number_format($pro->output_price).' '.'VNĐ'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
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
    </a>                    
@endforeach

</div><!--features_items-->
<span>
    {!! $search_product->render() !!}
</span>
@endsection