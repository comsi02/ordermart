<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Common extends Controller
{
    public function __construct()
    {  
        $this->middleware('auth');
    }

    public function s3_file_upload()
    {  
        $org_file_name = $_FILES["myfile"]["name"];
        $tmp_file_name = $_FILES["myfile"]["tmp_name"];

        $afinfo = explode('.',$org_file_name);
        $s3_file_name = date('Ymd_His_').str_random(10).'.'.end($afinfo);

        if ($_FILES["myfile"]['error'] == 0) {
            rename($tmp_file_name, env('UPLOAD_PATH').$s3_file_name);
            \Common::make_product_img($s3_file_name,720);
            $res = \Common::s3_upload($s3_file_name,'product/');
            return $res;
        } else {
            return array ('success' => false, 'message' => '', 'filename' => '');
        }
    }
}
