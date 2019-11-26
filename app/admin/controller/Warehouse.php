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

class Warehouse extends Login{
    function init(){
        include_once './app/admin/view/warehouse/init.php';
    }
    function warehouse(){
        $aa = new Model();
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from warehous where name like '%$_GET[send_name]%'  ");
        }else{
            $data=$aa->warehous();
        }
        if(empty($data)){
            $data=$aa->warehous();
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
    function warehouse_insert(){
        $d=new Model();
        $name=$_POST['name'];
        $number=$_POST['number'];
        $price=$_POST['price'];
        $warehous_time=$_POST['warehous_time'];
        $type = $d->sql_operation("insert into warehous (name,number,price,warehous_time) VALUES ('$name','$number','$price','$warehous_time')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'入库成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'入库失败！')) ;
        }
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update warehous set audit=1 where id=$id");
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update warehous set audit=0 where id=$id");
    }
    function warehouse_update(){
        $d=new Model();
        $number=$_POST['number'];
        $price=$_POST['price'];
        $type = $d->sql_operation("insert into warehous (number,pricee) VALUES ('$number','$price')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'入库成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'入库失败！')) ;
        }
    }
}