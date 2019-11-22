<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 9:26
 */
namespace app\admin\controller;
use api\Model;

class Register {
    function init(){
        include_once './app/admin/view/register/init.php';
    }
    function company(){
        $company_name=trim($_POST['company_name']);
        $username=trim($_POST['username']);
        $password=trim($_POST['password']);
        if(!$company_name == ''){
            if(!$username == ''){
                if(!$password == ''){
                    $data = ( new Model())->sql_operation("insert into company VALUES (null,'$company_name','$username','$password','0')");
                     echo json_encode($data);
                }
            }
        }
    }
}
