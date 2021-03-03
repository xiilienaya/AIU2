<?php

namespace App\Http\Controllers\Admin;

use App\Model\CityTModel;
use App\Model\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index(){
        $country = CountryModel::get();
        return $this->getBack('1','OK',$country);
    }

    public function delete(Request $request){
        $data = $request->post();

        $country_id = !empty($data['country_id']) ? $data['country_id'] : '';          //城市id
        if (empty($country_id)) {
            return $this->getBack('0', 'country_id', '');
        }


        $result = CountryModel::where(['country_id'=>$country_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function countryAdd(Request $request){
        $data = $request->post();

        $name = !empty($data['name']) ? $data['name'] : '';          //城市id
        $country_name = !empty($data['country_name']) ? $data['country_name'] : '';          //城市id
        $country_ename = !empty($data['country_ename']) ? $data['country_ename'] : '';          //城市id
        $country_imgList = !empty($data['country_imgList']) ? $data['country_imgList'] : '';          //城市id
        $country_summary = !empty($data['country_summary']) ? $data['country_summary'] : '';          //城市id
        $country_traffic = !empty($data['country_traffic']) ? $data['country_traffic'] : '';          //城市id
        $country_lyTime = !empty($data['country_lyTime']) ? $data['country_lyTime'] : '';          //城市id
        $country_tips = !empty($data['country_tips']) ? $data['country_tips'] : '';          //城市id
        $country_zhuyi = !empty($data['country_zhuyi']) ? $data['country_zhuyi'] : '';          //城市id
        $country_img = !empty($data['country_img']) ? $data['country_img'] : '';          //城市id
        $country_huobi = !empty($data['country_huobi']) ? $data['country_huobi'] : '';          //城市id
        if (empty($name)) {
            return $this->getBack('0', 'name', '');
        }elseif (empty($country_name)) {
            return $this->getBack('0', 'country_name', '');
        }elseif (empty($country_ename)) {
            return $this->getBack('0', 'country_ename', '');
        }elseif (empty($country_imgList)) {
            return $this->getBack('0', 'country_imgList', '');
        }elseif (empty($country_summary)) {
            return $this->getBack('0', 'country_summary', '');
        }elseif (empty($country_traffic)) {
            return $this->getBack('0', 'country_traffic', '');
        }elseif (empty($country_lyTime)) {
            return $this->getBack('0', 'country_lyTime', '');
        }elseif (empty($country_tips)) {
            return $this->getBack('0', 'country_tips', '');
        }elseif (empty($country_zhuyi)) {
            return $this->getBack('0', 'country_zhuyi', '');
        }elseif (empty($country_img)) {
            return $this->getBack('0', 'country_img', '');
        }elseif (empty($country_huobi)) {
            return $this->getBack('0', 'country_huobi', '');
        }


        $data=[
            'name' => $name,
            'country_ename' => $country_ename,
            'country_name' => $country_name,
            'country_imgList' => $country_imgList,
            'country_img' => $country_img,
            'country_summary' => $country_summary,
            'country_traffic' => $country_traffic,
            'country_lyTime' => $country_lyTime,
            'country_tips' => $country_tips,
            'country_zhuyi' => $country_zhuyi,
            'country_huobi' => $country_huobi,
        ];


        $result = CountryModel::insertGetId($data);
        if($result){
            return $this->getBack('1', '添加成功', $result);
        }else{
            return $this->getBack('0', '添加失败', '');
        }
    }

    public function update(Request $request){
        $data = $request->post();

        $name = !empty($data['name']) ? $data['name'] : '';          //城市id
        $country_id = !empty($data['country_id']) ? $data['country_id'] : '';          //城市id
        $country_name = !empty($data['country_name']) ? $data['country_name'] : '';          //城市id
        $country_ename = !empty($data['country_ename']) ? $data['country_ename'] : '';          //城市id
        $country_imgList = !empty($data['country_imgList']) ? $data['country_imgList'] : '';          //城市id
        $country_summary = !empty($data['country_summary']) ? $data['country_summary'] : '';          //城市id
        $country_traffic = !empty($data['country_traffic']) ? $data['country_traffic'] : '';          //城市id
        $country_lyTime = !empty($data['country_lyTime']) ? $data['country_lyTime'] : '';          //城市id
        $country_tips = !empty($data['country_tips']) ? $data['country_tips'] : '';          //城市id
        $country_zhuyi = !empty($data['country_zhuyi']) ? $data['country_zhuyi'] : '';          //城市id
        $country_img = !empty($data['country_img']) ? $data['country_img'] : '';          //城市id
        if (empty($name)) {
            return $this->getBack('0', 'name', '');
        }elseif (empty($country_id)) {
            return $this->getBack('0', 'country_id', '');
        }elseif (empty($country_name)) {
            return $this->getBack('0', 'country_name', '');
        }elseif (empty($country_ename)) {
            return $this->getBack('0', 'country_ename', '');
        }elseif (empty($country_imgList)) {
            return $this->getBack('0', 'country_imgList', '');
        }elseif (empty($country_summary)) {
            return $this->getBack('0', 'country_summary', '');
        }elseif (empty($country_traffic)) {
            return $this->getBack('0', 'country_traffic', '');
        }elseif (empty($country_lyTime)) {
            return $this->getBack('0', 'country_lyTime', '');
        }elseif (empty($country_tips)) {
            return $this->getBack('0', 'country_tips', '');
        }elseif (empty($country_zhuyi)) {
            return $this->getBack('0', 'country_zhuyi', '');
        }elseif (empty($country_img)) {
            return $this->getBack('0', 'country_img', '');
        }

        $data=[
            'name' => $name,
            'country_ename' => $country_ename,
            'country_name' => $country_name,
            'country_imgList' => $country_imgList,
            'country_img' => $country_img,
            'country_summary' => $country_summary,
            'country_traffic' => $country_traffic,
            'country_lyTime' => $country_lyTime,
            'country_tips' => $country_tips,
            'country_zhuyi' => $country_zhuyi,
        ];


        $result = CountryModel::where(['country_id'=>$country_id])->update($data);
        if($result){
            return $this->getBack('1', '修改成功', '');
        }else{
            return $this->getBack('0', '修改失败', '');
        }
    }

    public function city(){
        $city = CityTModel::get();
        return $this->getBack('1','OK',$city);
    }

    public function cityDel(Request $request){
        $data = $request->post();

        $city_id = !empty($data['city_id']) ? $data['city_id'] : '';          //城市id
        if (empty($city_id)) {
            return $this->getBack('0', 'city_id', '');
        }

        $result = CityTModel::where(['city_id'=>$city_id])->delete();
        if($result){
            return $this->getBack('1', '删除成功', '');
        }else{
            return $this->getBack('0', '删除失败', '');
        }
    }

    public function cityAdd(Request $request){
        $data = $request->post();

        $city_name = !empty($data['city_name']) ? $data['city_name'] : '';          //城市id
        $name = !empty($data['name']) ? $data['name'] : '';          //城市id
        $city_ename = !empty($data['city_ename']) ? $data['city_ename'] : '';          //城市id
        $city_imgList = !empty($data['city_imgList']) ? $data['city_imgList'] : '';          //城市id
        $city_summary = !empty($data['city_summary']) ? $data['city_summary'] : '';          //城市id
        $city_lyTime = !empty($data['city_lyTime']) ? $data['city_lyTime'] : '';          //城市id
        $city_traffic = !empty($data['city_traffic']) ? $data['city_traffic'] : '';          //城市id
        $city_tips = !empty($data['city_tips']) ? $data['city_tips'] : '';          //城市id
        $city_img = !empty($data['city_img']) ? $data['city_img'] : '';          //城市id
        $city_jianjie = !empty($data['city_jianjie']) ? $data['city_jianjie'] : '';          //城市id
        $city_rate = !empty($data['city_rate']) ? $data['city_rate'] : '';          //城市id
        $city_country = !empty($data['city_country']) ? $data['city_country'] : '';          //城市id
        if (empty($name)) {
            return $this->getBack('0', 'name', '');
        } elseif (empty($city_name)) {
            return $this->getBack('0', 'city_name', '');
        }elseif (empty($city_ename)) {
            return $this->getBack('0', 'city_ename', '');
        }elseif (empty($city_imgList)) {
            return $this->getBack('0', 'city_imgList', '');
        }elseif (empty($city_summary)) {
            return $this->getBack('0', 'city_summary', '');
        }elseif (empty($city_traffic)) {
            return $this->getBack('0', 'city_traffic', '');
        }elseif (empty($city_lyTime)) {
            return $this->getBack('0', 'city_lyTime', '');
        }elseif (empty($city_tips)) {
            return $this->getBack('0', 'city_tips', '');
        }elseif (empty($city_img)) {
            return $this->getBack('0', 'city_img', '');
        }elseif (empty($city_jianjie)) {
            return $this->getBack('0', 'city_jianjie', '');
        }elseif (empty($city_rate)) {
            return $this->getBack('0', 'city_rate', '');
        }elseif (empty($city_country)) {
            return $this->getBack('0', 'city_country', '');
        }

        $data=[
            'name' => $name,
            'city_name' => $city_name,
            'city_ename' => $city_ename,
            'city_imgList' => $city_imgList,
            'city_summary' => $city_summary,
            'city_lyTime' => $city_lyTime,
            'city_tips' => $city_tips,
            'city_traffic' => $city_traffic,
            'city_img' => $city_img,
            'city_jianjie' => $city_jianjie,
            'city_rate' => $city_rate,
        ];


        $result = CityTModel::insertGetId($data);
        if($result){
            return $this->getBack('1', '添加成功', $result);
        }else{
            return $this->getBack('0', '添加失败', '');
        }
    }

    public function cityUpd(Request $request){
        $data = $request->post();

        $city_id = !empty($data['city_id']) ? $data['city_id'] : '';          //城市id
        $city_name = !empty($data['city_name']) ? $data['city_name'] : '';          //城市id
        $name = !empty($data['name']) ? $data['name'] : '';          //城市id
        $city_ename = !empty($data['city_ename']) ? $data['city_ename'] : '';          //城市id
        $city_imgList = !empty($data['city_imgList']) ? $data['city_imgList'] : '';          //城市id
        $city_summary = !empty($data['city_summary']) ? $data['city_summary'] : '';          //城市id
        $city_lyTime = !empty($data['city_lyTime']) ? $data['city_lyTime'] : '';          //城市id
        $city_traffic = !empty($data['city_traffic']) ? $data['city_traffic'] : '';          //城市id
        $city_tips = !empty($data['city_tips']) ? $data['city_tips'] : '';          //城市id
        $city_img = !empty($data['city_img']) ? $data['city_img'] : '';          //城市id
        $city_jianjie = !empty($data['city_jianjie']) ? $data['city_jianjie'] : '';          //城市id
        $city_rate = !empty($data['city_rate']) ? $data['city_rate'] : '';          //城市id
        if (empty($name)) {
            return $this->getBack('0', 'name', '');
        }elseif (empty($city_id)) {
            return $this->getBack('0', 'city_id', '');
        }elseif (empty($city_name)) {
            return $this->getBack('0', 'city_name', '');
        }elseif (empty($city_ename)) {
            return $this->getBack('0', 'city_ename', '');
        }elseif (empty($city_imgList)) {
            return $this->getBack('0', 'city_imgList', '');
        }elseif (empty($city_summary)) {
            return $this->getBack('0', 'city_summary', '');
        }elseif (empty($city_traffic)) {
            return $this->getBack('0', 'city_traffic', '');
        }elseif (empty($city_lyTime)) {
            return $this->getBack('0', 'city_lyTime', '');
        }elseif (empty($city_tips)) {
            return $this->getBack('0', 'city_tips', '');
        }elseif (empty($city_img)) {
            return $this->getBack('0', 'city_img', '');
        }elseif (empty($city_jianjie)) {
            return $this->getBack('0', 'city_jianjie', '');
        }elseif (empty($city_rate)) {
            return $this->getBack('0', 'city_rate', '');
        }

        $data=[
            'name' => $name,
            'city_name' => $city_name,
            'city_ename' => $city_ename,
            'city_imgList' => $city_imgList,
            'city_summary' => $city_summary,
            'city_lyTime' => $city_lyTime,
            'city_tips' => $city_tips,
            'city_traffic' => $city_traffic,
            'city_img' => $city_img,
            'city_jianjie' => $city_jianjie,
            'city_rate' => $city_rate,
        ];


        $result = CityTModel::where(['city_id'=>$city_id])->update($data);
        if($result){
            return $this->getBack('1', '修改成功', '');
        }else{
            return $this->getBack('0', '修改失败', '');
        }
    }
}
