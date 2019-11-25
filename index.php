<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/8
 * Time: 13:12
 */
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Chongqing");
spl_autoload_register('autoload');
function autoload($class){
   $c = strtr($class,'\\','/');
    include_once $c.'.php';
}
$route=isset($_GET['s'])?$_GET['s']:'admin/Login/init';
$route=explode('/',$route);

$controller='app\\'.$route[0].'\\controller\\'.$route[1];
$d=new $controller();
$method=$route[2];
$d->$method();




