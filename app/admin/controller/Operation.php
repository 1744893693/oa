<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 15:28
 */
namespace app\admin\controller;
use api\Model;

class Operation{
    function init(){
        include_once './app/admin/view/operation/init.php';
    }
    function operation(){
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $data = new Model();
        $news = ($page-1)*$limit;
        $sousuo = $_GET['send_name'];
        if(!empty($sousuo)){
            $d =   $data->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' limit $news,$limit ");
            $s =   $data->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' ");
        }else if(empty($sousuo)){
            $d =$data->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]' limit $news,$limit ");
            $s =$data->sql_operation("select * from operation where name like '%$_GET[send_name]%'  or id ='$_GET[send_name]'");
        }
        if($d){
            $msg = [];
            $msg['code'] =0;//状态码
            $msg['count'] = count($s);//数据集
            $msg['data'] = $d;//内容数据
        }else{
            $msg = [];
            $msg['code'] =0;//状态码
            $msg['count'] =[];//数据集
            $msg['data'] = [];//内容数据
        }
        echo json_encode($msg);
    }



}