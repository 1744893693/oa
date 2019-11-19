<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/16
 * Time: 9:17
 */
namespace app\admin\controller;
use app\admin\model\Menu;
class Login{
     function init(){
         include_once './app/admin/view/login/init.php';
     }
     function login(){
         if(isset($_POST)){
         $name = trim($_POST['name']);
         $pwd = trim($_POST['pwd']);
         $yzm = trim($_POST['yzm']);
         $match = '/^[0-9a-zA-Z]{6,24}$/';

         if (!(preg_match($match, $name) || preg_match($match, $pwd))) {
             echo json_encode(array('type' => 101, 'data' => '账号或密码格式不正确！'));
             die;
         }
         if (empty($name) || empty($pwd) || empty($yzm)) {
             echo json_encode(array('type' => 102, 'data' => '账号密码或验证码不能为空！'));
             die;
         }
         else {
             session_start();
             if ($_POST['yzm'] == $_SESSION['yzm']) {
             $aa = new Menu();
             $v = $aa->log("select * from `user` where name = '".$name."'");
             if(!isset($v[0])){
                 exit(json_encode(array('type' => 106, 'data' => '账号不存在！')));
             }
             if($v[0]['pwd']!=$pwd){
                 exit(json_encode(array('type' => 105, 'data' => '密码不正确！')));
             }

             if ($v) {
                 $_SESSION['admin']=$v[0];
                 exit(json_encode(array('type' => 201, 'data' => $_SESSION['admin']['name'].'登录成功！'))) ;
             }
         }else{
                 exit(json_encode(array('type' => 104, 'data' => '验证码不正确，请重新输入！'))) ;
             }
         }
     }
     }
}