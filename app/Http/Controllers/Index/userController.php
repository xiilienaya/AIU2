<?php

namespace App\Http\Controllers\Index;

use App\Model\FansModel;
use App\Model\LikeModel;
use App\Model\UserModel;
use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    /**
     * 用户登录
     * @param Request $request
     * @return false|mixed|string
     */
    public function login(Request $request)
    {
        $data = $request->post();

        $user_tel = !empty($data['user_tel']) ? $data['user_tel'] : '';          //电话号码
        $user_pwd = !empty($data['user_pwd']) ? $data['user_pwd'] : '';          //密码

        if (empty($user_tel)) {
            return $this->getBack('0', '电话号码不能为空', '');
        } else if (!preg_match('#^1[3,4,5,7,8,9]{1}[\d]{9}$#', $user_tel)) {
            return $this->getBack('0', '电话号码格式错误', '');
        }
        
        $result = userModel::where(['user_tel'=>$user_tel,'user_pwd'=>$user_pwd])->first();
        if($result){
            $result = empty($result) ? array():$result->toArray();
            return $this->getBack('1','登录成功',$result['user_id']);
        }else{
            return $this->getBack('0','登录失败','');
        }

    }

    /**
     * 用户注册模块
     * @param Request $request
     * @return false|mixed|string
     */
    public function register(Request $request){
        $data = $request->post();

        $user_tel = !empty($data['user_tel']) ? $data['user_tel'] : '';          //电话号码
        $user_name = !empty($data['user_name']) ? $data['user_name'] : '';          //用户名
        $user_pwd = !empty($data['user_pwd']) ? $data['user_pwd'] : '';          //密码 
         
        if (empty($user_tel)) {
            return $this->getBack('0', '电话号码不能为空', '');
        } else if (!preg_match('#^1[3,4,5,7,8,9]{1}[\d]{9}$#', $user_tel)) {
            return $this->getBack('0', '电话号码格式错误', '');
        }
 
        $user_phone = userModel::where(['user_tel'=>$user_tel])->first();
        if($user_phone){
            return $this->getBack('0', '此号码已注册过', '');
        }

        $data = [
            'user_name'=>$user_name,
            'user_tel'=>$user_tel,
            'user_pwd'=>$user_pwd,
            'user_zctime'=>time(),
            'user_img'=>'http://www.aiu.com/896ff430gy1ghjahov32aj20u00u0dkw.jpg'
        ]; 
        $result = userModel::insertGetId($data);
        if($result){
            return $this->getBack('1','注册成功',$result);
        }else{
            return $this->getBack('0','注册失败','');
        }

    }

    /**
     * 用户详情
     * @param Request $request
     * @return false|mixed|string
     */
    public function userInfo(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $result = userModel::where(['user_id'=>$user_id])->select('user_name','user_signature','user_img')->first();
        $result = empty($result) ? array():$result->toArray();

        $fans_count = FansModel::where(['bgz_id'=>$user_id,'status'=>1])->count();
        $attention = FansModel::where(['gz_id'=>$user_id,'status'=>1])->count();

        $result['fs_num'] = $fans_count;
        $result['gz_num'] = $attention;
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }

    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function userYj(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //用户

        if (empty($user_id)) {
            return $this->getBack('0', '无此用户', '');
        }

        $result = YouJiModel::where(['user_id'=>$user_id])->orderBy('yj_date','desc')->get();
        $result = empty($result) ? array():$result->toArray();



        if($result){
            foreach ($result as $k=>$val){
                $result[$k]['like_num'] =    LikeModel::where(['yj_id'=>$val['yj_id']])->count();
            }
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }

    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function yjDel(Request $request)
    {
        $data = $request->post();

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


        $result = YouJiModel::where(['user_id'=>$user_id,'yj_id'=>$yj_id])->delete();

        if($result){
            return $this->getBack('1','删除成功','');
        }else{
            return $this->getBack('0','删除失败','');
        }
    }

    /**
     * 发送手机验证码
     * @return false|mixed|string
     */
    public function phoneCode()
    {
        $data = request()->post();

        $user_tel = !empty($data['user_tel']) ? $data['user_tel'] : '';          //

        $user_phone = userModel::where(['user_tel'=>$user_tel])->first();
        if($user_phone){
            return $this->getBack('0', '此号码已注册过', '');
        }

        if (empty($user_tel)) {
            return $this->getBack('0', '电话号码不能为空', '');
        } else if (!preg_match('#^1[3,4,5,7,8,9]{1}[\d]{9}$#', $user_tel)) {
            return $this->getBack('0', '电话号码格式错误', '');
        } 

        //获取验证码 生成的随机数
        $rand = $this->random(4,1);
        $data = $this->SendSms($user_tel,$rand);
        if($data['SubmitResult']['code']==2){ 
            return $this->getBack('1','已发送',$rand);
        }else{
            return $this->getBack('0','获取验证码失败','');
        }
    }

    /**
     * @throws Exception
     */
    public function SendSms($phone,$rand)
    {

        //短信接口地址
        $target = "http://106.ihuyi.com/webservice/sms.php?method=Submit";
        $appid = "";
        $apiKey = "";

        $post_data = "account=C40658027&password=435786c7ec9e7e9b2c09fe60acb649cc&mobile=".$phone."&content=".rawurlencode("您的验证码是：".$rand."。请不要把验证码泄露给其他人。");
        //查看用户名 登录用户中心->验证码通知短信>产品总览->API接口信息->APIID
        //查看密码 登录用户中心->验证码通知短信>产品总览->API接口信息->APIKEY
        $gets =  $this->xml_to_array($this->SendPost($post_data, $target));
//        echo $gets['SubmitResult']['msg'];
        return $gets;
    }

    //请求数据到短信接口，检查环境是否 开启 curl init。
    public function SendPost($curlPost, $url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }

    //将 xml数据转换为数组格式。
    public function xml_to_array($xml)
    {
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if (preg_match_all($reg, $xml, $matches)) {
            $count = count($matches[0]);
            for ($i = 0; $i < $count; $i++) {
                $subxml = $matches[2][$i];
                $key = $matches[1][$i];
                if (preg_match($reg, $subxml)) {
                    $arr[$key] = $this->xml_to_array($subxml);
                } else {
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

    //random() 函数返回随机整数。
    public function random($length = 6, $numeric = 0)
    {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if ($numeric) {
            $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }

}