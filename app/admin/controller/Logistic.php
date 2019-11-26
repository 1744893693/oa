<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 17:50
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Logistic extends Login{
    function init(){
        include_once './app/admin/view/logistic/init.php';
    }
    function logistic(){
        $aa = new Model();
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from logistic where name like '%$_GET[send_name]%' or apply_name  like '%$_GET[send_name]%' ");
        }else{
            $data=$aa->logistic();
        }
        if(empty($data)){
            $data=$aa->logistic();
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
    function log_insert(){
        $d=new Model();
        $name=$_POST['name'];
        $number=$_POST['number'];
        $type = $d->sql_operation("insert into logistic (name,number) VALUES ('$name','$number')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'入库成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'入库失败！')) ;
        }
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update logistic set audit=2 where id=$id");
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update logistic set audit=1 where id=$id");
    }
}