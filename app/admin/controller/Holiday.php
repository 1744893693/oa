<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 18:18
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Holiday extends   Login {
    function init(){
        include_once './app/admin/view/holiday/init.php';
    }
    function holiday(){
        $aa = new Model();
        $data = $aa->sql_operation("select * from operation");
//        $data = $aa->operation();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function holiday_insert(){

        $aa = new Model();
        $name = $_POST['name'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $approver = $_POST['approver'];
        $type = $_POST['type'];
        $reason = $_POST['reason'];
        $data = $aa->sql_operation("insert into operation (name,start_time,end_time,approver,type,reason ) VALUES  ( '$name','$start_time','$end_time','$approver','$type','$reason')");
        echo json_encode($data);
    }
    function delete(){
        $aa = new Model();
        $v= $aa->sql_operation("delete from operation");
        if($v){
            echo json_encode(array('v'=>1,'data'=>'清除成功！'));
        }else{
            echo json_encode(array('v'=>0,'data'=>'清除失败！'));
        }
    }


}