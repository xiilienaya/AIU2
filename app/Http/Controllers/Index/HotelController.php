<?php

namespace App\Http\Controllers\Index;

use App\Model\HorderModel;
use App\Model\HotelModel;
use App\Model\HotelPlModel;
use App\Model\HotelTypeModel;
use App\Model\userModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function hotelList(Request $request){
        $hotel = HotelModel::select('hotel_id','hotel_name','hotel_rate','hotel_address','hotel_tag','hotel_img','hotel_price')->get();
        return $this->getBack('1','OK',$hotel);
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function hotelSel(Request $request){
        $data = $request->post();

        $price = !empty($data['price']) ? $data['price'] : '';                  //价格区间
        $hotel_star = !empty($data['hotel_star']) ? $data['hotel_star'] : '';       //星级
        $server = !empty($data['server']) ? $data['server'] : '';                   //服务
        $hotel_city = !empty($data['hotel_city']) ? $data['hotel_city'] : '';       //酒店所在城市

        $where = [];
        if(!empty($hotel_star)){
                $where['hotel_star'] = $hotel_star;
        }else if(!empty($server)){
                $where['hotel_server'] = $server;
        }else if(!empty($hotel_city)){
                $where['hotel_city'] = $hotel_city;
        }

        if(empty($price)&&empty($where)){
            $hotel = HotelModel::select('hotel_id','hotel_name','hotel_rate','hotel_address','hotel_tag','hotel_img','hotel_price')->get();
        }else if(empty($price)&&!empty($where)){
            $hotel = HotelModel::select('hotel_id','hotel_name','hotel_rate','hotel_address','hotel_tag','hotel_img','hotel_price')->where($where)->get();
        }else if(!empty($price)&&empty($where)){
            $hotel = HotelModel::select('hotel_id','hotel_name','hotel_rate','hotel_address','hotel_tag','hotel_img','hotel_price')->whereBetween('hotel_price',$price)->get();
        }else{
            $hotel = HotelModel::select('hotel_id','hotel_name','hotel_rate','hotel_address','hotel_tag','hotel_img','hotel_price')->where($where)->whereBetween('hotel_price',$price)->get();
        }

        return $this->getBack('1','OK',$hotel);
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function hotelDetail(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';                  //酒店id
        if (empty($hotel_id)) {
            return $this->getBack('0', '无此酒店', '');
        }

        $hotel = HotelModel::where(['hotel_id'=>$hotel_id])->first();
        return $this->getBack('1','OK',$hotel);
    }

    public function hotelType(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';                  //酒店id
        if (empty($hotel_id)) {
            return $this->getBack('0', '无此酒店', '');
        }

        $hotel =HotelTypeModel::where(['hotel_id'=>$hotel_id])->get();
        return $this->getBack('1','OK',$hotel);
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function hotelPl(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';                  //酒店id
        if (empty($hotel_id)) {
            return $this->getBack('0', '无此酒店', '');
        }

        $hotel = HotelPlModel::where(['hotel_id'=>$hotel_id])->get();
        foreach($hotel as $key=>$value){
            $user = userModel::where(['user_id'=>$value['user_id']])->select('user_name','user_img')->first();
            $hotel[$key]['user_img'] = $user['user_img'];
            $hotel[$key]['user_name'] = $user['user_name'];
        }
        return $this->getBack('1','OK',$hotel);
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function addOrder(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';                  //用户id
        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';                  //酒店id
        $type_id = !empty($data['type_id']) ? $data['type_id'] : '';                  //房型id
        $horder_price = !empty($data['user_id']) ? $data['horder_price'] : '';                  //总价
        $horder_start = !empty($data['horder_start']) ? $data['horder_start'] : '';                  //入住时间
        $horder_end = !empty($data['horder_end']) ? $data['horder_end'] : '';                  //结束时间
        $horder_number = !empty($data['horder_number']) ? $data['horder_number'] : '';                  //订单编号
        $horder_cancel = !empty($data['horder_cancel']) ? $data['horder_cancel'] : '';                  //取消规则
        $horder_num = !empty($data['horder_num']) ? $data['horder_num'] : '';                  //房间数量
        $horder_name = !empty($data['horder_name']) ? $data['horder_name'] : '';                  //住客姓名
        $horder_tel = !empty($data['horder_tel']) ? $data['horder_tel'] : '';                  //住客手机号
        $horder_fapiao = !empty($data['horder_fapiao']) ? $data['horder_fapiao'] : '';                  //发票
        $horder_days = !empty($data['horder_days']) ? $data['horder_days'] : '';                  //入住天数

        if (empty($hotel_id)) {
            return $this->getBack('0', '无此酒店', '');
        }else if(empty($user_id)){
            return $this->getBack('0', '无此用户', '');
        }else if(empty($type_id)){
            return $this->getBack('0', '无此房型', '');
        }else if(empty($horder_price)){
            return $this->getBack('0', '总价，不能为空!', '');
        }else if(empty($horder_start)){
            return $this->getBack('0', '入住时间，不能为空!', '');
        }else if(empty($horder_end)){
            return $this->getBack('0', '结束时间，不能为空!', '');
        }else if(empty($horder_number)){
            return $this->getBack('0', '订单编号，不能为空!', '');
        }else if(empty($horder_cancel)){
            return $this->getBack('0', '取消规则', '');
        }else if(empty($horder_num)){
            return $this->getBack('0', '房间数量,', '');
        }else if(empty($horder_name)){
            return $this->getBack('0', '住客姓名', '');
        }else if(empty($horder_tel)){
            return $this->getBack('0', '住客手机号', '');
        }else if(empty($horder_fapiao)){
            return $this->getBack('0', '发票', '');
        }else if(empty($horder_days)){
            return $this->getBack('0', '入住天数', '');
        }

        $data = [
            'user_id' => $user_id,
            'hotel_id' => $hotel_id,
            'type_id' => $type_id,
            'horder_price' => $horder_price,
            'horder_start' => $horder_start,
            'horder_end' => $horder_end,
            'horder_number' => $horder_number,
            'horder_cancel' => $horder_cancel,
            'horder_num' => $horder_num,
            'horder_name' => $horder_name,
            'horder_tel' => $horder_tel,
            'horder_fapiao' => $horder_fapiao,
            'horder_days' => $horder_days,
        ];

        $result =   HorderModel::insertGetId($data);

        if($result){
            return $this->getBack('1','成功添加订单!',$result);
        }else{
            return $this->getBack('2','失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function selOrder(Request $request){
        $data = $request->post();

        $user_id = empty($data['user_id'])?'':$data['user_id'];

        if(empty($user_id)){
            return $this->getBack('0','用户数据','');
        }

        $horder = HorderModel::where(['horder_state'=>'1'])->select('horder_id','horder_state','horder_end')->get();
        if($horder){
            foreach ($horder as $key=>$value){
                if(time() > strtotime($value['horder_end'])){
                    HorderModel::where(['horder_id'=>$value['horder_id']])->update(['horder_state'=>'2']);
                }
            }
        }

        $horder = HorderModel::where(['user_id'=>$user_id])->select('horder_id','hotel_id','horder_start','horder_price','horder_number','horder_state','horder_end')->get();

        if($horder){
            foreach ($horder as $key=>$value){
                $hotel_name = HotelModel::where(['hotel_id' => $value['hotel_id']])->select('hotel_name')->first();
                $horder[$key]['hotel_name'] = $hotel_name['hotel_name'];
            }

            return $this->getBack('1','OK',$horder);
        }else{
            return $this->getBack('0','NO','');
        }

    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function orderDetail(Request $request){
        $data = $request->post();

        $horder_id = empty($data['horder_id'])?'':$data['horder_id'];

        if(empty($horder_id)){
            return $this->getBack('0','订单错误','');
        }

        $data =[];

        $data['horder'] = HorderModel::where(['horder_id'=>$horder_id])->first()->toArray();
        $data['hotel'] = HotelModel::where(['hotel_id'=>$data['horder']['hotel_id']])->select('hotel_id','hotel_name','hotel_phone','hotel_address','hotel_img')->first();
        $data['type'] = HotelTypeModel::where(['type_id'=>$data['horder']['type_id']])->select('type_name')->first();
        if(!empty($data)){
            return $this->getBack('1','订单详情',$data);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function orderCancel(Request $request){
        $data = $request->post();

        $horder_id = empty($data['horder_id'])?'':$data['horder_id'];
        $horder_state = empty($data['horder_state'])?'':$data['horder_state'];

        if(empty($horder_id)){
            return $this->getBack('0','订单错误','');
        }

        $horder = HorderModel::where(['horder_id'=>$horder_id,'horder_num'=>'1','horder_state'=>'1'])->update(['horder_state'=>$horder_state]);
        if($horder){
            return $this->getBack('1','取消成功','');
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function addHotelPl(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';                  //酒店id
        $hpl_content = !empty($data['hpl_content']) ? $data['hpl_content'] : '';                  //评论内容
        $hpl_rate = !empty($data['hpl_rate']) ? $data['hpl_rate'] : '';                  //评分
        $hpl_time = !empty($data['hpl_time']) ? $data['hpl_time'] : '';                  //发表时间
        $user_id = empty($data['user_id'])?'':$data['user_id'];                         //用户id


        if (empty($hotel_id)) {
            return $this->getBack('0', '无此酒店', '');
        }elseif (empty($hpl_content)){
            return $this->getBack('0', '评论内容', '');
        }elseif (empty($user_id)){
            return $this->getBack('0', '用户id', '');
        }elseif (empty($hpl_time)){
            return $this->getBack('0', '发表时间', '');
        }elseif (empty($hpl_rate)){
            return $this->getBack('0', '评分', '');
        }

        $data = [
            'user_id' => $user_id,
            'hotel_id' => $hotel_id,
            'hpl_content' => $hpl_content,
            'hpl_rate' => $hpl_rate,
            'hpl_time' => $hpl_time,
        ];

        $result = HotelPlModel::insertGetId($data);

        if($result){
            return $this->getBack('1','评论成功!',$result);
        }else{
            return $this->getBack('2','评论失败','');
        }

    }

}
