<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 11:22
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class  Status extends Login
{
    function company()
    {
        $d=new Model();
        $data=$d->selects();
        include_once './app/admin/view/status/company.php';
    }

    function up(){
        $d= new Model();
        $account=$_POST['account'];
        $id=$_POST['id'];
        $da=$d->sql_operation("select * from user WHERE company_id=$id and permissions_id='0'");
        if(!empty($da)){
            exit($account.'已经注册成功');
        }
        $d->sql_operation("update company set status=1 WHERE id='$id'");
        $d->sql_operation("insert into user (name,pwd,company_id,permissions_id) VALUES ('$account','111111',$id,'0')");
        $d->sql_operation("insert into department (name,company_id) VALUES ('人事部',$id)");
//        $d->sql_operation("insert into department (name,company_id) VALUES ('个人中心',$id)");
        $da=$d->sql_operation("select id from department WHERE company_id=$id ");
        $da=$da[0]['id'];
//        $d->sql_operation("insert into functional_group (menu_id,department_id,company_id) VALUES (9 ,$da,'$id')");
        $d->sql_operation("insert into functional_group (menu_id,department_id,company_id) VALUES (18 ,$da,$id)");
        exit($account.'已经注册成功');
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
}