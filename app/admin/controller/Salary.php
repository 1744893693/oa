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
    public $qurey='select salary.id,salary.user_id,`user`.`name` as user_name ,department.`name` as department_name,
position.position_name,salary.* from salary LEFT JOIN user on `user`.id=salary.user_id LEFT JOIN department on 
`user`.department_id=department.id LEFT JOIN position on `user`.position_id=position.id WHERE `user`.company_id=';
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
            $d =$data->sql_operation($dd);//查找每页显示的员工
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
        $user_id=$_POST['user_id'];
        $salary=$_POST['salary'];
        $tt=date('Ymd',time());
        $data=$d->sql_operation("select wallet from company WHERE id=$this->company_id");
        $da=$d->sql_operation("select my_wallet from user WHERE id=$user_id");
        $my=$da[0]['my_wallet']+$salary;
        $wa=$data[0]['wallet']-$salary;
         $d->sql_operation("update salary set send_time='$tt' where id=$id");
         $d->sql_operation("update company set wallet='$wa' where id=$this->company_id");
         $d->sql_operation("update user set my_wallet='$my' where id=$user_id");
            echo '工资发放成功！';
    }
    function sa_insert(){
        $d=new Model();
        $base_time=$d->sql_operation('SELECT start,end,late_money,obsent_money from company WHERE id='.$this->company_id);
        $company_id=$this->company_id;
        $start_time=$base_time[0]['start'];
        $end_time=$base_time[0]['end'];
        $late_money=$base_time[0]['late_money'];
        $obsent_money=$base_time[0]['obsent_money'];
        $base_msg=$d->sql_operation('select user.id,`user`.`name`,`user`.`permissions_id`,`user`.department_id,department.`name` as department_name,`user`.position_id,position.position_name,`user`.base_salary from 
       user LEFT JOIN department on `user`.department_id=department.id LEFT JOIN position on `user`.position_id=position.id WHERE `user`.company_id='.$this->company_id);
        foreach ($base_msg as $val1){
            $time=$d->sql_operation('SELECT name,start,end from workingtime WHERE user_id='.$val1['id']);
            $late=0;
            $obsent=0;
            $daka=0;
            foreach ($time as $val2){
                $dd=date('Ym',$val2['start'])-(date('Ym',time())-1);
                if(date('Ym',$val2['start'])!=date('Ym',time())){
                    if($dd==1&&$val1['permissions_id']!=0) {
                        $aa=date('h',$val2['start']);
                        $bb=date('h',$val2['end']);
                        $status=$aa-$start_time;
                        $status1=$end_time-$bb;
                        if($status>=1&&$status<3||$status1>=1&&$status1<3){
                            $late++;
                        }elseif ($status>=3||$status1>=3){
                            $obsent++;
                        }
                        $daka++;
                    }
                }

            }
            $id=$val1['id'];
            $base_salary=$val1['base_salary'];
            $month=date('Ym',time())-1;
            $late_m=$late_money*$late;
            $obsent_m=$obsent_money*$obsent;
            $zong=-($late_m+$obsent_m);
            $bs=$zong+$base_salary;
            $sele=$d->sql_operation("select id from salary WHERE user_id=$id and `month`=$month");
            if(empty($sele[0])&&$val1['permissions_id']!=0){
                $dakacount=count($time);
                if($dakacount==0||$daka==0){
                    $obsent=30;
                    $bs=0;
                }
//                var_dump($dakacount);
                $d->sql_operation("INSERT INTO `salary` (`user_id`, `month`, `base_salary`, `other_salary`, `ready_salary`, `absenteeism`, `late`)
                VALUES ('$id','$month', '$base_salary', '$zong', '$bs','$obsent', '$late')");
            }
        }
    }
}
