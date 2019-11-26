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
        if(empty($start_time)||empty($end_time)){
            exit(json_encode(array('v'=>201,'data'=>'时间不能为空！')));
        }
        if(empty($reason)){
            exit(json_encode(array('v'=>202,'data'=>'请说明请假原因！')));
        }
        $v = $aa->sql_operation("insert into operation (name,start_time,end_time,approver,type,reason ) VALUES  ( '$name','$start_time','$end_time','$approver','$type','$reason')");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'请等待审批！')));
        }else{
            exit(json_encode(array('v'=>0,'data'=>'请重新申请！')));
        }
    }
    function delete(){
        $aa = new Model();
        $v= $aa->sql_operation("delete from operation");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'清除成功！'))) ;
        }else{
            exit(json_encode(array('v'=>0,'data'=>'清除失败！'))) ;
        }
    }


}