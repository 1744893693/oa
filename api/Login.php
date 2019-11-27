<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 15:43
 */

namespace api;


class Login
{
    public $company_id;
    public $user_id;
    public $permission_id;
     function __construct()
     {
         session_start();
         if(!$_SESSION['admin']){
             header('Location: ./');
         }
         $this->company_id=$_SESSION['admin']['company_id'];
         $this->user_id=$_SESSION['admin']['id'];
         $this->permission=$_SESSION['admin']['permissions_id'];
         $this->company_id=$_SESSION['admin']['company_id'];
         $this->name=$_SESSION['admin']['name'];
     }
     function out(){
         session_destroy();
     }
}