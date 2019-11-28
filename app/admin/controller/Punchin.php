<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 15:23
 */
namespace  app\admin\controller;
use api\Login;
use api\Model;

class Punchin extends Login {
    function  daka(){

        include_once "./app/admin/view/punchin/daka.php";
    }

    function upb (){
        $id=$_SESSION["admin"]["company_id"];
        $rid=$_SESSION["admin"]["id"];
        $name=$_SESSION["admin"]["name"];
        $d=new Model();
        $start= $d->sql_operation("select * from company start  where id='$id'");
        $start=$start[0]['start'];
        $aa = strtotime($start);
        $time=time();
        $time_start = strtotime(date("Y-m-d 00:00:00"));
        $time_end = strtotime(date("Y-m-d 23:59:59"));
        $start_time= $d->sql_operation("select * from workingtime start where user_id='$rid' order by id desc limit 1");
        $start_time=$start_time[0]['start'];
        if($time_start < $start_time && $start_time < $time_end){
            echo json_encode(array('type'=>203,'data'=>'您已打卡'));
            die();
        }else{
            $d->sql_operation("insert into `workingtime` (`name`,`company_id`,`start`,`end`,`user_id`) values ('$name','$id','$time',0,'$rid')");
            echo json_encode(array('type'=>201,'data'=>'打卡成功'));
        }
        if($start_time>$aa){
            echo json_encode(array('type'=>202,'data'=>'您已迟到'));
        }
    }


    function  dbb (){

        $id=$_SESSION["admin"]["company_id"];
        $rid=$_SESSION["admin"]["id"];
        $d=new Model();
        $end= $d->sql_operation("select * from company end where id='$id'");
        $end=$end[0]['end'];
        $aa = strtotime($end);
        $time=time();
        $start_time= $d->sql_operation("select * from workingtime end where user_id='$rid' order by id desc limit 1");
        $start_id=$start_time[0]['id'];
        if($time > $aa){
                $d->sql_operation("UPDATE `workingtime` SET `end`='$time' WHERE id='$start_id'");
                echo json_encode(array('type'=>201,'data'=>'打卡成功'));
        }else{
            echo json_encode(array('type'=>202,'data'=>'您已早退'));
        }
    }

    function buk(){

        $id=$_SESSION["admin"]["company_id"];
        $name=$_POST['name'];
        $reasons=$_POST['reasons'];
        $d=new Model();
        $time=date('H:i',time());
        $gtime=$d->sql_operation("select start  from  company WHERE id='$id' ");
        if ($time>$gtime){
            echo json_encode(array('type'=>'202','data'=>'补卡申请提交失败'));
        }else{
            $d->sql_operation("INSERT INTO `card_examine`(`name`, `reasons`, `latetime`, `status`) VALUES ('$name','$reasons','$time','下班未打卡')");
            echo json_encode(array('type'=>'200','data'=>'补卡申请提交成功'));
        }
    }


    function ddd (){
        $d=new Model();

        $id=$_SESSION["admin"]["company_id"];
        $data=$d->sql_operation("select * from  workingtime WHERE company_id='$id'");
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
}


