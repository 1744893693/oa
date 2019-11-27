<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\11\23 0023
 * Time: 16:45
 */
namespace app\admin\controller;
use api\Model;
class  CompanyTime{

    function index(){
        include_once "./app/admin/view/CompanyTime/index.php";
    }
    function settime(){
        session_start();
        $id=$_SESSION["admin"]["company_id"];
        $towork=$_POST['towork'];
        $offwork=$_POST['offwork'];
        $d= new Model();
        $data=$d->sql_operation("update company set `start`='$towork',`end` ='$offwork' where `id`='$id'");
        return $data;
    }
    function  company(){
        session_start();
        $id=$_SESSION["admin"]["company_id"];
        $name=$_POST['name'];
        $d= new Model();
        $data=$d->sql_operation("update company set  company_name='$name' WHERE id='$id'");

        function person(){
            session_start();
            $id=$_SESSION["admin"]["company_id"];
            $name=$_POST['name'];
            $d= new Model();
            $data=$d->sql_operation("update company set  legal_person='$name' WHERE id='$id'");
        }
    }
}