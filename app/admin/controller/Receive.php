<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 10:31
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Receive extends Login{
    function init(){
        include_once "./app/admin/view/receive/init.php";
    }
    function receive(){
        $aa = new Model();
        $data = $aa->sql_operation("select * from test");
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function update(){
        $aa = new Model();
        $id = $_POST['id'];
        $v = $aa->sql_operation("update test set audit=3 where id=$id");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'请等待审核！')));
        }
        else{
            exit(json_encode(array('v'=>0,'data'=>'请重新提交！')));
        }
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $v = $aa->sql_operation("update test set audit=4 where id=$id");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'领取成功，请尽快完成！')));
        }
        else{
            exit(json_encode(array('v'=>0,'data'=>'请重新领取！')));
        }
    }
}