<?php

namespace App\Http\Controllers\Index;

use App\Model\SpotModel;
use App\Model\CountryModel;
use App\Model\CityTModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpotController extends Controller
{
    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function spot(Request $request){
        $data = $request->post();

        $city_id = !empty($data['city_id']) ? $data['city_id'] : '';          //城市id
        if (empty($city_id)) {
            return $this->getBack('0', '城市id', '');
        }
        $where = ['spot_city'=>$city_id,'spot_status'=>'1'];


        $spot = SpotModel::where($where)->get();
        if($spot){
            return $this->getBack('1','OK',$spot);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function spotDetail(Request $request){
        $data = $request->post();

        $spot_id = !empty($data['spot_id']) ? $data['spot_id'] : '';          //景点id

        if (empty($spot_id)) {
            return $this->getBack('0', '景点id', '');
        }
        $where = ['spot_id'=>$spot_id,'spot_status'=>'1'];


        $spot = SpotModel::where(['spot_id'=>$spot_id])->first();
        if($spot){
            return $this->getBack('1','OK',$spot);
        }else{
            return $this->getBack('0','NO','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function spotHot(Request $request){
        $data = $request->post();

        $city_id = !empty($data['city_id']) ? $data['city_id'] : '';          //城市id

        if (empty($city_id)) {
            return $this->getBack('0', '城市id', '');
        }
        $where = ['spot_city'=>$city_id];


        $spot = SpotModel::where($where)->get();
        if($spot){
            return $this->getBack('1','OK',$spot);
        }else{
            return $this->getBack('0','NO','');
        }
    }
}
