<!DOCTYPE html>
<head>
	<title>Đăng ký tài khoản</title>
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
	<!-- //font-awesome icons -->
	<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
	<div class="log-w3">
		<div class="w3layouts-main">
			<h2>Đăng Ký</h2>
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
			<form action="{{URL::to('/check-register')}}" method="post">
				@csrf
				<input type="text" class="ggg" name="hoten" placeholder="Nhập họ và tên" required="">
				<input type="email" class="ggg" name="account" placeholder="nhập email" required="">
				<input type="password" class="ggg" name="password" placeholder="nhập mật khẩu" required="">
				<input type="text" class="ggg" name="address" placeholder="Nhập địa chỉ" required="">
				<input type="text" class="ggg" name="phone" placeholder="Số điện thoại" required="">
				<div class="clearfix"></div>
				<input type="submit" value="Đăng ký" name="register">
			</form>
			<p>Nếu đã có tài khoản đăng nhập tại đây<a href="{{URL::to('/login')}}"></br>Đăng Nhập</a></p>
			<!-- <p>-------------Hoặc--------------</p>
				<button><a href="{{URL::to('/login')}}">Đăng Nhập</a></button> -->
			</div>
		</div>
		<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
		<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
		<script src="{{asset('public/backend/js/scripts.js')}}"></script>
		<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
		<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
		<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
		<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
	</body>
	</html>
