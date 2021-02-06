<?php

namespace App\Http\Controllers\Index;

use App\Model\LikeModel;
use App\Model\userModel;
use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    /**
     * 点赞
     * @param Request $request
     * @return false|mixed|string
     */
    public function like(Request $request){
        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户id
        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //游记id
        $status = !empty($data['status']) ? $data['status'] : '';          //状态

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }elseif (empty($yj_id)) {
            return $this->getBack('0', '无此游记', '');
        }elseif (empty($status)) {
            return $this->getBack('0', '状态不正确', '');
        }

        $where = ['user_id'=>$user_id,'yj_id'=>$yj_id];
        if ($status=='1'){

            $collect = LikeModel::where($where)->first();
            if($collect){
                return $this->getBack('1','已点赞','');
            }

            $collect = LikeModel::insertGetId($where);
            if($collect){
                return $this->getBack('1','已点赞','');
            }else{
                return $this->getBack('0','点赞失败','');
            }
        }elseif ($status == '2'){
            $collect = LikeModel::where($where)->delete();
            if($collect){
                return $this->getBack('1','取消成功','');
            }else{
                return $this->getBack('0','取消失败','');
            }
        }else{
            return $this->getBack('0', '状态不正确', '');
        }
    }
}
