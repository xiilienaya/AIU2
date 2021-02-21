<?php

namespace App\Http\Controllers\Index;

use App\Model\CityModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function city(){
        $city = CityModel::where(['pid'=>'7'])->get();
        if ($city){
            return $this->getBack('1','OK',$city);
        }else{
            return $this->getBack('0','NO','');
        }
    }
}
