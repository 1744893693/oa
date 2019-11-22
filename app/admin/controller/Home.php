<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/8
 * Time: 13:12
 */
namespace app\admin\controller;


use api\Login;
use api\Model;
use app\admin\model\Menu;

class Home extends Login
{
    function init(){
        include_once './app/admin/view/home/init.php';
    }
    function menu(){
        $data=(new Menu())->init();
        echo json_encode($data);

    }
    function out(){
        session_destroy();
    }
    function company(){
        $id=$_POST['id'];
        $data=new Model();
        $data=$data->sql_operation("select * from company where id = '$id'");
        echo json_encode($data);
    }
}