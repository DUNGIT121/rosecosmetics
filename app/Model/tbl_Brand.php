<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_Brand extends Model
{
    protected $table = 'tbl_brand';
	protected $fillable = [
		'brand_name','brand_desc','status'
	];
	protected $primaryKey = 'brand_id';
	public $timestamps = false;
}
