<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class summernoteUploadImg extends Controller
{
    public function ajax_upload_img(Request $request)
{
    // A list of permitted file extensions
    $allowed = array('png', 'jpg', 'gif','zip');
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if(!in_array(strtolower($extension), $allowed)){
            echo '{"status":"error"}';
            exit;
        }
        $name = strval(time().md5(rand(100, 200)));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/img')) {
            mkdir('upload/img');
        }
        $destination = public_path().'/upload/img/'. $filename; //change this directory
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo "/upload/img/".$filename;//change this URL
    }
    exit;
}

}
