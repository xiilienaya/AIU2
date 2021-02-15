<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    /**
     * 跳转
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function admin(){
        return view('admin.admin.index');
    }

    public function login(){
        return view('admin.admin.login');
    }

}
