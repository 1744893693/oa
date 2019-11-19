<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 17:16
 */
namespace app\admin\controller;
use app\admin\model\Menu;

class Employees{
    function init(){
        include_once './app/admin/view/employees/init.php';
    }
    function employees(){
        $aa = new Menu();
        $data = $aa->employ();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
}