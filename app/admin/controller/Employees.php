<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 17:16
 */
namespace app\admin\controller;
use api\Login;
use api\Model;
use app\admin\model\Menu;

class Employees extends Login {
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
    function employee(){
        $d=new Model();
        $id=$_POST['id'];
        $d->sql_operation("delete from uesr WHERE id='$id'");
    }
    function em_update(){
//        $d=new Model();
//        $id=$_POST['id'];
//        $name=$_POST['name'];
//        $d->sql_operation("update  uesr set WHERE id='$name'");
    }
}