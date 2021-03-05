<?php

namespace App\Http\Controllers\Index;

use App\Model\CollectModel;
use App\Model\LikeModel;
use App\Model\PLModel;
use App\Model\userModel;
use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PLController extends Controller
{
    /**
     * 评论添加
     * @param Request $request
     * @return false|mixed|string
     */
    public function PL(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户id
        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //游记id
        $pl_content = !empty($data['pl_content']) ? $data['pl_content'] : '';          //评论信息
        $pl_time = !empty($data['pl_time']) ? $data['pl_time'] : '';          //评论信息

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }elseif (empty($yj_id)) {
            return $this->getBack('0', '无此游记', '');
        }elseif (empty($pl_content)) {
            return $this->getBack('0', '评论信息', '');
        }elseif (empty($pl_time)) {
            return $this->getBack('0', '评论时间', '');
        }

        $where = ['user_id'=>$user_id,'yj_id'=>$yj_id,'pl_content'=>$pl_content,'pl_time'=>$pl_time];

        $result = PLModel::insertGetId($where);
        if($result){
            return $this->getBack('1','评论成功','');
        }else{
            return $this->getBack('0','评论失败','');
        }
    }

    /**
     * 评论删除
     * @return false|mixed|string
     */
    public function PLDel(Request $request){
        $data = $request->post();

        $pl_id = !empty($data['pl_id']) ? $data['pl_id'] : '';          //评论id
        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //游记id
        $status = !empty($data['status']) ? $data['status'] : '';          //状态

        if (empty($pl_id)) {
            return $this->getBack('0', '评论id错误', '');
        }elseif (empty($yj_id)) {
            return $this->getBack('0', '无此游记', '');
        }elseif (empty($status)) {
            return $this->getBack('0', '状态不正确', '');
        }

        $where = ['pl_id'=>$pl_id,'yj_id'=>$yj_id];
        if ($status == '2'){
            $collect = PLModel::where($where)->delete();
            if($collect){
                return $this->getBack('1','成功删除','');
            }else{
                return $this->getBack('0','删除失败','');
            }
        }else{
            return $this->getBack('0', '状态不正确', '');
        }
    }

    /**
     * 游记评论列表
     * @return false|mixed|string
     */
    public function yjPLList(Request $request){
        $data = $request->post();

        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //游记id

        if (empty($yj_id)) {
            return $this->getBack('0', '无此游记', '');
        }

        $result = PLModel::where(['yj_id'=>$yj_id])->get();
        $result = empty($result) ? array():$result->toArray();
        if($result){

            foreach ($result as $key=>$value){
                $user = userModel::where(['user_id'=>$value['user_id']])->first();
                $user = empty($user) ? array():$user->toArray();

                $result[$key]['pl_time'] = date('Y-m-d H:i:s',$value['pl_time']);
                $result[$key]['user_name'] = $user['user_name'];
                $result[$key]['user_img'] = $user['user_img'];
            }

            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * 游记详情
     * @return false|mixed|string
     */
    public function yjDetail(Request $request){
        $data = $request->post();

        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //游记id

        if (empty($yj_id)) {
            return $this->getBack('0', '无此游记', '');
        }

        $result = YouJiModel::where(['yj_id'=>$yj_id])->first();
        $result = empty($result) ? array():$result->toArray();


        $result['user'] =    userModel::where(['user_id'=>$result['user_id']])->first();

        $result['like_num'] =    LikeModel::where(['yj_id'=>$yj_id])->count();
        $result['collect_num'] =    CollectModel::where(['yj_id'=>$yj_id])->count();
        $result['pl_num'] =    PLModel::where(['yj_id'=>$yj_id])->count();

        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }
}
