<?php

namespace App\Http\Controllers\Index;

use App\Model\UserModel;
use App\Model\FansModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FansController extends Controller
{
    /**
     * 关注
     * @param Request $request
     * @return false|mixed|string
     */
    public function focusUser(Request $request){

        $data = $request->post();

        $gz_id = !empty($data['gz_id']) ? $data['gz_id'] : '';          //关注id
        $bgz_id = !empty($data['bgz_id']) ? $data['bgz_id'] : '';          //被关注id
        $status = !empty($data['status']) ? $data['status'] : '';          //用户

        if (empty($gz_id)) {
            return $this->getBack('0', '无此用户关注id', '');
        }else if (empty($bgz_id)) {
            return $this->getBack('0', '无此用户被关注id', '');
        }else if (empty($status)) {
            return $this->getBack('0', '无此用户', '');
        }


        $where=[
            'gz_id'=>$gz_id,
            'bgz_id'=>$bgz_id
        ];


        $fans = FansModel::where($where)->first();

        if($fans){
            $result = FansModel::where($where)->update(['status'=>$status]);
        }else{
            $where['status']=$status;
            $result = FansModel::insertGetId($where);
        }
        if($result){
            if($status==1){
                return $this->getBack('1','已关注','');
            }else{
                return $this->getBack('1','已取消关注','');
            }
        }else{
            return $this->getBack('0','失败','');
        }

    }

    public function focusList(Request $request){
        $data = $request->post();
        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $fans = FansModel::where(['bgz_id'=>$user_id,'status'=>1])->get();

        if($fans){
            $data = [];
            foreach ($fans as $key=>$val){
                $result = userModel::where(['user_id'=>$val['gz_id']])->select('user_id','user_name','user_signature','user_img')->first();
                $result = empty($result) ? array():$result->toArray();
                $fans_count = FansModel::where(['bgz_id'=>$val['gz_id'],'status'=>1])->count();
                $attention = FansModel::where(['gz_id'=>$val['gz_id'],'status'=>1])->count();

                $result['fs_num'] = $fans_count;
                $result['gz_num'] = $attention;
                $data[$key] = $result;
            }
        }

        if($result){
            return $this->getBack('1','OK',$data);
        }else{
            return $this->getBack('0','NO','');
        }
    }


    public function attention(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $fans = FansModel::where(['gz_id'=>$user_id,'status'=>1])->get();

        if($fans){
            $data = [];
            foreach ($fans as $key=>$val){
                $result = userModel::where(['user_id'=>$val['bgz_id']])->select('user_id','user_name','user_signature','user_img')->first();
                $result = empty($result) ? array():$result->toArray();
                $fans_count = FansModel::where(['bgz_id'=>$val['bgz_id'],'status'=>1])->count();
                $attention = FansModel::where(['gz_id'=>$val['bgz_id'],'status'=>1])->count();

                $result['fs_num'] = $fans_count;
                $result['gz_num'] = $attention;
                $data[$key] = $result;
            }
        }

        if($result){
            return $this->getBack('1','OK',$data);
        }else{
            return $this->getBack('0','NO','');
        }
    }
}
