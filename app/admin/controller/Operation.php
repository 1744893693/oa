<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 15:28
 */
namespace app\admin\controller;
use api\Model;

class Operation{
    function init(){
        include_once './app/admin/view/operation/init.php';
    }
    function operation(){
        $aa = new Model();
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id like '%$_GET[send_name]%'");
        }else{
            $data=$aa->operation();
        }
        if(empty($data)){
            $data=$aa->operation();
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
        $aa->sql_operation("update operation set audit=2 where id=$id");
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update operation set audit=1 where id=$id");
    }




}