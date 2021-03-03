<?php

namespace App\Http\Controllers\Admin;

use App\Model\userModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{

    public function userLogin(Request $request){
        $data = $request->post();

        $user_tel = !empty($data['user_tel']) ? $data['user_tel'] : '';
        $user_pwd = !empty($data['user_pwd']) ? $data['user_pwd'] : '';
        if (empty($user_tel)) {
            return $this->getBack('0', 'user_tel', '');
        }else if (empty($user_pwd)) {
            return $this->getBack('0', 'user_pwd', '');
        }


        $user = userModel::where(['user_tel'=>$user_tel,'user_pwd'=>$user_pwd,'user_admin'=>'1'])->first();
        if($user){
            $user = empty($user) ? array():$user->toArray();
            return $this->getBack('1','登录成功',$user['user_id']);
        }else{
            return  $this->getBack('0','失败','');
        }
    }


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

    public function adminList(){
        $user = userModel::where(['user_admin'=>'1'])->orderBy('user_zctime', 'desc')->get();
        return  $this->getBack('1','OK',$user);
    }

    public function userSex(Request $request){
        $data = $request->post();

        $user_sex = !empty($data['user_sex']) ? $data['user_sex'] : '';          //城市id
        if (empty($user_sex)) {
            return $this->getBack('0', 'user_sex', '');
        }

        $user = userModel::where(['user_sex'=>$user_sex])->orderBy('user_zctime', 'desc')->get();
        return  $this->getBack('1','OK',$user);
    }

    public function userString(Request $request){
        $data = $request->post();

        $string = !empty($data['string']) ? $data['string'] : '';          //城市id
        if (empty($string)) {
            return $this->getBack('0', 'string', '');
        }

        $user = userModel::where('user_name','like','%'.$string.'%')->orderBy('user_zctime', 'desc')->get();
        return  $this->getBack('1','OK',$user);
    }
}


