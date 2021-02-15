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

        if ($status == '1'){
            $name = 'headImg/';
        }else if($status == '2'){
            $name = 'imgList/';

            //列表数组

        }else if($status == '3'){
            $name = 'userImg/';
        }else{
            return $this->getBack('0','状态错误','');
        }

        $up_dir = base_path()."/public/upload/";
        if (!is_dir($up_dir)) {
            mkdir($up_dir, 0777, true);
        }
        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $result)){
            $type = $result[2];
            if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
                $new = date('YmdHis').'.'.$type;
                $new_file = $up_dir.$new;
                if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $file)))){
                    $img_path = str_replace('', '', $new_file);
                    $src = [
                        'src' => $img_path,
                        'img' => 'http://www.aiu.com'.'/upload/'.$new,
                    ];

                    return $this->getback('1', '上传成功', $src);
                }else{
                    return $this->getback('0','参数错误，上传失败！','');
                }
            }else{
                return $this->getback('0', '图片格式pjpeg,jpeg,jpg,gif,bmp,png', '');
            }

        }else{
            return $this->getback('0','参数错误，上传失败！','');
        }
    }
}
