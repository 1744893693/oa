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

        $app =  $this->name;
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from test where name like '%$_GET[send_name]%'  or test_name like '%$_GET[send_name]%' or  department_id like '%$_GET[send_name]%' and name='$app' ");
        }else{
            $data=$aa->test();
        }
        if(empty($data)){
            $data=$aa->test();
        }



//       $data = $aa->sql_operation("select * from test where name = '$app'");
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
        $b = $aa->sql_operation("select * from test where id=$id ");
        if($b[0]['audit'] == 3){
            exit(json_encode(['type' => 202, 'data' => '任务已提交成功，请耐心等待！']));
        }
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
        $b = $aa->sql_operation("select * from test where id=$id ");
        if($b[0]['audit'] == 4){
            exit(json_encode(['type' => 201, 'data' => '哈哈哈！你来晚了，该任务被领了！']));
        }
        $v = $aa->sql_operation("update test set audit=4 where id=$id");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'领取成功，请尽快完成！')));
        }
        else{
            exit(json_encode(array('v'=>0,'data'=>'请重新领取！')));
        }
    }
}