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
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update logistic set audit=2 where id=$id");
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $number = $_POST['number'];
        $warehous_id = $_POST['wa'];
        $war=$aa->sql_operation("select id,number from warehous where id=$warehous_id");
        $wid = $war[0]['id'];
        $wnumber = $war[0]['number'];
       $app= $aa->sql_operation("update logistic set audit=1 where id=$id");
        if($app){
            $newwar = $wnumber-$number;
            $aa->sql_operation("update warehous set number =  '$newwar' where id =$wid");
        }
    }
}