<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Model\tbl_product;
use App\Model\tbl_category;
use App\Model\tbl_Brand;

session_start();

class MailController extends Controller
{
    public function send_mail(){
    	$to_name = "ROSE Cosmetics";
    	
    }

}
