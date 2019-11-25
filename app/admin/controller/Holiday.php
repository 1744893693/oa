<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 18:18
 */
namespace app\admin\controller;
use api\Model;

class Holiday{
    function init(){
        include_once './app/admin/view/holiday/init.php';
    }
    function holiday(){
        $aa = new Model();
        $data = $aa->operation();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
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
        $audit= $_POST['audit'];
        $data = $aa->sql_operation("insert into operation VALUES (NULL ,'$name','$start_time','$end_time','$approver','$type','$reason','$audit')");
        echo json_encode($data);
    }


}