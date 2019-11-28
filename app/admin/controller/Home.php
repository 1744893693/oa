<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/8
 * Time: 13:12
 */
namespace app\admin\controller;


use api\Login;
use api\Model;
use app\admin\model\Menu;

class Home extends Login
{
    function init(){
        include_once './app/admin/view/home/init.php';
    }
    function menu(){
        $user_id=$this->user_id;
//        $permission_id=$this->permission_id;
        $permission_id=$_SESSION['admin']['permissions_id'];
        $d=new Model();
        $data['company']=$d->sql_operation('select company_name from company WHERE id='.$this->company_id);
        if($permission_id==0){
            $data['department']=$d->sql_operation('select department.id as department_id,department.`name`as department_name from functional_group LEFT 
                 JOIN menu on functional_group.menu_id=menu.id LEFT JOIN department on functional_group.department_id
                 =department.id WHERE functional_group.company_id='.$this->company_id.' GROUP BY functional_group.department_id');
            $data['menu']=$d->sql_operation('select functional_group.department_id,functional_group.menu_id,menu.`name` as menu_name,menu.method from 
             functional_group LEFT JOIN
              menu on functional_group.menu_id
            =menu.id LEFT JOIN department on menu.department_id=department.id WHERE functional_group.company_id='.$this->company_id);
            exit (json_encode($data));
        }

        $data['department']=$d->sql_operation('select department.id as department_id,department.`name` as department_name from user LEFT JOIN permission_group on `user`.id =permission_group.user_id LEFT JOIN 
functional_group on permission_group.functional_group_id=functional_group.id LEFT JOIN department 
on functional_group.department_id=department.id WHERE `user`.id='.$user_id.' GROUP BY department.id');
        $data['menu']=$d->sql_operation('select functional_group.department_id,functional_group.menu_id,menu.`name` as menu_name,menu.method from user LEFT JOIN 
            company on `user`.company_id=company.id LEFT JOIN permission_group on `user`.id=permission_group.user_id LEFT JOIN 
            functional_group on permission_group.functional_group_id=functional_group.id LEFT JOIN menu on functional_group.menu_id
            =menu.id LEFT JOIN department on menu.department_id=department.id WHERE `user`.id='.$user_id);
        echo json_encode($data);

    }
    function out(){
        session_destroy();
    }
    function company(){
        $id=$_POST['id'];
        $data=new Model();
        $data=$data->sql_operation("select * from company where id = '$id'");
        echo json_encode($data);
    }
}