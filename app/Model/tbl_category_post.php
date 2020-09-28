<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_category_post extends Model
{
    
    protected $table = 'tbl_category_post';
	protected $fillable = [
		'cate_post_name','cate_post_status','cate_post_slug','cate_post_desc'
	];
	protected $primaryKey = 'cate_post_id';
	public $timestamps = false;

	public function post(){
		return $this->hashMany('App\Model\tbl_post');
	}
}
