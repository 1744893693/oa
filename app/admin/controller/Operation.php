<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 15:28
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Operation extends Login {
    function init(){
        include_once './app/admin/view/operation/init.php';
    }
    function operation(){
        $aa = new Model();
        $a = $this->company_id;
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id like '%$_GET[send_name]%'");
        }else{
            $data=$aa->sql_operation("select * from operation where operation.company_id='$a'");
        }
//        if(empty($data)){
//            $data=$aa->operation();
//        }

            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;

        echo json_encode($d);
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from operation where id=$id ");
        if($b[0]['audit'] == 2){
            exit(json_encode(['type' => 202, 'data' => '已经拒绝过了！']));
        }
        $type = $aa->sql_operation("update operation set audit=2 where id=$id");
        if($type){
            exit(json_encode(['type' => 203, 'data' => '拒绝成功！']));
        }
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from operation where id=$id ");
        if($b[0]['audit'] == 1){
            exit(json_encode(['type' => 201, 'data' => '已经同意过了！']));
        }
        $type = $aa->sql_operation("update operation set audit=1 where id=$id");
        if($type){
            exit(json_encode(['type' => 204, 'data' => '同意成功！']));
        }
    }




}