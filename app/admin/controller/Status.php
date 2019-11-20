<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 11:22
 */
namespace app\admin\controller;
use api\Model;

class  status
{
    function company()
    {
        $d=new Model();
        $data=$d->selects();

        include_once './app/admin/view/status/company.php';
    }
    function up(){
   $d= new Model();
   $id=$_POST['id'];
   $d->sql_operation("update company set status=1 WHERE id='$id'");

    }

    function db(){
        $d= new Model();
        $id=$_POST['id'];
        $d->sql_operation("update company set status=0 WHERE id='$id'");

    }

    function statussc(){
        $d=new Model();
        $id=$_POST['id'];
        $d->sql_operation("delete from company WHERE id='$id'");

    }

    function layuia(){

        $d=new Model();
        $data=$d->selects();
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