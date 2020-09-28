@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class= "text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <h2 class="title text-center">{{$meta_title}}</h2>
    	
    		<div class="product-image-wrapper">
    			@foreach($post as $key=>$p)
            <div class="single-products" style="margin: 10px 0;" >
                <div class="text-center">
                       
                            <img style="float:left; width: 30%; height: 200px; padding: 5px" src="{{URL::to('public/uploads/posts/'.$p->post_image)}}" alt="{{$p->post_title}}" />
                            <h4 style="color: #000; padding: 5px">{{$p->post_title}}</h4>
                            <p>{!!$p->post_desc!!}</p>
                </div>
                <div class="text-right">
                	<a href="{{URL::to('/view-post/'.$p->post_id)}}" class="btn btn-default btn-sm">Xem bài viết</a> 
                </div>
                
            </div>
            <div class="clearfix"></div>
            @endforeach
        </div>
    	
</div><!--features_items-->
<span>
    {!! $post->render() !!}
</span>
@endsection