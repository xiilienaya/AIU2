<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
       $data=  $_GET;
       var_dump($data);
    }


    /**
     * 图片路径
     * @param Request $request
     * @return false|mixed|string
     */
    public function imgUrl(Request $request){
        $data = $request->post();

        $file = !empty($data['file']) ? $data['file'] : '';          //用户
        $status = !empty($data['status']) ? $data['status'] : '';          //用户
        $file = $request->file('file');
//        $status = $request->post('status');
//        status:1.headImg  2.imgList 3.userImg

        if ($status == '1'){
            $name = 'headImg/';
        }else if($status == '2'){
            $name = 'imgList/';
        }else if($status == '3'){
            $name = 'userImg/';
        }else{
            return $this->getBack('0','状态错误','');
        }

        $time = date('Y-m-d');
        $url_path = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$name.$time;
        $rule = ['jpg', 'png', 'gif'];
        if ($file->isValid()) {
            if (!is_dir($url_path)) {
                mkdir($url_path, 0777, true);
            }
            $clientName = $file->getClientOriginalName();
            $file_size = $_FILES["file"]["size"];
            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, $rule)) {
                return $this->getback('0', '图片格式jpg，png，gif', '');
            } elseif ($file_size > 5242580) { // 文件太大了
                return $this->getback('0', '上传文件不能大于5MB', '');
            }
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $extension;

            $namePath = $url_path . '/' . $newName;

            $path = $file -> move( $url_path , $newName );
            if ($path){

                $src = [
                    'src' => $namePath,
                    'img' => 'http://www.aiu.com'.'/upload/'.$name.$time .'/'. $newName,
                ];

                return $this->getback('1', '上传成功', $src);
            }
            return $this->getback('0','参数错误，上传失败！','');
        }

        return $this->getback('0','参数错误，上传失败！','');
    }
}
