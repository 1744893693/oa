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
        $d=new Model();
        if(!empty($_POST['send_name'])){
            $data=$d->sql_operation("select * from user where name like '%$_POST[send_name]%'  or id ='$_POST[send_name]'");
        }else{
            $data=$d->employee();
        }
        if(empty($data)){
            $data=$d->employee();
        }
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
//    function fenye(){
//        $d=new Model();
//        $page = $_GET['page'];
//        $limit = $_GET['limit'];
//        $aa = ($limit*($page-1));
//        $da = $d->sql_operation("select * from user limit  $aa,$limit");
//        $bb = $d->sql_operation("select * from user ");
//        if($bb){
//        $d=[];
//        $d['code']=0;
//        $d['count']=count($bb);
//        $d['msg']="";
//        $d['data']=$da;
//        echo json_encode($d);
//    }
//}
    function employee(){
        $d=new Model();
        $id=$_POST['id'];
        $data = $d->sql_operation("delete from user WHERE id='$id'");
        if($data){
            echo json_encode(array('type' => 1, 'data' =>'删除成功！'));
        }else{
            echo json_encode(array('type' => 0, 'data' =>'删除失败！'));
        }
    }
    function em_update(){
        $d=new Model();
        $id=$_POST['id'];
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $company_id=$_POST['company_id'];
        $ba = $d->sql_operation("update user set name='$name',pwd='$pwd',company_id='$company_id' where id='$id'");
        if($ba){
           echo json_encode(array('type' => 1, 'data' =>'修改成功！')) ;
        }else{
           echo json_encode(array('type' => 0, 'data' =>'修改失败！'));
        }
    }
    function em_insert(){
        $d=new Model();
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $company_id=$_POST['company_id'];
        $permissions_id=$_POST['permissions_id'];
        $permissions_group_id=$_POST['permissions_group_id'];
        $type = $d->sql_operation("insert into user values (null,'$name','$pwd','$company_id','$permissions_id','$permissions_group_id')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'添加成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'添加失败！')) ;
        }
    }
}