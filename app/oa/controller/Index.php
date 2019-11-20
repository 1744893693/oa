<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 9:26
 */
namespace app\oa\controller;
use app\oa\model\Company;
class Index {
    function init(){
        include_once './app/oa/view/index/init.php';
    }
    function company(){
        $a=$_POST['a1'];
        $b=$_POST['b2'];
        $data=( new Company())->insert($a,$b);
        echo json_encode($data);
    }
}
