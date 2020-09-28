<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_quanhuyen extends Model
{
    protected $table = 'tbl_quanhuyen';
	protected $fillable = [
		'name_quanhuyen','type','matp'
	];
	protected $primaryKey ='maqh';
	public $timestamps = false;
}
