<?php

namespace App\Http\Controllers\Admin;

use App\Model\HotelModel;
use App\Model\PlaneModel;
use App\Model\SpotModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpotController extends Controller
{
    public function index(){
        $spot = SpotModel::get();
        return $this->getBack('1','OK',$spot);
    }

    public function delete(Request $request){
        $data = $request->post();

        $spot_id = !empty($data['spot_id']) ? $data['spot_id'] : '';          //城市id
        if (empty($spot_id)) {
            return $this->getBack('0', 'spot_id', '');
        }


        $result = SpotModel::where(['spot_id'=>$spot_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function spotDetail(Request $request){
        $data = $request->post();

        $spot_id = !empty($data['spot_id']) ? $data['spot_id'] : '';          //景点id

        if (empty($spot_id)) {
            return $this->getBack('0', '景点id', '');
        }


        $spot = SpotModel::where(['spot_id'=>$spot_id])->first();
        if($spot){
            return $this->getBack('1','OK',$spot);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    public function update(Request $request){
        $data = $request->post();

        $name = !empty($data['name']) ? $data['name'] : '';          //城市id
        $spot_id = !empty($data['spot_id']) ? $data['spot_id'] : '';          //城市id
        $spot_name = !empty($data['spot_name']) ? $data['spot_name'] : '';          //城市id
        $spot_ename = !empty($data['spot_ename']) ? $data['spot_ename'] : '';          //城市id
        $spot_imgList = !empty($data['spot_imgList']) ? $data['spot_imgList'] : '';          //城市id
        $spot_summary = !empty($data['spot_summary']) ? $data['spot_summary'] : '';          //城市id
        $spot_jianjie = !empty($data['spot_jianjie']) ? $data['spot_jianjie'] : '';          //城市id
        $spot_tips = !empty($data['spot_tips']) ? $data['spot_tips'] : '';          //城市id
        $spot_ticket = !empty($data['spot_ticket']) ? $data['spot_ticket'] : '';          //城市id
        $spot_rate = !empty($data['spot_ticket']) ? $data['spot_rate'] : '';          //城市id
        if (empty($name)) {
            return $this->getBack('0', 'name', '');
        }elseif (empty($spot_id)) {
            return $this->getBack('0', 'spot_id', '');
        }elseif (empty($spot_name)) {
            return $this->getBack('0', 'spot_name', '');
        }elseif (empty($spot_ename)) {
            return $this->getBack('0', 'spot_ename', '');
        }elseif (empty($spot_imgList)) {
            return $this->getBack('0', 'spot_imgList', '');
        }elseif (empty($spot_summary)) {
            return $this->getBack('0', 'spot_summary', '');
        }elseif (empty($spot_jianjie)) {
            return $this->getBack('0', 'spot_jianjie', '');
        }elseif (empty($spot_tips)) {
            return $this->getBack('0', 'spot_tips', '');
        }elseif (empty($spot_ticket)) {
            return $this->getBack('0', 'spot_ticket', '');
        }elseif (empty($spot_rate)) {
            return $this->getBack('0', 'spot_rate', '');
        }

        $data=[
            'name' => $name,
            'spot_ename' => $spot_ename,
            'spot_name' => $spot_name,
            'spot_imgList' => $spot_imgList,
            'spot_summary' => $spot_summary,
            'spot_jianjie' => $spot_jianjie,
            'spot_tips' => $spot_tips,
            'spot_ticket' => $spot_ticket,
            'spot_rate' => $spot_rate,
        ];


        $result = SpotModel::where(['spot_id'=>$spot_id])->update($data);
        if($result){
            return $this->getBack('1', '修改成功', '');
        }else{
            return $this->getBack('0', '修改失败', '');
        }
    }

    public function spotT(Request $request){
        $data = $request->post();

        $spot_id = !empty($data['spot_id']) ? $data['spot_id'] : '';          //城市id
        if (empty($spot_id)) {
            return $this->getBack('0', 'spot_id', '');
        }

        $spot_status = SpotModel::where(['spot_id'=>$spot_id])->first();
        $spot_status = empty($spot_status) ? array():$spot_status->toArray();
        if($spot_status['spot_status']=='2'){
            $spot_status = '1';
        }else{
            $spot_status = '2';
        }

        $result = SpotModel::where(['spot_id'=>$spot_id])->update(['spot_status'=>$spot_status]);
        if($result){
            return $this->getBack('1', '成功', '');
        }else{
            return $this->getBack('3', '失败', '');
        }
    }

    public function hotel(){
        $hotel = HotelModel::get();
        return $this->getBack('1','OK',$hotel);
    }

    public function hotelDel(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';          //城市id
        if (empty($hotel_id)) {
            return $this->getBack('0', 'hotel_id', '');
        }


        $result = HotelModel::where(['hotel_id'=>$hotel_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }


    public function hotelUpd(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';          //城市id
        $hotel_name = !empty($data['hotel_name']) ? $data['hotel_name'] : '';          //城市id
        $hotel_price = !empty($data['hotel_price']) ? $data['hotel_price'] : '';          //城市id
        $hotel_star = !empty($data['hotel_star']) ? $data['hotel_star'] : '';          //城市id
        $hotel_tag = !empty($data['hotel_tag']) ? $data['hotel_tag'] : '';          //城市id
        $hotel_rate = !empty($data['hotel_rate']) ? $data['hotel_rate'] : '';          //城市id
        $hotel_img = !empty($data['hotel_img']) ? $data['hotel_img'] : '';          //城市id
        $hotel_jianjie = !empty($data['hotel_jianjie']) ? $data['hotel_jianjie'] : '';          //城市id
        $hotel_imgList = !empty($data['hotel_imgList']) ? $data['hotel_imgList'] : '';          //城市id
        $hotel_yule = !empty($data['hotel_yule']) ? $data['hotel_yule'] : '';          //城市id
        $hotel_canyin = !empty($data['hotel_canyin']) ? $data['hotel_canyin'] : '';          //城市id
        $hotel_shangwu = !empty($data['hotel_shangwu']) ? $data['hotel_shangwu'] : '';          //城市id
        $hotel_server = !empty($data['hotel_server']) ? $data['hotel_server'] : '';          //城市id
        $hotel_facilities = !empty($data['hotel_facilities']) ? $data['hotel_facilities'] : '';          //城市id
        $hotel_policy = !empty($data['hotel_policy']) ? $data['hotel_policy'] : '';          //城市id
        $hotel_time = !empty($data['hotel_time']) ? $data['hotel_time'] : '';          //城市id
        $hotel_phone = !empty($data['hotel_phone']) ? $data['hotel_phone'] : '';          //城市id

        if (empty($hotel_id)) {
            return $this->getBack('0', 'hotel_id', '');
        }elseif (empty($hotel_name)) {
            return $this->getBack('0', 'hotel_name', '');
        }elseif (empty($hotel_price)) {
            return $this->getBack('0', 'hotel_price', '');
        }elseif (empty($hotel_star)) {
            return $this->getBack('0', 'hotel_star', '');
        }elseif (empty($hotel_tag)) {
            return $this->getBack('0', 'hotel_tag', '');
        }elseif (empty($hotel_rate)) {
            return $this->getBack('0', 'hotel_rate', '');
        }elseif (empty($hotel_img)) {
            return $this->getBack('0', 'hotel_img', '');
        }elseif (empty($hotel_imgList)) {
            return $this->getBack('0', 'hotel_imgList', '');
        }elseif (empty($hotel_jianjie)) {
            return $this->getBack('0', 'hotel_jianjie', '');
        }elseif (empty($hotel_yule)) {
            return $this->getBack('0', 'hotel_yule', '');
        }elseif (empty($hotel_canyin)) {
            return $this->getBack('0', 'hotel_canyin', '');
        }elseif (empty($hotel_shangwu)) {
            return $this->getBack('0', 'hotel_shangwu', '');
        }elseif (empty($hotel_server)) {
            return $this->getBack('0', 'hotel_server', '');
        }elseif (empty($hotel_facilities)) {
            return $this->getBack('0', 'hotel_facilities', '');
        }elseif (empty($hotel_policy)) {
            return $this->getBack('0', 'hotel_policy', '');
        }elseif (empty($hotel_time)) {
            return $this->getBack('0', 'hotel_time', '');
        }elseif (empty($hotel_phone)) {
            return $this->getBack('0', 'hotel_phone', '');
        }


        $data=[
            'hotel_name' => $hotel_name,
            'hotel_star' => $hotel_star,
            'hotel_price' => $hotel_price,
            'hotel_tag' => $hotel_tag,
            'hotel_rate' => $hotel_rate,
            'hotel_img' => $hotel_img,
            'hotel_imgList' => $hotel_imgList,
            'hotel_jianjie' => $hotel_jianjie,
            'hotel_yule' => $hotel_yule,
            'hotel_canyin' => $hotel_canyin,
            'hotel_shangwu' => $hotel_shangwu,
            'hotel_server' => $hotel_server,
            'hotel_facilities' => $hotel_facilities,
            'hotel_policy' => $hotel_policy,
            'hotel_time' => $hotel_time,
            'hotel_phone' => $hotel_phone,
        ];

        $result = HotelModel::where(['hotel_id'=>$hotel_id])->update($data); 
        if($result){
            return $this->getBack('1', '修改成功', '');
        }else{
            return $this->getBack('0', '修改失败', '');
        }
    }

    public function planeDetail(Request $request){
        $data = $request->post();

        $plane_id = !empty($data['plane_id']) ? $data['plane_id'] : '';          //城市id
        if (empty($plane_id)) {
            return $this->getBack('0', 'plane_id', '');
        }


        $result = PlaneModel::where(['plane_id'=>$plane_id])->first();
        if($result){
            return $this->getBack('1', '成功', $result);
        }else{
            return $this->getBack('0', '失败', '');
        }
    }

    public function planeDel(Request $request){
        $data = $request->post();

        $plane_id = !empty($data['plane_id']) ? $data['plane_id'] : '';          //城市id
        if (empty($plane_id)) {
            return $this->getBack('0', 'plane_id', '');
        }


        $result = PlaneModel::where(['plane_id'=>$plane_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function planeUpd(Request $request){
        $data = $request->post();

        $plane_id = !empty($data['plane_id']) ? $data['plane_id'] : '';          //城市id
        $plane_name = !empty($data['plane_name']) ? $data['plane_name'] : '';          //城市id
        $plane_model = !empty($data['plane_model']) ? $data['plane_model'] : '';          //城市id
        $plane_timing = !empty($data['plane_timing']) ? $data['plane_timing'] : '';          //城市id
        $plane_go = !empty($data['plane_go']) ? $data['plane_go'] : '';          //城市id
        $plane_des = !empty($data['plane_des']) ? $data['plane_des'] : '';          //城市id
        $plane_start = !empty($data['plane_start']) ? $data['plane_start'] : '';          //城市id
        $plane_end = !empty($data['plane_end']) ? $data['plane_end'] : '';          //城市id
        $plane_food = !empty($data['pluserStringane_food']) ? $data['plane_food'] : '';          //城市id
        $plane_price = !empty($data['plane_price']) ? $data['plane_price'] : '';          //城市id
        $plane_jingji = !empty($data['plane_jingji']) ? $data['plane_jingji'] : '';          //城市id
        $plane_shangwu = !empty($data['plane_shangwu']) ? $data['plane_shangwu'] : '';          //城市id
        $plane_toudeng = !empty($data['plane_toudeng']) ? $data['plane_toudeng'] : '';          //城市id
        $plane_date = !empty($data['plane_date']) ? $data['plane_date'] : '';          //城市id
        $plane_jichang1 = !empty($data['plane_jichang1']) ? $data['plane_jichang1'] : '';          //城市id
        $plane_jichang2 = !empty($data['plane_jichang2']) ? $data['plane_jichang2'] : '';          //城市id

        if (empty($plane_id)) {
            return $this->getBack('0', 'plane_id', '');
        }elseif (empty($plane_name)) {
            return $this->getBack('0', 'plane_name', '');
        }elseif (empty($plane_model)) {
            return $this->getBack('0', 'plane_model', '');
        }elseif (empty($plane_timing)) {
            return $this->getBack('0', 'plane_timing', '');
        }elseif (empty($plane_go)) {
            return $this->getBack('0', 'plane_go', '');
        }elseif (empty($plane_des)) {
            return $this->getBack('0', 'plane_des', '');
        }elseif (empty($plane_start)) {
            return $this->getBack('0', 'plane_start', '');
        }elseif (empty($plane_end)) {
            return $this->getBack('0', 'plane_end', '');
        }elseif (empty($plane_food)) {
            return $this->getBack('0', 'plane_food', '');
        }elseif (empty($plane_price)) {
            return $this->getBack('0', 'plane_price', '');
        }elseif (empty($plane_jingji)) {
            return $this->getBack('0', 'plane_jingji', '');
        }elseif (empty($plane_shangwu)) {
            return $this->getBack('0', 'plane_shangwu', '');
        }elseif (empty($plane_toudeng)) {
            return $this->getBack('0', 'plane_toudeng', '');
        }elseif (empty($plane_date)) {
            return $this->getBack('0', 'plane_date', '');
        }elseif (empty($plane_jichang1)) {
            return $this->getBack('0', 'plane_jichang1', '');
        }elseif (empty($plane_jichang2)) {
            return $this->getBack('0', 'plane_jichang2', '');
        }
        $data=[
            'plane_name' => $plane_name,
            'plane_model' => $plane_model,
            'plane_timing' => $plane_timing,
            'plane_go' => $plane_go,
            'plane_des' => $plane_des,
            'plane_start' => $plane_start,
            'plane_end' => $plane_end,
            'plane_food' => $plane_food,
            'plane_price' => $plane_price,
            'plane_jingji' => $plane_jingji,
            'plane_shangwu' => $plane_shangwu,
            'plane_toudeng' => $plane_toudeng,
            'plane_date' => $plane_date,
            'plane_jichang1' => $plane_jichang1,
            'plane_jichang2' => $plane_jichang2,
        ];

        $result = PlaneModel::where(['plane_id'=>$plane_id])->update($data);
        if($result){
            return $this->getBack('1', '修改成功', '');
        }else{
            return $this->getBack('0', '修改失败', '');
        }
    }
}
