<?php

namespace App\Http\Controllers\Index;

use App\Model\OpinionModel;
use App\Model\PlaneModel;
use App\Model\POrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaneController extends Controller
{

    /**
     * @return false|mixed|string
     */
    public function plane(){
        $plane = PlaneModel::get();
        if($plane){
            return $this->getBack('1','全部航班信息',$plane);
        }else{
            return $this->getBack('0','获取失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function selPlane(Request $request){
        $data = $request->post();

        $plane_go = !empty($data['plane_go']) ? $data['plane_go'] : '';                  //地点
        $plane_des = !empty($data['plane_des']) ? $data['plane_des'] : '';                  //地点
        $plane_date = !empty($data['plane_date']) ? $data['plane_date'] : '';                  //时间


        if (empty($plane_go)) {
            return $this->getBack('0', '地点', '');
        }elseif (empty($plane_des)){
            return $this->getBack('0', '地点', '');
        }elseif (empty($plane_date)){
            return $this->getBack('0', '时间', '');
        }

        $where=[
            'plane_go'=>$plane_go,
            'plane_des'=>$plane_des,
            'plane_date'=>$plane_date,
        ];


        $plane = PlaneModel::where($where)->get();
        if($plane){
            return $this->getBack('1','筛选航班',$plane);
        }else{
            return $this->getBack('0','获取失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function addPlaneOrder(Request $request){
        $data = $request->post();

        $plane_id = !empty($data['plane_id']) ? $data['plane_id'] : '';
        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';
        $po_name = !empty($data['po_name']) ? $data['po_name'] : '';
        $po_tel = !empty($data['po_tel']) ? $data['po_tel'] : '';
        $po_number = !empty($data['po_number']) ? $data['po_number'] : '';
        $po_price = !empty($data['po_price']) ? $data['po_price'] : '';
        $po_type = !empty($data['po_type']) ? $data['po_type'] : '';
        $po_num = !empty($data['po_num']) ? $data['po_num'] : '';
        $po_state = !empty($data['po_state']) ? $data['po_state'] : '';
        $po_time = !empty($data['po_time']) ? $data['po_time'] : '';


        if (empty($plane_id)) {
            return $this->getBack('0', '地点', '');
        }elseif (empty($user_id)){
            return $this->getBack('0', '地点', '');
        }elseif (empty($po_name)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_tel)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_number)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_price)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_type)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_num)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_state)){
            return $this->getBack('0', '时间', '');
        }elseif (empty($po_time)){
            return $this->getBack('0', '时间', '');
        }

        $data = [
            'plane_id'=> $plane_id,
            'user_id'=> $user_id,
            'po_name'=> $po_name,
            'po_tel'=> $po_tel,
            'po_number'=> $po_number,
            'po_price'=> $po_price,
            'po_type'=> $po_type,
            'po_num'=> $po_num,
            'po_state'=> $po_state,
            'po_time'=> $po_time,
        ];


        $result = POrderModel::insertGetId($data);

        if($result){
            return $this->getBack('1','创建成功!',$result);
        }else{
            return $this->getBack('2','创建失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function userPlane(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';
        if (empty($user_id)){
            return $this->getBack('0', '无此用户', '');
        }

        $result = POrderModel::where(['user_id'=>$user_id])->get();

        foreach($result as $key=>$value){
            $result['plane'] = PlaneModel::where(['plane_id'=>$value['plane_id']])->select('plane_name','plane_start','plane_end','plane_date')->first();
        }

        if($result){
            return $this->getBack('1','用户航班信息',$result);
        }else{
            return $this->getBack('2','失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function planeOrderDetail(Request $request){
        $data = $request->post();

        $porder_id = !empty($data['porder_id']) ? $data['porder_id'] : '';
        if (empty($porder_id)){
            return $this->getBack('0', '无此订单', '');
        }
        $porder = POrderModel::where(['po_id'=>$porder_id])->first()->toArray();
        $plane = PlaneModel::where(['plane_id'=>$porder['plane_id']])->first();
        $porder['plane'] = $plane;


        if($porder){
            return $this->getBack('1','用户航班信息',$porder);
        }else{
            return $this->getBack('2','失败','');
        }
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     */
    public function addOpinion(Request $request){
        $data = $request->post();

        $user_id = !empty($data['user_id']) ? $data['user_id'] : '';
        $op_content = !empty($data['op_content']) ? $data['op_content'] : '';
        $op_time = !empty($data['op_time']) ? $data['op_time'] : '';
        if (empty($user_id)){
            return $this->getBack('0', '意见id', '');
        }elseif (empty($op_content)){
            return $this->getBack('0', '提交时间', '');
        }elseif (empty($op_time)){
            return $this->getBack('0', '意见内容', '');
        }

        $data = [
            'user_id'=> $user_id,
            'op_time'=> $op_time,
            'op_content'=> $op_content,
        ];


        $result = OpinionModel::insertGetId($data);

        if($result){
            return $this->getBack('1','提交反馈成功!',$result);
        }else{
            return $this->getBack('2','提交失败','');
        }
    }

    public function planeDetail(Request $request){
        $data = $request->post();

        $plane_id = !empty($data['plane_id']) ? $data['plane_id'] : '';
        if (empty($plane_id)){
            return $this->getBack('0', '航班id', '');
        }

        $plane = PlaneModel::where(['plane_id'=>$plane_id])->first();
        if($plane){
            return $this->getBack('1','获取成功',$plane);
        }else{
            return $this->getBack('0','获取失败','');
        }

    }
}
