<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 16:22
 */
namespace app\admin\controller;
use app\admin\model\Dment;
class Department{
    function init(){
        include_once './app/admin/view/Department/init.php';
    }
    function select(){
        $data=( new Dment())->select();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($data);
        //var_dump($data);
    }


}
