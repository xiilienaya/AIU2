<?php

namespace App\Http\Controllers\Index;

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

    /**
    public function focusList(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $result = userModel::where(['user_id'=>$user_id])->select('user_name','user_signature','user_img')->first();
        $result = empty($result) ? array():$result->toArray();
        $fans = FansModel::where(['bgz_id'=>$user_id,'status'=>1])->get();

        $attention = count($fans);
        if($attention>0){
            $fans = $fans->toArray();
            $fans_count = '0';
            foreach ($fans as $key=>$value){
                $count = FansModel::where(['bgz_id'=>$value['gz_id'],'status'=>1])->get();
                $num = count($count);
                if($num>0){
                    $count =$count->toArray();
                    $fans_count = $fans_count+$num;
                }

            }
        }
        $result['fs_num'] = $fans_count+$attention;
        $result['gz_num'] = $attention;
        if($result){
            return $this->getBack('1','OK',$result);
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

        $result = userModel::where(['user_id'=>$user_id])->select('user_name','user_signature','user_img')->first();
        $result = empty($result) ? array():$result->toArray();
        $fans = FansModel::where(['bgz_id'=>$user_id,'status'=>1])->get();

        $attention = count($fans);
        if($attention>0){
            $fans = $fans->toArray();
            $fans_count = '0';
            foreach ($fans as $key=>$value){
                $count = FansModel::where(['bgz_id'=>$value['gz_id'],'status'=>1])->get();
                $num = count($count);
                if($num>0){
                    $count =$count->toArray();
                    $fans_count = $fans_count+$num;
                }

            }
        }
        $result['fs_num'] = $fans_count+$attention;
        $result['gz_num'] = $attention;
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }
     */
}
