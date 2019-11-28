<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/27
 * Time: 16:23
 */

namespace app\admin\controller;


use api\Login;
use api\Model;

class Assets extends Login
{
     function init(){
         include_once './app/admin/view/assets/init.php';
     }
     function wallet(){
         $d=new Model();
         $data=$d->sql_operation("select id,late_money,obsent_money,wallet from company WHERE id=$this->company_id");

         echo json_encode($data[0]);
     }
     function update_w(){
         $d=new Model();
         $wa=$_POST['wallet'];
         $data=$d->sql_operation("select wallet from company WHERE id=$this->company_id");
         $w=$data[0]['wallet'];
         $wa=$w+$wa;
         $data=$d->sql_operation("update company set wallet=$wa where id=$this->company_id");
         echo $data;
     }
    function update_l(){
        $d=new Model();
        $wa=$_POST['late'];
        $data=$d->sql_operation("update company set late_money=$wa where id=$this->company_id");
        echo $data;
    }
    function update_o(){
        $d=new Model();
        $wa=$_POST['obsent'];
        $data=$d->sql_operation("update company set obsent_money=$wa where id=$this->company_id");
        echo $data;
    }
}