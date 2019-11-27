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
        $account=trim($_POST['account']);
        if(!$company_name == ''){
            if(!$username == ''){
                if(!$account == ''){
                    $data = ( new Model())->sql_operation("insert into company ( legal_person,company_name,account)VALUES ('$username','$company_name','$account')");
                     echo json_encode($data);
                }
            }
        }
    }
}
