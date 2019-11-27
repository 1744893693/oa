<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 10:49
 */
namespace app\admin\controller;
use api\Login;
use api\Model;
class  Journal extends Login {
    function index(){
        $c=$this->company_name;
        $b=$this->name;
        $d=new Model();
//        $array=explode(separator,$string);
        $name=$d->sql_operation("select name from workingtime WHERE name='$b'");

        $da=$d->sql_operation("select start from workingtime WHERE name='$b' ");


        include_once "./app/admin/view/journal/index.php";

    }
}