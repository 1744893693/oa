<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 10:44
 */
namespace  app\admin\controller;
use api\Model;

class  Position{

    function management(){
       $d= new  Model();
       $data['department']=$d->sql_operation("select *  from department ");
//
      include_once "./app/admin/view/Position/management.php";
    }
    function  managements(){
        $d=new Model();
        $data=$d->positionc();
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function positionsc(){
        $d=new Model();
        $id=$_POST['id'];
        $d->sql_operation("delete from position WHERE id='$id'");
    }
   function updatetian (){
       $d=new Model();
       $id=$_POST['id'];
       $a=$_POST['position_name'];
       $date=$d->sql_operation("update position set position_name='$a' WHERE  id='$id'");
       echo  $date;
}
    function puls(){

        $d=new Model();
        $a=$_POST['position_name'];
        $b=$_POST['position_id'];


//        $date=$d->sql_operation("select name from department ");
//        $date=$date[0]['name'];
       $aa= $d->sql_operation("insert into position  (position_name,department_id) VALUES ('$a','$b')");

    }

}