<!DOCTYPE html>
<head>
<title>Quản Lý Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        ROSE
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{('public/backend/images/dung121.jpg')}}">
                <span class="user_name">
                    <?php
                    $name = Session::get('user_name');
                    if($name){
                        echo $name;
                    }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin cá nhân</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/trang-chu')}}">
                        <i class="fa fa-home"></i>
                        <span>Trang Chủ</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Bảng điểu khiển</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-alt"></i>
                        <span>Quản lý slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                        <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manager-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-coupon')}}">thêm mã giảm giá</a></li>
                        <li><a href="{{URL::to('/all-coupon')}}">liệt kê mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-truck"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lý phí vận chuyển</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category')}}">Thêm danh mục sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-category')}}">Liệt Kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục Bài Viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-cate-post')}}">Thêm danh mục bài viết</a></li>
                        <li><a href="{{URL::to('/all-cate-post')}}">Liệt Kê danh mục bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương Hiệu Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand')}}">Thêm thương hiệu sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-brand')}}">Liệt Kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-product')}}">Liệt Kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài Viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
                        <li><a href="{{URL::to('/all-post')}}">Liệt Kê bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-group"></i>
                        <span>Quản Lý User</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-user')}}">Thêm User</a></li>
                        <li><a href="{{URL::to('/all-user')}}">Liệt Kê User</a></li>
                    </ul>
                </li>
                <li class=""><a href="{{URL::to('/revenue')}}"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Thống Kê Doanh Thu</span></a></li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    @yield('admin_contend')
</section>
 <!-- footer -->
          <div class="footer">
            <div class="wthree-copyright">
              <p>ROSE Cosmetics <a href="https://www.facebook.com/rosecosmetics121/">fan page</a></p>
            </div>
          </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>

<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_producd_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_producd_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_producd_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url:'{{url('/update-qty')}}',
                method:'POST',
                data:{order_producd_id:order_producd_id, order_qty:order_qty, _token:_token, order_code:order_code},
                success:function(data){
                     alert('cập nhật số lượng Đơn hàng thành công');
                     location.reload();
                }
            });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        //lấy ra số lượng
        quantity = [];
        $("input[name='product_sales_qty']").each(function(){
            quantity.push($(this).val());
        });
        //lấy ra product_id
        order_producd_id=[];
        $("input[name='order_product_id']").each(function(){
            order_producd_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_producd_id.length;i++){
            //số lượng khách đặt
            var order_qty = $('.order_qty_' + order_producd_id[i]).val();
            //số lượng tồn kho
            var order_qty_storage = $('.order_qty_storage_'+order_producd_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j+1;
                if(j==1){
                    alert('số lượng bán trong kho không đủ');
                }
                
                $('.color_qty_'+order_producd_id[i]).css('background','#FF9900');
            }
            // alert(order_qty);
            // alert(order_qty_storage);
        }
        if(j==0){
            $.ajax({
                    url:'{{url('/order-update-qty')}}',
                    method:'POST',
                    data:{status:status, order_id:order_id, _token:_token, quantity:quantity, order_producd_id:order_producd_id},
                    success:function(data){
                         alert('cập nhật Đơn hàng thành công');
                         location.reload();
                    }
                });
        }

        
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                 // headers: {
                 //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 //    },
                url:"{{url('/all-feeship')}}",
                method:'POST',
                data:{_token:_token},
                // dataType: "html",

                success:function(data){
                    // console.log(data)
                    $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            // alert(_token);
            $.ajax({
                url:'{{url('/update-delivery')}}',
                method:'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                // dataType: "html",
                success:function(data){
                    // console.log(data);
                     fetch_delivery();
                }
            });
        });
        $('.add_delivery').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/add-delivery')}}',
                method:'POST',
                data:{city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function(data){

                     fetch_delivery();
                }
            });

        });
        
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
                url:'{{url('/select-delivery')}}',
                method:'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    })

</script>
<script type="text/javascript">
    $.validate({

    });
</script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
 <script>
    //
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->  
<script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
       jQuery('.small-graph-box').hover(function() {
          jQuery(this).find('.box-button').fadeIn('fast');
       }, function() {
          jQuery(this).find('.box-button').fadeOut('fast');
       });
       jQuery('.small-graph-box .box-close').click(function() {
          jQuery(this).closest('.small-graph-box').fadeOut(200);
          return false;
       });
       
        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
        
        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
            data: [
                {period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
                {period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
                {period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
                {period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
                {period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
                {period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
                {period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
                {period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
                {period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
            
            ],
            lineColors:['#eb6f6f','#926383','#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
        
       
    });
    </script>
<!-- calendar -->
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>

    <script type="text/javascript">
        $(window).load( function() {

            $('#mycalendar').monthly({
                mode: 'event',
                
            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

        switch(window.location.protocol) {
        case 'http:':
        case 'https:':
        // running on a server, should be good.
        break;
        case 'file:':
        alert('Just a heads-up, events will not work when run locally.');
        }

        });
    </script>

    <!-- //calendar -->
</body>
</html>
