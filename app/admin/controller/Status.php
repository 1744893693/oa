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
        $data=$d->sql_operation("update company set status=1 WHERE id='$id'");
//        if($data){
//            $company_name=$_POST['company_name'];
//        $d->sql_operation("insert into user  VALUES (NULL ,'$company_name') ");
//
//        }
    }

    function db(){
        $d= new Model();
        $id=$_POST['id'];
        $d->sql_operation("update company set status=2 WHERE id='$id'");
    }

    function statussc(){
        $d=new Model();
        $id=$_POST['id'];
        $d->sql_operation("delete from company WHERE id='$id'");
    }
    function updatetan(){
        $d=new Model();
        $a=$_POST['company_name'];
        $b=$_POST['legal_person'];
        $id=$_POST['id'];
        $date= $d->sql_operation("update company set company_name='$a',legal_person='$b' WHERE  id='$id'");
        return $date;
    }
    function layuia(){
        $d=new Model();
        if(!empty($_POST['send_name'])){
            $data=$d->sql_operation("select * from company where company_name like '%$_POST[send_name]%' or legal_person like '%$_POST[send_name]%' or id like '%$_POST[send_name]%'");
        }else{
            $data=$d->selects();
        }
        if(empty($data)){
            $data=$d->selects();
        }
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
//    function  ye(){
//        $d=new Model();
//        $date=$d->selects();
//        $page=$_GET['page'];
//        $limit=$_GET['limit'];
//        $data['data']=$date->limit($limit*($page-1),$limit)
//
//        $data['msg']='jjjj';
//        $data['code']=0;
//        $data['count']=count($date);
//        return  $data;
//    }
}