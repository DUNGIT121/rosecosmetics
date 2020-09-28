<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_post extends Model
{
    protected $table = 'tbl_posts';
	protected $fillable = [
		'cate_post_id','post_title','post_desc','post_content','post_meta_keyword','post_status','post_image'
	];
	protected $primaryKey = 'post_id';
	public $timestamps = false;

	public function cate_post(){
		return $this->belongsTo('App\Model\tbl_category_post','cate_post_id');
	}
}
