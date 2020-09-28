<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_slide extends Model
{
    protected $table = 'tbl_slide';
	protected $fillable = [
		'slide_name','slide_image','slide_status','slide_description'
	];
	protected $primaryKey = 'slide_id';
	public $timestamps = false;
}
