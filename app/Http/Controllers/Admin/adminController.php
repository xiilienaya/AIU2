<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    /**
     * 跳转
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function admin(){
        return view('admin.admin.index');
    }

    /**
     * 图片文件上传
     */
    public function uploadImg(){
        $file = request() -> file('file');
        $url_path = '';
        $rule = [ 'jpg' , 'png' , 'gif' ];
        if( $file -> isValid() ){
            $clientName = $file -> getClientOriginalName();
            $tmpName = $file -> getFilename();
            $realPath = $file -> getRealPath();
            $entension = $file -> getClientOriginalExtension();
            if( !in_array( $entension , $rule ) ){
                echo '图片格式jpg，png，gif';exit;
            }
            $newName = md5( date( "Y-m-d H:i:s" ) . $clientName ) . "." . $entension;
            $path = $file -> move( $url_path , $newName );
            $namePath = $url_path . '/' . $newName;
            $res = [ "code" => 1 , "font" => "上传成功" , 'src' => $namePath ];
            return json_encode( $res );
        }
    }


}
