<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_coupon extends Model
{
    protected $table = 'tbl_coupon';
	protected $fillable = [
		'coupon_name','coupon_code','coupon_time','coupon_number','coupon_condition'];
	protected $primaryKey ='coupon_id';
	public $timestamps = false;
}
