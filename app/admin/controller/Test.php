<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 8:54
 */

namespace app\admin\controller;


use api\Login;

class Test extends Login
{
    function init(){
        include_once "./app/admin/view/test/init.php";
    }
}