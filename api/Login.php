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
     function __construct()
     {
         session_start();
         if(!$_SESSION['admin']){

             header('Location: ./');
         }
     }
}