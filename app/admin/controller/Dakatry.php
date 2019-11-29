<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\11\24 0024
 * Time: 18:33
 */
namespace  app\admin\controller;
use api\Login;
use api\Model;

class  Dakatry extends Login {
    function index(){
//        $d= new Model();
//        $d->sql_operation("select  name,company_id   workingtime");
        include_once "./app/admin/view/dakatry/index.php";
    }
    function init()
    {
        $d = new Model();
        $data = $d->sql_operation("select * from card_examine");
        if ($data) {
            $d = [];
            $d['code'] = 0;
            $d['count'] = 100;
            $d['msg'] = "";
            $d['data'] = $data;
        }
        echo json_encode($d);
    }
    function up(){

        $d= new Model();
        $id=$_POST['id'];
        $data=$d->sql_operation("update card_examine set status=1 WHERE id='$id'");
        if($data){
            $name=$this->name;
            $a=$this->company_id;
            $b=$this->user_id;
            $time=$d->sql_operation("select start  from  company WHERE id='$a' ");
            $time=$time[0]['start'];
            $time=strtotime(date($time));
            var_dump($time);
            $d->sql_operation("insert into `workingtime` (`name`,`company_id`,`start`,`user_id`) values ('$name','$a','$time','$b')");
        }

    }

    function db(){
        $d= new Model();
        $id=$_POST['id'];
        $d->sql_operation("update card_examine set status=2 WHERE id='$id'");
    }
}