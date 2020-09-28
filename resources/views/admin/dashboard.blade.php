@extends('admin_layout')
@section('admin_contend')
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 	<a href="{{URL::to('/manager-order-new')}}">
					 <h4>Đơn hàng mới</h4>
					<h3>{{$order_count_new}}</h3>
					</a>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
						<a href="{{URL::to('/all-user')}}">
					<h4>Người Dùng</h4>
						<h3>{{$user_count}}</h3>
						</a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<a href="{{URL::to('/all-product')}}">
						<h4>Sản Phẩm</h4>
						<h3>{{$product_count}}</h3>
						</a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<a href="{{URL::to('/manager-order')}}">
						<h4>Tổng Đơn Hàng</h4>
						<h3>{{$order_count}}</h3>
						</a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		
		<div class="agil-info-calendar">
		<!-- calendar -->
		
		<!-- //calendar -->
		
			<!-- tasks -->
			
		<!-- //tasks -->
		

@endsection