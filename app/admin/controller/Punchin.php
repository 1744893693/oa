<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 15:23
 */
namespace  app\admin\controller;
use api\Model;

class Punchin{
    function  daka(){
        include_once "./app/admin/view/punchin/daka.php";
    }
    function upb (){
        session_start();
        $id=$_SESSION["admin"]["company_id"];
        $rid=$_SESSION["admin"]["id"];
        $name=$_SESSION["admin"]["name"];
        $d=new Model();
        $start= $d->sql_operation("select * from company start  where id='$id'");
        $start=$start[0]['start'];
        $aa = strtotime($start);//公司上班时间
        $time=time();
        $time_start = strtotime(date("Y-m-d 00:00:00")); //当天开始时间
        $time_end = strtotime(date("Y-m-d 23:59:59"));//当天结束时间
        $start_time= $d->sql_operation("select * from workingtime start where user_id='$rid' order by id desc limit 1");//数据库本人上班打卡时间最后一条数据
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
        session_start();
        $id=$_SESSION["admin"]["company_id"];
        $rid=$_SESSION["admin"]["id"];
        $d=new Model();
        $end= $d->sql_operation("select * from company end where id='$id'");
        $end=$end[0]['end'];
        $aa = strtotime($end);//公司下班时间
        $time=time();
        $start_time= $d->sql_operation("select * from workingtime end where user_id='$rid' order by id desc limit 1");//数据库本人下班打卡时间最后一条数据
        $start_id=$start_time[0]['id'];
        if($time > $aa){
                $d->sql_operation("UPDATE `workingtime` SET `end`='$time' WHERE id='$start_id'");
                echo json_encode(array('type'=>201,'data'=>'打卡成功'));
        }else{
            echo json_encode(array('type'=>202,'data'=>'您已早退'));
        }
    }

    function buk(){
        $name=$_POST['name'];
        $reasons=$_POST['reasons'];
        $time=date('H:i:s',time());
        $d=new Model();
        $ass = $d->sql_operation("INSERT INTO `card_examine`(`name`, `reasons`, `latetime`, `status`) VALUES ('$name','$reasons','$time',0)");
    }

}