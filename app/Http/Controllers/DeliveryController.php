<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Model\tbl_tinhthanhpho;
use App\Model\tbl_quanhuyen;
use App\Model\tbl_xaphuongthitran;
use App\Model\tbl_feeship;

session_start();

class DeliveryController extends Controller
{
	public function AuthLogin(){
        $user_id = session::get('user_id');
        $role = session::get('role_id');
        if($user_id && $role == 3){
            return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('trang-chu')->send(); 
        }
    }
	public function update_delivery(Request $request){
		$this->AuthLogin();
		$data = $request->all();
		$feeship = tbl_feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$feeship->fee_feeship = $fee_value;
		$feeship->save();
	}
	public function all_feeship(){
		$this->AuthLogin();
		// $fee_ship = tbl_feeship::orderby('fee_id','DESC')->get();
		$fee_ship = tbl_feeship::all();
		$output = '';
		$output .='<div class="table-responsive">
			<table class="table table-bordered">
			<thread>
				<tr>
					<th>Tên tỉnh thành phố</th>
					<th>Tên quận huyện</th>
					<th>Tên Xã Phường</th>
					<th>Phí ship</th>
				</tr>
			</thread>
			<tbody>
			';
			foreach($fee_ship as $key => $fee){
			$output.='
			<tr>
				<td>'.$fee->tbl_tinhthanhpho->name_city.'</td>
				<td>'.$fee->tbl_quanhuyen->name_quanhuyen.'</td>
				<td>'.$fee->tbl_xaphuongthitran->name_xaphuong.'</td>
				<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
			</tr>
			';
			}
			$output.='
			</tbody>
			</table></div>
		';
		echo $output;
	}
	public function add_delivery(Request $request){
		$this->AuthLogin();
		$data = $request->all();
		$feeship = new tbl_feeship();
		$feeship->fee_matp = $data['city'];
		$feeship->fee_maqh = $data['province'];
		$feeship->fee_xaid = $data['wards'];
		$feeship->fee_feeship = $data['fee_ship'];
		$feeship->save();
	}
	public function manager_delivery(Request $request){
    	$city = tbl_tinhthanhpho::orderby('matp','ASC')->get();
    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }
	public function select_delivery(Request $request){
		$data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action']=="city"){
				$select_province = tbl_quanhuyen::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
				$output.='<option>-----chọn Quận/Huyện----</option>';
				foreach($select_province as $key => $province){
				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = tbl_xaphuongthitran::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
				$output.='<option>-----chọn Xã/Phường/Thị Trấn----</option>';
				foreach($select_wards as $key => $ward){
				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
				}
			}
		}
		echo $output;
	}
    
}
