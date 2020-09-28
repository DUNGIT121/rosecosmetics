<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_category extends Model
{
    protected $table = 'tbl_category_product';
	protected $fillable = [
		'category_name','category_desc','status'
	];
	protected $primaryKey = 'category_id';
	public $timestamps = false;
}
