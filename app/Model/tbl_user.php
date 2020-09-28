<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tbl_user extends Model
{
     protected $table = 'tbl_user';
	protected $fillable = [
		'user_name','phone','email','address','status','role_id','avatar','password'];
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}
