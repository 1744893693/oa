<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/29
 * Time: 8:24
 */

namespace app\admin\controller;
use api\Model;
use api\Login;

class MySalary extends Login
{
    public $qurey='select salary.id,salary.user_id,`user`.`name`,user.user_name,department.`name` as department_name,
position.position_name,salary.* from salary LEFT JOIN user on `user`.id=salary.user_id LEFT JOIN department on 
`user`.department_id=department.id LEFT JOIN position on `user`.position_id=position.id WHERE `user`.id=';

    function init(){
         include_once './app/admin/view/mySalary/init.php';
     }
    function employees(){
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $uid=$this->user_id;
        $data = new Model();
        $news = ($page-1)*$limit;
        $q=$this->qurey;
        if(!empty($_GET['send_name'])){

            $d =   $data->sql_operation($q.$uid.' and user.name like "%'.$_GET['send_name'].'%" limit '.$news.','.$limit );
            $s =   $data->sql_operation($q.$uid.' and user.name like "%'.$_GET['send_name'].'%"');
        }else{
            $dd=$q.$uid.' limit '.$news.','.$limit;
            $d =$data->sql_operation($dd);//查找每页显示的员工
            $s =$data->sql_operation($q.$uid);//查找该公司所有的员工
        }

        $msg['code'] =0;//状态码
        $msg['count'] = count($s);//数据集
        $msg['data'] = $d;//内容数据
        echo json_encode($msg);
    }
}