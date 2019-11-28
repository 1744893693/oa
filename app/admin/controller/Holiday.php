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

class Holiday extends  Login {
    function init(){
        include_once './app/admin/view/holiday/init.php';
    }
    function holiday(){

        $aa = new Model();
        $app =  $this->name;
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or type like '%$_GET[send_name]%' or start_time like '%$_GET[send_name]%' and name='$app' ");
        }else{
            $data=$aa->operation();
        }
        if(empty($data)){
            $data=$aa->operation();
        }
//       $app =  $this->name;
//        $data = $aa->sql_operation("select * from operation where name='$app'");
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
        $company_id=$_SESSION['admin']['company_id'];
        if(empty($start_time)||empty($end_time)){
            exit(json_encode(array('v'=>201,'data'=>'时间都不填，你请个屁哦！')));
        }
        if(empty($reason)){
            exit(json_encode(array('v'=>202,'data'=>'原因都不写，你以为你是老板蛮！')));
        }
        $v = $aa->sql_operation("insert into operation (name,start_time,end_time,approver,type,reason,company_id ) VALUES  ( '$name','$start_time','$end_time','$approver','$type','$reason','$company_id')");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'等到起，我去看一下再说！')));
        }else{
            exit(json_encode(array('v'=>0,'data'=>'看都看不懂，重写！')));
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