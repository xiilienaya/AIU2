<?php

namespace App\Http\Controllers\Index;

use App\Model\CollectModel;
use App\Model\userModel;
use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function userCollect(Request $request){
//        userModel::where

        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '2';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $collect = CollectModel::where(['user_id'=>$user_id])->get();
        $collect = empty($collect) ? array():$collect->toArray();
        foreach ($collect as $k=>$val){
            $youJi = YouJiModel::where(['yj_id'=>$val['yj_id']])->select('yj_title','yj_headImg','yj_id','user_id')->first();
            $youJi = empty($youJi) ? array():$youJi->toArray();
            $collect[$k]['collect'] =$youJi;
            $user = userModel::where(['user_id'=>$youJi['user_id']])->select('user_img')->first();
            $user = empty($user) ? array():$user->toArray();
            $collect[$k]['collect']['user_img'] = $user;
        }
        if($collect){
            return $this->getBack('1','OK',$collect);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function collect(Request $request){
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

            $collect = CollectModel::where($where)->first();
            if($collect){
                return $this->getBack('1','已收藏','');
            }

            $collect = CollectModel::insertGetId($where);
            if($collect){
                return $this->getBack('1','已收藏','');
            }else{
                return $this->getBack('0','收藏失败','');
            }
        }elseif ($status == '2'){
            $collect = CollectModel::where($where)->delete();
            if($collect){
                return $this->getBack('1','取消收藏','');
            }else{
                return $this->getBack('0','取消失败','');
            }
        }else{
            return $this->getBack('0', '状态不正确', '');
        }
    }
}
