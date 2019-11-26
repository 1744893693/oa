<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 9:45
 */

namespace app\admin\controller;

use api\Model;
use api\Login;

class Salary extends Login
{
    public $qurey='select `user`.*,department.`name` as department_name,position.position_name
                                        from user LEFT JOIN department on user.department_id=department.id 
                                        LEFT JOIN position on user.position_id=position.id where user.company_id=';
     function init(){
         include_once "./app/admin/view/salary/init.php";
     }
    function employees(){
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $company_id=$this->company_id;
        $data = new Model();
        $news = ($page-1)*$limit;
        $q=$this->qurey;
        if(!empty($_GET['send_name'])){

            $d =   $data->sql_operation($q.$company_id.' and user.name like "%'.$_GET['send_name'].'%" limit '.$news.','.$limit );
            $s =   $data->sql_operation($q.$company_id.' and user.name like "%'.$_GET['send_name'].'%"');
        }else{
            $dd=$q.$company_id.' limit '.$news.','.$limit;
            $d =$data->sql_operation("$dd");//查找每页显示的员工
            $s =$data->sql_operation($q.$company_id);//查找该公司所有的员工
        }

        $msg['code'] =0;//状态码
        $msg['count'] = count($s);//数据集
        $msg['data'] = $d;//内容数据
        echo json_encode($msg);
    }
    function employee(){
        $d=new Model();
        $id=$_POST['id'];
        $data = $d->sql_operation("delete from user WHERE id='$id'");
        if($data){
            echo json_encode(array('type' => 1, 'data' =>'删除成功！'));
        }else{
            echo json_encode(array('type' => 0, 'data' =>'删除失败！'));
        }
    }
    function em_update(){
        $d=new Model();
        $id=$_POST['id'];
        $department_id=$_POST['department_id'];
        $pwd=$_POST['pwd'];
        $position_id=$_POST['position_id'];
        $ba = $d->sql_operation("update user set pwd='$pwd',department_id='$department_id',position_id='$position_id' where id=$id");
        if($ba){
            echo json_encode(array('type' => 1, 'data' =>'修改成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'修改失败！'));
        }
    }
    function sa_insert(){
        $d=new Model();
        $base_time=$d->sql_operation('SELECT start,end,late_money,obsent_money from company WHERE id='.$this->company_id);
        $company_id=$this->company_id;
        $start_time=$base_time[0]['start'];
        $end_time=$base_time[0]['end'];
        $late_money=$base_time[0]['late_money'];
        $obsent_money=$base_time[0]['obsent_money'];
        $base_msg=$d->sql_operation('select user.id,`user`.`name`,`user`.department_id,department.`name` as department_name,`user`.position_id,position.position_name,`user`.base_salary from 
       user LEFT JOIN department on `user`.department_id=department.id LEFT JOIN position on `user`.position_id=position.id WHERE `user`.company_id='.$this->company_id);
        foreach ($base_msg as $val1){
            $time=$d->sql_operation('SELECT start,end from workingtime WHERE user_id='.$val1['id']);
            $late=0;
            $obsent=0;
            foreach ($time as $val2){
                $dd=date('Ym',$val2['start'])-(date('Ym',time())-1);
                if($dd==1) {
                    $aa=date('h',$val2['start']);
                    $bb=date('h',$val2['end']);
                    $status=$aa-$start_time;
                    $status1=$end_time-$bb;
                    if($status>=1&&$status<3||$status1>=1&&$status1<3){
                        $late++;
                    }elseif ($status>=3||$status1>=3){
                        $obsent++;
                    }
                }
            }
            $id=$val1['id'];
            $name=$val1['name'];
            $department_name=$val1['department_name'];
            $position_name=$val1['position_name'];
            $base_salary=$val1['base_salary'];
            $position_name=$val1['position_name'];
            $month=date('Ym',time())-1;
            $late_m=$late_money*$late;
            $obsent_m=$obsent_money*$obsent;
            $zong=-($late_m+$obsent_m);
            $bs=$zong+$base_salary;

            $d->sql_operation("INSERT INTO `salary` (`user_id`, `month`, `base_salary`, `other_salary`, `ready_salary`, `absenteeism`, `late`)
            VALUES ('$id','$month', '$base_salary', '$zong', '$bs','$obsent', '$late','$company_id')");



        }



//        $type = $d->sql_operation("insert into user values (null,'$name','$pwd','$department_id','$company_id','$permissions_id','$permissions_group_id','','')");
//
//        $company_id=$_SESSION['admin']['company_id'];
//        $position_id=$_POST['position_id'];
//        $type = $d->sql_operation("insert into user (name,pwd,department_id,company_id,position_id) VALUES ('$name','$pwd','$department_id','$company_id','$position_id')");
//
//        if($type){
//            echo json_encode(array('type' => 1, 'data' =>'添加成功！')) ;
//        }else{
//            echo json_encode(array('type' => 0, 'data' =>'添加失败！')) ;
//        }
    }
    function permission(){
        $id=$_POST['id'];
        $user_id=$_POST['user_id'];
        $idd=explode(',',$id);
        $d=new Model();
        $count=0;
        if($id){
            foreach ($idd as $val){
                $data=$d->sql_operation('select functional_group_id from permission_group WHERE functional_group_id='.$val.' and user_id='.$user_id);
                if(empty($data)){
                    $data=$d->sql_operation('insert into permission_group VALUES (null,'.$val.','.$user_id.')');
                    $count++;
                }
            }
        }
        if($count){
            exit('权限添加成功'.$count.'项');
        }
        $count1=$d->sql_operation('select id from permission_group WHERE user_id='.$user_id);
        if(!$id){
            $data=$d->sql_operation("delete from permission_group WHERE functional_group_id not in ('$id') and user_id=$user_id");
            exit('权限清空成功');
        }
        if($id){
            $data=$d->sql_operation('delete from permission_group WHERE functional_group_id not in ('.$id.') and user_id='.$user_id);
            exit('权限取消成功'.(count($count1)-count($idd)).'项');
        }
    }
    function permission_list(){
        $id=$_POST['id'];
        $d=new Model();
        $data=$d->sql_operation('select functional_group_id from permission_group WHERE user_id='.$id);
        echo json_encode($data);
    }
}
