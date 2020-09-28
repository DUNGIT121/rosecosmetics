<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class tbl_feeship extends Model
{
    protected $table = 'tbl_feeship';
	protected $fillable = [
		'fee_matp','fee_maqh','fee_xaid','fee_feeship'
	];
	protected $primaryKey ='fee_id';
	public $timestamps = false;

	public function tbl_tinhthanhpho(){
		return $this->belongsTo('App\Model\tbl_tinhthanhpho', 'fee_matp','matp');
	}
	public function tbl_quanhuyen(){
		return $this->belongsTo('App\Model\tbl_quanhuyen', 'fee_maqh','maqh');
	}
	public function tbl_xaphuongthitran(){
		return $this->belongsTo('App\Model\tbl_xaphuongthitran', 'fee_xaid','xaid');
	}
}
