<?php

namespace App\Http\Controllers\Admin;

use App\Model\YouJiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YouJiController extends Controller
{
    public function index(){
        $data = YouJiModel::get();
        return $this->getBack('1','OK',$data);
    }

    public function update(Request $request){
        $data = $request->post();

        $yj_id = !empty($data['yj_id']) ? $data['yj_id'] : '';          //
        if (empty($yj_id)) {
            return $this->getBack('0', 'yj_id', '');
        }

        $is_tj = YouJiModel::where(['yj_id'=>$yj_id])->first();
        $is_tj = empty($is_tj) ? array():$is_tj->toArray();

        if($is_tj['is_tj']=='2'){
            $is_tj = '1';
        }else{
            $is_tj = '2';
        }

        $result = YouJiModel::where(['yj_id'=>$yj_id])->update(['is_tj'=>$is_tj]);
        if($result){
            return $this->getBack('1', '成功', '');
        }else{
            return $this->getBack('0', '失败', '');
        }
    }
}
