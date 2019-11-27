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

class Apply extends   Login {
    function init(){
        $aa = new Model();
        $date['department']=$aa->sql_operation('select * from department where department.company_id='.$this->company_id);
        $date['warehous']=$aa->sql_operation('select * from warehous ');
        include_once './app/admin/view/apply/init.php';
    }
    function apply(){
        $aa = new Model();
        $data = $aa->sql_operation("select * from logistic");
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function apply_insert(){
        $aa = new Model();
        $apply_name = $_POST['apply_name'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $apply_time = $_POST['apply_time'];
        $reason = $_POST['reason'];
        $company_id=$_SESSION['admin']['company_id'];
        $department_id= $_POST['department_id'];

        $b = $aa->sql_operation("select id,name,number from warehous where id='$name' ");
        $p=$b[0]['name'];

        $o= $aa->sql_operation("select name from department where id='$department_id' ");
        $oo=$o[0]['name'];

        $wnumber = $b[0]['number'];
        if($number>$wnumber){
            exit(json_encode(array('v'=>203,'data'=>'有病蛮，哪有那么多东西，你申请个莫子！')));
        }
        if(empty($apply_time)){
            exit(json_encode(array('v'=>201,'data'=>'时间都不填蛮！')));
        }
        if(empty($reason)){
            exit(json_encode(array('v'=>202,'data'=>'亲！你为啥子要申请蛮？')));
        }
        $v = $aa->sql_operation("insert into logistic (apply_name,name,number,apply_time,reason,company_id,warehous_id ,department_id) VALUES  ('$apply_name', '$p','$number','$apply_time','$reason','$company_id','$name','$oo')");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'等到起！')));
        }else{
            exit(json_encode(array('v'=>0,'data'=>'写的啥子哦？重新写！')));
        }
    }
    function delete(){
        $aa = new Model();
        $v= $aa->sql_operation("delete from logistic");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'清除成功！'))) ;
        }else{
            exit(json_encode(array('v'=>0,'data'=>'清除失败！'))) ;
        }
    }

}