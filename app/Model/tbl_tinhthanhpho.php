<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_tinhthanhpho extends Model
{
    protected $table = 'tbl_tinhthanhpho';
	protected $fillable = [
		'name_city','type'
	];
	protected $primaryKey ='matp';
	public $timestamps = false;
}
