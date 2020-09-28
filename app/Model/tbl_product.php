<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_product extends Model
{
     protected $table = 'tbl_product';
	protected $fillable = [
		'product_name','brand_id','category_id','status','input_price','output_price','images','sold','total','weight','expire','created_at','updated_at','description'
	];
	protected $primaryKey = 'product_id';
	public $timestamps = false;
}
