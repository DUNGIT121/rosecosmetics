<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_order extends Model
{
  protected $table = 'tbl_order';
	protected $fillable = [
		'user_id','email','customer_name','address','phone','status','description','delivery_date','payment_method','order_code','created_at'];
	protected $primaryKey = 'order_id';
	public $timestamps = false;
	
}
