<?php

namespace App\Http\Controllers\Index;

use App\Model\CityTModel;
use App\Model\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoutryController extends Controller
{
    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function cityDetail(Request $request){
        $data = $request->post();

        $city_id = !empty($data['city_id']) ? $data['city_id'] : '';          //城市id

        if (empty($city_id)) {
            return $this->getBack('0', '城市id', '');
        }
        $where = ['city_id'=>$city_id];
        $result = CityTModel::where($where)->first();

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
    public function countryDetail(Request $request){
        $data = $request->post();

        $country_id = !empty($data['country_id']) ? $data['country_id'] : '';          //国家id

        if (empty($country_id)) {
            return $this->getBack('0', '国家id', '');
        }
        $where = ['country_id'=>$country_id];
        $result = CountryModel::where($where)->first();

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
    public function countryHot(Request $request){
        $data = $request->post();

        $city_country = !empty($data['city_country']) ? $data['city_country'] : '';          //城市id

        if (empty($city_country)) {
            return $this->getBack('0', '城市id', '');
        }
        $where = ['city_country'=>$city_country];
        $result = CityTModel::where($where)->first();

        if($result){
            return $this->getBack('1','OK',$result);
        }else{
            return $this->getBack('0','NO','');
        }
    }
}
