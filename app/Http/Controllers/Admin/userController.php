<?php

namespace App\Http\Controllers\Admin;

use App\Model\userModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{

    public function index(){
        $user = userModel::orderBy('user_zctime', 'desc')->get();
        return  $this->getBack('1','OK',$user);
    }
    
    public function delete(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //城市id
        if (empty($user_id)) {
            return $this->getBack('0', 'user_id', '');
        }


        $result = UserModel::where(['user_id'=>$user_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function update(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //城市id
        if (empty($user_id)) {
            return $this->getBack('0', 'user_id', '');
        }

        $admin_id = userModel::where(['user_id'=>$user_id])->first();
        $admin_id = empty($admin_id) ? array():$admin_id->toArray();
        if($admin_id['user_admin']=='2'){
            $admin_id = '1';
        }else{
            $admin_id = '2';
        }

        $result = UserModel::where(['user_id'=>$user_id])->update(['user_admin'=>$admin_id]);
        if($result){
            return $this->getBack('1', '成功', '');
        }else{
            return $this->getBack('0', '失败', '');
        }

    }
}


