<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 16:39
 */
namespace app\admin\controller;
use app\admin\model\menu;

class Permission{
    function init(){
        include_once './app/admin/view/permission/init.php';
    }
    function permi(){
        $aa = new menu();
        $data = $aa->permi();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
//        echo $d;
        echo json_encode($d);
    }
}