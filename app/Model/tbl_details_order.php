<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_details_order extends Model
{
    protected $table = 'tbl_details_order';
	protected $fillable = [
		'order_code','product_id','order_id','product_name','product_price','product_sales_qty','order_coupon','order_feeship'];
	protected $primaryKey = 'details_id';
	public $timestamps = false;

	public function product(){
		return $this->belongsTo('App\Model\tbl_product','product_id','product_id');
	}
}
