<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_product_image extends Model
{
    protected $table = 'tbl_product_image';
	protected $fillable = [
		'images','product_id'
	];
	protected $primaryKey = 'id';
	public $timestamps = false;
}
