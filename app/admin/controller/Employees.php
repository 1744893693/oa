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
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $data = new Model();
        $news = ($page-1)*$limit;
        $sousuo = $_GET['send_name'];
        if(!empty($sousuo)){
            $d =   $data->sql_operation("select * from user where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' limit $news,$limit ");
            $s =   $data->sql_operation("select * from user where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' ");
        }else if(empty($sousuo)){
            $d =$data->sql_operation("select * from user where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' limit $news,$limit ");
            $s =$data->sql_operation("select * from user where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]'");
        }
        if($d){
            $msg = [];
            $msg['code'] =0;//状态码
            $msg['count'] = count($s);//数据集
            $msg['data'] = $d;//内容数据
        }else{
            $msg = [];
            $msg['code'] =0;//状态码
            $msg['count'] =[];//数据集
            $msg['data'] = [];//内容数据
        }
        echo json_encode($msg);
//        $d=new Model();
//        if(!empty($_GET['send_name'])){
//            $data=$d->sql_operation("select * from user where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]'");
//        }else{
//            $data=$d->employee();
//        }
//        if(empty($data)){
//            $data=$d->employee();
//        }
//        if($data){
//            $d=[];
//            $d['code']=0;
//            $d['count']=count($data);
//            $d['msg']="";
//            $d['data']=$data;
//        }
//        echo json_encode($d);
    }
    function employee(){
        $d=new Model();
        $name=$_POST['name'];
        $data = $d->sql_operation("delete from user WHERE name='$name'");
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
        $department_id=$_POST['department_id'];
        $company_id=$_POST['company_id'];
        $permissions_id=$_POST['permissions_id'];
        $permissions_group_id=$_POST['permissions_group_id'];
        $type = $d->sql_operation("insert into user values (null,'$name','$pwd','$department_id','$company_id','$permissions_id','$permissions_group_id')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'添加成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'添加失败！')) ;
        }
    }
}