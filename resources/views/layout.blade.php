<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------SEO-------->
    <meta name="description" content="{{$meta_desc}}"/>
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link rel="canonical" href="{{$meta_canonical}}"/>
    <link rel="icon" type="image/x-icon" href=""/>
    <!---------SEO-------->
    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->       
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <!-- <?php 
    // echo Session::get('user_id');
    // echo Session::get('order_id');
    ?> -->
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 039 536 5497</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> rose_cosmetics@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="https://www.facebook.com/rosecosmetics121/"><i class="fa fa-facebook"><b style="font-size: 15px">anpage ROSE cosmetics</b></i></a></li>
                                <?php
                                $role_id = Session::get('role_id');
                                if($role_id == 3){
                                    ?>
                                    <li><a href="{{URL::to('/dashboard')}}"><i class="fa fa-lock btn-primary"></i>Quản Lý Admin</a></li>
                                    <?php
                                }
                                ?>
                                <!-- <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{('public/frontend/images/logo4.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php
                                $user_id = Session::get('user_id');
                                if($user_id!=NULL){
                                    ?>
                                    <li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <!-- <img alt="" src="{{('public/backend/images/dung121.jpg')}}"> -->
                                            <span class="user_name">
                                                <?php
                                                $name = Session::get('user_name');
                                                if($name){
                                                    echo 'Xin Chào '.' '.$name;
                                                }
                                                ?>
                                            </span>
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu extended logout">
                                            
                                            <li><a href="#"><i class=" fa fa-user"></i>Thông tin cá nhân</a></li>
                                            <?php
                                            $user_id = Session::get('user_id');
                                            ?>
                                            <li><a href="{{URL::to('/order-follow/'.$user_id)}}"><i class="fa fa-shopping-cart"></i> Đơn hàng của bạn</a></li>
                                            
                                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
                                        </ul>
                                    </li>
                                    <?php 
                                }else{
                                    ?>
                                    <li><a href="{{URL::to('/login')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="#"><i class="fa fa-star"></i> yêu thích</a></li>
                                <?php
                                $user_id = Session::get('user_id');
                                if($user_id!=NULL){
                                    ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                    <?php 
                                }else{
                                    ?>
                                    <li><a href="{{URL::to('/login')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
        
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Danh mục sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key=>$cate)
                                        <li><a href="{{URL::to('/view-category/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Thương Hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($brand as $key=>$br)
                                        <li><a href="{{URL::to('/view-brand/'.$br->brand_id)}}">{{$br->brand_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($cate_post as $key=>$cp)
                                        <li><a href="{{URL::to('/view-cate-post/'.$cp->cate_post_id)}}">{{$cp->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                
                                <li class="dropdown"><a href="#">Liên Hệ<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="width: 322px">
                                        <li><a href="#">HotLine: 0395365497</a></li>
                                        <li><a href="#">Email: rosecosmetics121@gmail.com</a></li>
                                        <li><a href="https://www.facebook.com/rosecosmetics121/">FaceBook: ROSE Cosmetics</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('search')}}" autocomplete="off" method="POST">
                            @csrf
                            <div class="search_box">
                                <input type="text" style="width: 100%" name="search" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
                                <div id="search_ajax"></div>
                                <input type="submit" name="secrch_items" style="margin:0; color:#666" class="btn btn-primary btn-sm" value="tìm kiếm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <?php
                                $i = 0;
                            ?>
                            @foreach($slider as $key => $slide)
                            <?php
                                $i++;
                            ?>
                            <div class="item {{$i==1 ? 'active' : '' }}">
                                <!-- <div class="col-sm-6">
                                    <h1>ROSE Cosmetics</h1>
                                    <p>{{$slide->slide_name}}</p>
                                    <p>{{$slide->slide_description}}</p>
                                    
                                </div> -->
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slide_description}}" src="{{asset('public/uploads/slider/'.$slide->slide_image)}}" height="300" width="100%" class="img img-responsive">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Dang mục Sản Phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            @foreach($category as $key=>$cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/view-category/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="price-range">
                        </div>

                    </div>
                    <div class="left-sidebar">
                        <h2>Thương hiệu Sản Phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            @foreach($brand as $key=>$br)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/view-brand/'.$br->brand_id)}}">{{$br->brand_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="price-range">

                        </div>                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">

                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Về chúng tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li>Hotline:<a href="#">(+84) 395 365 497</a></li>
                                <li>Email: <a href="#">rosecosmetics121@gmail.com</a></li>
                                <li>Địa Chỉ: <a href="#">03 Chu Cẩm Phong - P.Hòa Hải - Q.Ngũ Hành Sơn - TP.Đà Nẵng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Hỗ Trợ Khách Hàng</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Chính Sách Hỗ Trợ</a></li>
                                <li><a href="#">Chính Sách Vận Chuyển</a></li>
                                <li><a href="#">Chính Sách Đổi Trã</a></li>
                                <li><a href="#">Hướng Dẫn Thanh Toán</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Theo Dõi Chúng Tôi</h2>
                            <div class="fb-page" data-href="https://www.facebook.com/rosecosmetics121/" data-tabs="message" data-width="" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/rosecosmetics121/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/rosecosmetics121/">ROSE Cosmetics</a></blockquote></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Gửi Thông Tin</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Địa chỉ email" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Nhận các tin tức mới nhất từ chúng tôi <br />Chúng tôi sẽ gửi bạn những thông tin mới nhất từ chúng tôi. cảm ơn bạn đã đăng ký!!</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="hotline-phone-ring-wrap">       
            <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle"></div>
            <div class="hotline-phone-ring-circle-fill"></div>
            <div class="hotline-phone-ring-img-circle"> <a href="tel:0395365497" class="pps-btn-img"> <img src="https://netweb.vn/img/hotline/icon.png" alt="so dien thoai" width="50"> </a></div>
        </div>      
        <div class="hotline-bar"> 
            <a href="tel:0898982526"> <span class="text-hotline">0395 365 497</span> </a>
        </div>           
        
        </div>



        <div class="float-icon-hotline">            
                <ul class ="left-icon hotline">
                    <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://chat.zalo.me/?phone=84395365497"><i class="fa fa-zalo animated infinite tada"></i><span>Zalo</span></a></li>
                    <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://www.messenger.com/t/rosecosmetics121"><i class="fa fa-messenger animated infinite tada"></i><span>Facebook</span></a></li>
                </ul> 
                      
        </div>

<style type="text/css">
    .hotline-phone-ring-circle{width:85px;height:85px;top:10px;left:10px;position:absolute;background-color:transparent;border-radius:100%;border:2px solid #e60808;-webkit-animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;transition:all .5s;-webkit-transform-origin:50% 50%;-ms-transform-origin:50% 50%;transform-origin:50% 50%;opacity:.5}
.hotline-phone-ring-circle-fill{width:55px;height:55px;top:22px;left:26px;position:absolute;background-color:rgba(230,8,8,.7);border-radius:100%;border:2px solid transparent;-webkit-animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;transition:all .5s;-webkit-transform-origin:50% 50%;-ms-transform-origin:50% 50%;transform-origin:50% 50%}
.hotline-phone-ring-img-circle{background-color:#e4212a;width:33px;height:33px;top:33px;left:37px;position:absolute;background-size:20px;border-radius:100%;border:2px solid transparent;-webkit-animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;-webkit-transform-origin:50% 50%;-ms-transform-origin:50% 50%;transform-origin:50% 50%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;align-items:center;justify-content:center}
.hotline-phone-ring-img-circle .pps-btn-img{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}
.hotline-phone-ring-img-circle .pps-btn-img img{width:20px;height:20px}

.hotline-bar{position:absolute;background:#e88a25;background:-webkit-linear-gradient(left,#e88a25,#d40000);background:-o-linear-gradient(right,#e88a25,#d40000);background:-moz-linear-gradient(right,#e88a25,#d40000);background:linear-gradient(to right,#e88a25,#e4212a);height:40px;width:200px;line-height:40px;border-radius:3px;padding:0 10px;background-size:100%;cursor:pointer;transition:all .8s;-webkit-transition:all .8s;z-index:9;box-shadow:0 14px 28px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.1);border-radius:50px !important;border:2px solid #fff;left:33px;bottom:37px}.hotline-bar>a{color:#fff;text-decoration:none;font-size:15px;font-weight:900;text-indent:50px;display:block;letter-spacing:1px;line-height:38px;font-family:Arial}.hotline-bar>a:hover,.hotline-bar>a:active{color:#fff}@-webkit-keyframes phonering-alo-circle-anim{0%{-webkit-transform:rotate(0) scale(.5) skew(1deg);-webkit-opacity:.1}30%{-webkit-transform:rotate(0) scale(.7) skew(1deg);-webkit-opacity:.5}100%{-webkit-transform:rotate(0) scale(1) skew(1deg);-webkit-opacity:.1}}@-webkit-keyframes phonering-alo-circle-fill-anim{0%{-webkit-transform:rotate(0) scale(.7) skew(1deg);opacity:.6}50%{-webkit-transform:rotate(0) scale(1) skew(1deg);opacity:.6}100%{-webkit-transform:rotate(0) scale(.7) skew(1deg);opacity:.6}}@-webkit-keyframes phonering-alo-circle-img-anim{0%{-webkit-transform:rotate(0) scale(1) skew(1deg)}10%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg)}20%{-webkit-transform:rotate(25deg) scale(1) skew(1deg)}30%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg)}40%{-webkit-transform:rotate(25deg) scale(1) skew(1deg)}50%{-webkit-transform:rotate(0) scale(1) skew(1deg)}100%{-webkit-transform:rotate(0) scale(1) skew(1deg)}}@media (max-width:768px){.hotline-bar{display:none}}

.hotline-phone-ring-img-circle .pps-btn-img img {
    width: 20px;
    height: 20px;
}
img {
    border: none;
}


.hotline-phone-ring-wrap {
    position: fixed !important;
    bottom: 0;
    left: 0;
    z-index: 1111111;
}

.hotline-phone-ring {
    position: relative;
    visibility: visible;
    background-color: transparent;
    width: 110px;
    height: 110px;
    cursor: pointer;
    z-index: 11;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    transition: visibility .5s;
    left: 0;
    bottom: 0;
    display: block;
}


.float-icon-hotline {
    display: block;
    width: 40px;
    position: fixed;
    bottom: 85px;
    left: 33px;
    z-index: 999999;
}
    

.float-icon-hotline ul {
    display: block;
    width: 100%;
    padding-left: 0;
    margin-bottom: 0;
}
.float-icon-hotline ul li {
    display: block;
    width: 100%;
    position: relative;
    margin-bottom: 10px;
    cursor: pointer;
}
.float-icon-hotline ul li a#messengerButton {
    padding: 0px !important;
    background: transparent !important;
    border: 0px !important;
}
@media only screen and (min-width: 960px)
{
    .float-icon-hotline ul li .fa {
        background-size: contain !important;
    }
}
.float-icon-hotline ul li .fa-phone {
    background-color: #ed1c24;
}
.float-icon-hotline ul li .fa {
    background-color: #ed1c24;
    display: block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 36px;
    -moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
    color: #fff;
    font-weight: 700;
    border-radius: 50%;
    position: relative;
    z-index: 2;
    border: 2px solid #fff;
}
.animated.infinite {
    animation-iteration-count: infinite;
}
.animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}
.tada {
    animation-name: tada;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.float-icon-hotline ul li span {
    display: inline-block;
    padding: 0;
    background-color: #ff6a00;
    color: #fff;
    border: 2px solid #fff;
    border-radius: 20px;
    height: 40px;
    line-height: 36px;
    position: absolute;
    top: 0;
    left: 15px;
    z-index: 0;
    width: 0;
    overflow: hidden;
    -webkit-transition: all 1s;
    transition: all 1s;
    background-color: #ff6a00;
    -moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
    font-weight: 400;
    white-space: nowrap;
    opacity: 0;
}

ul.left-icon.hotline {
    margin-left: 0px !important;
}


.float-icon-hotline ul li .fa-zalo {
    background: url(https://netweb.vn/img/hotline/zalo.png) center center no-repeat;
}
.float-icon-hotline ul li .fa-zalo:hover {
    background: #ef0303 url(https://netweb.vn/img/hotline/zalo.png) center center no-repeat;opacity:.5;
}
.float-icon-hotline ul li .fa-messenger {
    background:  url(https://netweb.vn/img/hotline/fb.png) center center no-repeat;
}
.float-icon-hotline ul li .fa-messenger:hover {
    background: #168efb url(https://netweb.vn/img/hotline/fb.png) center center no-repeat;opacity:.5;
}
</style>
    </footer><!--/Footer-->
    

    
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/cloud-zoom.1.0.2.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0" nonce="5iQmYB9N"></script>
    <script src="{{asset('public/frontend/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
    $.validate({
    });
</script>
<script type="text/javascript">
    $('#keywords').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/autocomplete-ajax')}}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        }else{
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click', '.li_search_ajax', function(){
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
            var id= $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                alert('Vui lòng đặt ít hơn' +' '+ cart_product_quantity +' '+ 'sản phẩm');
            }else{
                $.ajax({
                    url:'{{url('/add-cart-ajax')}}',
                    method:'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                    success:function(data){
                           swal({
                                title: "Thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể tiếp tục hoặc kiểm tra giỏ hàng",
                                showCancelButton: true,
                                cancelButtonText: "Xem Tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Giỏ Hàng",
                                closeOnConfirm: false
                                },
                                function() {
                                window.location.href = "{{url('/gio-hang')}}";
                                });
                        }
                });
            }
        });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                    swal({
                      title: "Xác nhận đơn hàng",
                      text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có chắc chắn đặt hàng?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Đặt Hàng",
                      cancelButtonText: "Hủy",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var email = $('.email').val();
                            var customer_name = $('.customer_name').val();
                            var delivery_address = $('.delivery_address').val();
                            var phone = $('.phone').val();
                            var description = $('.description').val();
                            var payment_method = $('.payment_method').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url:'{{url('/confirm-order')}}',
                                method:'POST',
                                data:{email:email,customer_name:customer_name,delivery_address:delivery_address,phone:phone,description:description,payment_method:payment_method,order_fee:order_fee,order_coupon:order_coupon,_token:_token},
                                success:function(data){
                                    swal("Đặt Hàng Thành Công", "Vui lòng truy cập gmail để theo dõi đơn hàng!", "success");
                                }
                            }); 
                            window.setTimeout(function(){
                                location.reload();
                            }, 1000);
                            
                          } else {
                            swal("Chưa đặt hàng", "Vui lòng hoàn tất đơn hàng", "error");
                          }
                      
                    });
                
            });
        });


    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url:'{{url('/select-delivery-home')}}',
                    method:'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });
        });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh == '' && xaid == ''){
                    alert('Vui lòng chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                        url : '{{url('/calculate-fee')}}',
                        method:'POST',
                        data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                        success:function(){
                            location.reload();
                        }
                    });
                }
                
            });
        });
    </script>
</body>
</html>