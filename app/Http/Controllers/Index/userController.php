<?php

namespace App\Http\Controllers\Index;

use App\Model\CollectModel;
use App\Model\FansModel;
use App\Model\LikeModel;
use App\Model\UserModel;
use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{

    public function destination(Request $request){
        $data = $request->post();

        $yj_destination = !empty($data['yj_destination']) ? $data['yj_destination'] : '';                //目的地不能为空
        if(empty($yj_destination)){
            return $this->getBack('0','目的地不能为空','');
        }

        $result = YouJiModel::where(['yj_destination'=>$yj_destination])->orderBy('yj_date','desc')->get();
        $result = empty($result) ? array():$result->toArray();

        if($result){
            foreach($result as $key=>$value){
                $user = userModel::where(['user_id'=>$value['user_id']])->select('user_name','user_img')->first();
                $result[$key]['user_img'] = $user['user_img'];
                $result[$key]['user_name'] = $user['user_name'];
            }
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }

    }

    public function yjTjList(Request $request){
        $result = YouJiModel::where(['is_tj'=>'1'])->orderBy('yj_date','desc')->get();
        $result = empty($result) ? array():$result->toArray();
        if($result){
            foreach($result as $key=>$value){
                $user = userModel::where(['user_id'=>$value['user_id']])->select('user_name','user_img')->first();
                $result[$key]['user_img'] = $user['user_img'];
                $result[$key]['user_name'] = $user['user_name'];
            }
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    public function yjLBList(Request $request){
        $result = YouJiModel::orderBy('yj_date','desc')->get();
        $result = empty($result) ? array():$result->toArray();
        if($result){
            foreach($result as $key=>$value){
                $user = userModel::where(['user_id'=>$value['user_id']])->select('user_name','user_img')->first();
                $result[$key]['user_img'] = $user['user_img'];
                $result[$key]['user_name'] = $user['user_name'];
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
    public function user(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';                //用户id
        if(empty($user_id)){
            return $this->getBack('0','无此用户','');
        }

        $result = userModel::where(['user_id'=>$user_id])->first();
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * 发布游记
     * @param Request $request
     * @return false|mixed|string
     */
    public function addYj(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';                //用户id
        $yj_title = !empty($data['yj_title']) ? $data['yj_title'] : '';                 //游记标题
        $yj_publishTime = !empty($data['yj_publishTime']) ? $data['yj_publishTime'] : '';          //发表时间
        $yj_headImg = !empty($data['yj_headImg']) ? $data['yj_headImg'] : '';          //游记头图
        $yj_imgList = !empty($data['yj_imgList']) ? $data['yj_imgList'] : '';          //配图列表
        $yj_content = !empty($data['yj_content']) ? $data['yj_content'] : '';          //文章内容
        $yj_date = !empty($data['yj_date']) ? $data['yj_date'] : '';                    //出发时间
        $yj_days = !empty($data['yj_date']) ? $data['yj_days'] : '';                    //游玩天数
        $yj_money = !empty($data['yj_money']) ? $data['yj_money'] : '';                 //人均消费
        $yj_destination = !empty($data['yj_destination']) ? $data['yj_destination'] : '';          //目的地

        if(empty($user_id)){
            return $this->getBack('0','无此用户','');
        }elseif (empty($yj_title)){
            return $this->getBack('0','游记标题,不能为空！','');
        }elseif (empty($yj_publishTime)){
            return $this->getBack('0','发表时间,不能为空！','');
        }elseif (empty($yj_headImg)){
            return $this->getBack('0','游记头图,不能为空！','');
        }elseif (empty($yj_imgList)){
            return $this->getBack('0','配图列表,不能为空！','');
        }elseif (empty($yj_content)){
            return $this->getBack('0','文章内容,不能为空！','');
        }elseif (empty($yj_date)){
            return $this->getBack('0','出发时间,不能为空！','');
        }elseif (empty($yj_days)){
            return $this->getBack('0','游玩天数,不能为空！','');
        }elseif (empty($yj_money)){
            return $this->getBack('0','人均消费,不能为空！','');
        }elseif (empty($yj_destination)){
            return $this->getBack('0','目的地,不能为空！','');
        }

        $date=[
            'user_id'=>$user_id,
            'yj_title'=>$yj_title,
            'yj_publishTime'=>$yj_publishTime,
            'yj_headImg'=>$yj_headImg,
            'yj_imgList'=>$yj_imgList,
            'yj_content'=>$yj_content,
            'yj_date'=>$yj_date,
            'yj_days'=>$yj_days,
            'yj_money'=>$yj_money,
            'is_tj'=>2,
            'yj_destination'=>$yj_destination,
        ];

        $result = YouJiModel::insertGetId($date);

        if($result){
            return $this->getBack('1','发布游记成功','');
        }else{
            return $this->getBack('0','发布失败','');
        }
    }

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
     * 用户的个人修改
     * @param Request $request
     * @return false|mixed|string
     */
    public function userUpdate(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //唯一id
        $user_img = !empty($data['user_img']) ? $data['user_img'] : '';          //用户头像
        $user_name = !empty($data['user_name']) ? $data['user_name'] : '';          //用户名
        $user_sex = !empty($data['user_sex']) ? $data['user_sex'] : '';          //用户性别
        $user_signature = !empty($data['user_signature']) ? $data['user_signature'] : '';          //个人签名

        if(empty($user_id)){
            return $this->getBack('0', '无此用户', '');
        }else if(empty($user_img)){
            return $this->getBack('0', '用户头像，不能为空！', '');
        }else if(empty($user_name)){
            return $this->getBack('0', '用户名，不能为空！', '');
        }else if(empty($user_sex)){
            return $this->getBack('0', '用户性别，不能为空！', '');
        } else if(empty($user_signature)){
            return $this->getBack('0', '个人签名，不能为空！', '');
        }

        $data = [
            'user_name'=>$user_name,
            'user_img'=>$user_img,
            'user_sex'=>$user_sex,
            'user_signature'=>$user_signature
        ];
        $result = userModel::where(['user_id'=>$user_id])->update($data);
        if($result){
            return $this->getBack('1','修改成功',$result);
        }else{
            return $this->getBack('0','修改失败','');
        }
    }

    /**
     * 修改密码
     * @param Request $request
     * @return false|mixed|string
     */
    public function userPwd(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';          //唯一id
        $user_oldPwd = !empty($data['user_oldPwd']) ? $data['user_oldPwd'] : '';          //老的密码
        $user_newPwd = !empty($data['user_newPwd']) ? $data['user_newPwd'] : '';          //新的密码

        if(empty($user_id)){
            return $this->getBack('0', '无此用户', '');
        }else if(empty($user_oldPwd)){
            return $this->getBack('0', '用户头像，不能为空！', '');
        }else if(empty($user_newPwd)){
            return $this->getBack('0', '用户名，不能为空！', '');
        }

        $data = [
            'user_pwd'=>$user_newPwd,
        ];

        $result = userModel::where(['user_id'=>$user_id,'user_pwd'=>$user_oldPwd])->update($data);
        if($result){
            return $this->getBack('1','修改成功','');
        }else{
            return $this->getBack('0','修改失败','');
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
                $result[$k]['collect_num'] =    CollectModel::where(['yj_id'=>$val['yj_id']])->count();
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