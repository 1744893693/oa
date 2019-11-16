<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/8
 * Time: 13:12
 */
namespace app\admin\controller;


use app\admin\model\Menu;

class Home
{
    function init(){
        include_once './app/admin/view/home/init.php';
    }
    function menu(){
        $data=(new Menu())->init();
        echo json_encode($data);

    }
}