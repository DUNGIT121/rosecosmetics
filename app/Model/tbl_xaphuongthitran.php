<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_xaphuongthitran extends Model
{
    protected $table = 'tbl_xaphuongthitran';
	protected $fillable = [
		'name_xaphuong','type','maqh'
	];
	protected $primaryKey ='xaid';
	public $timestamps = false;
}
