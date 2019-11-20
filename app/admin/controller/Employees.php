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
        $d->sql_operation("delete from user WHERE id='$id'");
    }
    function em_update(){
        $d=new Model();
        $id=$_POST['id'];
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $type=$_POST['type'];
        $company_id=$_POST['company_id'];
        $ba = $d->sql_operation("update  user set  type='$type', name='$name', pwd='$pwd', company_id='$company_id' where id='$id'");
        if($ba){
            exit(json_encode(array('type' => 201, 'data' =>'修改成功！'))) ;
        }else{
            exit(json_encode(array('type' => 101, 'data' =>'修改失败！'))) ;
        }

    }
}