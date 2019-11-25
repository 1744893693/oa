<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/25
 * Time: 10:46
 */
namespace app\admin\controller;
use api\Login;
use api\Model;


class Chat extends Login {
    function  index(){
        $id=$this->company_id;
        $d= new Model();
        $gs=$d->sql_operation("select * from company  WHERE id='$id' ");
        $gs=$gs[0]['company_name'];
       $data = $d->sql_operation("select * from company_chat WHERE company_name='$gs'");

        include_once "./app/admin/view/Chat/index.php";
    }
   function chatname(){
       $gs=$_SESSION["admin"]["company_id"];
//       $bm=$_SESSION["admin"]["department_id"];
//       $mz=$_SESSION["admin"]["name"];
////       var_dump($mz);die;
       $d= new Model();
       $data=$d->sql_operation("select * from user name WHERE company_id=$gs ");
       $data=$data[0]['name'] ;
       echo json_encode(array('type'=>200,'data'=>$data));
   }
   function  contenttj(){
       $d= new Model();
       $gs=$d->sql_operation("select * from company company_name");
       $gs=$gs[0]['company_name'];
       $content=$_POST['content'];
       $content=strip_tags($content);
       $data=$d->sql_operation("insert into company_chat (company_name,chat) VALUES ('$gs','$content')");
       var_dump($data);
   }
}