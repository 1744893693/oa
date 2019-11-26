<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 10:25
 */

namespace app\admin\controller;


use api\Login;
use api\Model;

class menu extends Login
{
     function init(){
         $id=$_SESSION['admin']['company_id'];
         $d=new Model();
         if($id!=3){
             $date['menu']=$d->sql_operation("select menu.id,menu.`name` as menu_name from menu WHERE id!=12");
         }else{
             $date['menu']=$d->sql_operation("select menu.id,menu.`name` as menu_name from menu");
         }
         $date['department']=$d->sql_operation("select department.id,department.`name` as department_name from 
                                  company LEFT JOIN department on company.id=department.company_id WHERE company.id=$id");
         include_once './app/admin/view/menu/init.php';
     }
     function menu_list(){
         $id=$_SESSION['admin']['company_id'];
         $limit = $_GET['limit'];
         $page = $_GET['page'];
         $start = ($page-1)*$limit;
         $d=new Model();
         $date=$d->sql_operation("select functional_group.id,menu.`name` as menu_name,department.`name` as department_name from 
                                  company LEFT JOIN functional_group on company.id = functional_group.company_id LEFT 
                                  JOIN menu on functional_group.menu_id=menu.id LEFT JOIN department on 
                                  functional_group.department_id=department.id WHERE company.id=$id");
         $data=$d->sql_operation("select functional_group.id,menu.`name` as menu_name,functional_group.department_id,department.`name` as department_name from 
                                  company LEFT JOIN functional_group on company.id = functional_group.company_id LEFT 
                                  JOIN menu on functional_group.menu_id=menu.id LEFT JOIN department on 
                                  functional_group.department_id=department.id WHERE company.id=$id limit $start,$limit");
                                 
        
             $d=[];
             $d['code']=0;
             $d['count']=count($date);
             $d['msg']="";
             $d['data']=$data;
       
         echo json_encode($d);
     }
     function add_menu(){
         $mid=$_POST['menu_id'];
         $did=$_POST['department_id'];
         $mmame=$_POST['mmame'];
         $cid=$_SESSION['admin']['company_id'];
         $d=new Model();
         $data=$d->sql_operation("select menu.name from functional_group left JOIN menu on functional_group.menu_id =menu.id
                                   WHERE functional_group.menu_id=$mid and functional_group.company_id=$this->company_id");
         if($data) exit($data[0]['name'].'功能已经存在，请不要重复添加！') ;
         $data=$d->sql_operation("insert into functional_group VALUES (NULL,$mid ,0,$did,$cid)");
         if($data) exit($mmame.'功能添加成功') ;
         else exit($mmame.'功能添加出错') ;

     }
     function del(){
         $id=$_POST['id'];
         $d=new Model();
         $data=$d->sql_operation("delete from functional_group WHERE id=$id");
         echo $data;
     }
     function edit(){
         $id=$_POST['id'];
         $did=$_POST['did'];
         $d=new Model();
         $data=$d->sql_operation("update functional_group set department_id=$did WHERE id=$id");
         echo $data;
     }
}