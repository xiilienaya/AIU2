<?php

namespace App\Http\Controllers\Admin;

use App\Model\HotelTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelTypeController extends Controller
{
    public function hotelTypeList(Request $request){
        $data = $request->post();

        $hotel_id = !empty($data['hotel_id']) ? $data['hotel_id'] : '';          //城市id
        if (empty($hotel_id)) {
            return $this->getBack('0', 'hotel_id', '');
        }

        $result = HotelTypeModel::where(['hotel_id'=>$hotel_id])->get();
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    public function hotelTypeDetail(Request $request){
        $data = $request->post();

        $type_id = !empty($data['type_id']) ? $data['type_id'] : '';          //城市id
        if (empty($type_id)) {
            return $this->getBack('0', 'type_id', '');
        }

        $result = HotelTypeModel::where(['type_id'=>$type_id])->first();
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    public function hotelTypeDel(Request $request){
        $data = $request->post();

        $type_id = !empty($data['type_id']) ? $data['type_id'] : '';          //城市id
        if (empty($type_id)) {
            return $this->getBack('0', 'type_id', '');
        }


        $result = HotelTypeModel::where(['type_id'=>$type_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function hotelTypeUpd(Request $request){
        $data = $request->post();

        $type_id = !empty($data['type_id']) ? $data['type_id'] : '';          //城市id
        $type_name = !empty($data['type_name']) ? $data['type_name'] : '';          //城市id
        $type_jianjie = !empty($data['type_jianjie']) ? $data['type_jianjie'] : '';
        $type_food = !empty($data['type_food']) ? $data['type_food'] : '';
        $type_yushi = !empty($data['type_yushi']) ? $data['type_yushi'] : '';
        $type_sheshi = !empty($data['type_sheshi']) ? $data['type_sheshi'] : '';
        $type_keji = !empty($data['type_keji']) ? $data['type_keji'] : '';
        $type_wifi = !empty($data['type_wifi']) ? $data['type_wifi'] : '';
        $type_bed = !empty($data['type_bed']) ? $data['type_bed'] : '';
        $type_price = !empty($data['type_price']) ? $data['type_price'] : '';
        $type_cancel = !empty($data['type_cancel']) ? $data['type_cancel'] : '';
        $type_zaocan = !empty($data['type_zaocan']) ? $data['type_zaocan'] : '';
        $type_imgList = !empty($data['type_imgList']) ? $data['type_imgList'] : '';
        if (empty($type_id)) {
            return $this->getBack('0', 'type_id', '');
        }elseif(empty($type_name)){
            return $this->getBack('0', 'type_name', '');
        }elseif(empty($type_jianjie)){
            return $this->getBack('0', 'type_jianjie', '');
        }elseif(empty($type_food)){
            return $this->getBack('0', 'type_food', '');
        }elseif(empty($type_yushi)){
            return $this->getBack('0', 'type_yushi', '');
        }elseif(empty($type_sheshi)){
            return $this->getBack('0', 'type_sheshi', '');
        }elseif(empty($type_keji)){
            return $this->getBack('0', 'type_keji', '');
        }elseif(empty($type_wifi)){
            return $this->getBack('0', 'type_wifi', '');
        }elseif(empty($type_bed)){
            return $this->getBack('0', 'type_bed', '');
        }elseif(empty($type_price)){
            return $this->getBack('0', 'type_price', '');
        }elseif(empty($type_cancel)){
            return $this->getBack('0', 'type_cancel', '');
        }elseif(empty($type_zaocan)){
            return $this->getBack('0', 'type_zaocan', '');
        }elseif(empty($type_imgList)){
            return $this->getBack('0', 'type_imgList', '');
        }

        $data=[
            'type_name'=>$type_name,
            'type_jianjie'=>$type_jianjie,
            'type_food'=>$type_food,
            'type_yushi'=>$type_yushi,
            'type_sheshi'=>$type_sheshi,
            'type_keji'=>$type_keji,
            'type_wifi'=>$type_wifi,
            'type_bed'=>$type_bed,
            'type_price'=>$type_price,
            'type_cancel'=>$type_cancel,
            'type_zaocan'=>$type_zaocan,
            'type_imgList'=>$type_imgList,
        ];

        $result = HotelTypeModel::where(['type_id'=>$type_id])->update($data);
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    public function hotelTypeAdd(Request $request){
        $data = $request->post();

        $type_name = !empty($data['type_name']) ? $data['type_name'] : '';          //城市id
        $type_jianjie = !empty($data['type_jianjie']) ? $data['type_jianjie'] : '';
        $type_food = !empty($data['type_food']) ? $data['type_food'] : '';
        $type_yushi = !empty($data['type_yushi']) ? $data['type_yushi'] : '';
        $type_sheshi = !empty($data['type_sheshi']) ? $data['type_sheshi'] : '';
        $type_keji = !empty($data['type_keji']) ? $data['type_keji'] : '';
        $type_wifi = !empty($data['type_wifi']) ? $data['type_wifi'] : '';
        $type_bed = !empty($data['type_bed']) ? $data['type_bed'] : '';
        $type_price = !empty($data['type_price']) ? $data['type_price'] : '';
        $type_cancel = !empty($data['type_cancel']) ? $data['type_cancel'] : '';
        $type_zaocan = !empty($data['type_zaocan']) ? $data['type_zaocan'] : '';
        $type_imgList = !empty($data['type_imgList']) ? $data['type_imgList'] : '';

        if(empty($type_name)){
            return $this->getBack('0', 'type_name', '');
        }elseif(empty($type_jianjie)){
            return $this->getBack('0', 'type_jianjie', '');
        }elseif(empty($type_food)){
            return $this->getBack('0', 'type_food', '');
        }elseif(empty($type_yushi)){
            return $this->getBack('0', 'type_yushi', '');
        }elseif(empty($type_sheshi)){
            return $this->getBack('0', 'type_sheshi', '');
        }elseif(empty($type_keji)){
            return $this->getBack('0', 'type_keji', '');
        }elseif(empty($type_wifi)){
            return $this->getBack('0', 'type_wifi', '');
        }elseif(empty($type_bed)){
            return $this->getBack('0', 'type_bed', '');
        }elseif(empty($type_price)){
            return $this->getBack('0', 'type_price', '');
        }elseif(empty($type_cancel)){
            return $this->getBack('0', 'type_cancel', '');
        }elseif(empty($type_zaocan)){
            return $this->getBack('0', 'type_zaocan', '');
        }elseif(empty($type_imgList)){
            return $this->getBack('0', 'type_imgList', '');
        }

        $data=[
            'type_name'=>$type_name,
            'type_jianjie'=>$type_jianjie,
            'type_food'=>$type_food,
            'type_yushi'=>$type_yushi,
            'type_sheshi'=>$type_sheshi,
            'type_keji'=>$type_keji,
            'type_wifi'=>$type_wifi,
            'type_bed'=>$type_bed,
            'type_price'=>$type_price,
            'type_cancel'=>$type_cancel,
            'type_zaocan'=>$type_zaocan,
            'type_imgList'=>$type_imgList,
        ];

        $result = HotelTypeModel::insertGetId($data);
        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }

}
