<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\11\23 0023
 * Time: 16:45
 */
namespace app\admin\controller;
use api\Model;
class  Settime{

    function index(){
        include_once "./app/admin/view/settime/index.php";
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
}