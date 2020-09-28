@extends('admin_layout')
@section('admin_contend')
	<!-- tasks -->
			<div class="agile-last-grids">
				<?php
				$date= getdate();
				$month = $date['mon'];
				$year = $date['year'];
				?>
				<div class="stats-title">
					<h4 class="title">Doanh Thu Tháng {{$month}} Năm {{$year}}</h4>
				</div>
				

				<div class="col-md-12 agile-last-left agile-last-middle">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Doanh Thu Tháng {{$month}}</h3>
						</div>
						<div id="graph8"></div>
						<script>
						/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
						var day_data = [
						  {"period": "2020-8-01", "licensed": 3407, "sorned": 660},
						  {"period": "2020-07-30", "licensed": 3351, "sorned": 629},
						  {"period": "2020-07-29", "licensed": 3269, "sorned": 618},
						  {"period": "2020-07-20", "licensed": 3246, "sorned": 661},
						  {"period": "2020-07-19", "licensed": 3257, "sorned": 667},
						  {"period": "2020-07-18", "licensed": 3248, "sorned": 627},
						  {"period": "2020-07-17", "licensed": 3171, "sorned": 660},
						  {"period": "2020-07-16", "licensed": 3171, "sorned": 676},
						  {"period": "2020-07-15", "licensed": 3201, "sorned": 656},
						  {"period": "2020-07-10", "licensed": 3215, "sorned": 622},
						  {"period": "2020-8-01", "licensed": 3407, "sorned": 660},
						  {"period": "2020-07-30", "licensed": 3351, "sorned": 629},
						  {"period": "2020-07-29", "licensed": 3269, "sorned": 618},
						  {"period": "2020-07-20", "licensed": 3246, "sorned": 661},
						  {"period": "2020-07-19", "licensed": 3257, "sorned": 667},
						  {"period": "2020-07-18", "licensed": 3248, "sorned": 627},
						  {"period": "2020-07-17", "licensed": 3171, "sorned": 660},
						  {"period": "2020-07-16", "licensed": 3171, "sorned": 676},
						  {"period": "2020-07-15", "licensed": 3201, "sorned": 656},
						  {"period": "2020-07-10", "licensed": 3215, "sorned": 622},
						  {"period": "2020-8-01", "licensed": 3407, "sorned": 660},
						  {"period": "2020-07-30", "licensed": 3351, "sorned": 629},
						  {"period": "2020-07-29", "licensed": 3269, "sorned": 618},
						  {"period": "2020-07-20", "licensed": 3246, "sorned": 661},
						  {"period": "2020-07-19", "licensed": 3257, "sorned": 667},
						  {"period": "2020-07-18", "licensed": 3248, "sorned": 627},
						  {"period": "2020-07-17", "licensed": 3171, "sorned": 660},
						  {"period": "2020-07-16", "licensed": 3171, "sorned": 676},
						  {"period": "2020-07-15", "licensed": 3201, "sorned": 656},
						  {"period": "2020-07-10", "licensed": 3215, "sorned": 622}
						];
						Morris.Bar({
						  element: 'graph8',
						  data: day_data,
						  xkey: 'period',
						  ykeys: ['licensed', 'sorned'],
						  labels: ['Licensed', 'SORN'],
						  xLabelAngle: 60
						});
						</script>
					</div>
					</br>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		<!-- //tasks -->
@endsection