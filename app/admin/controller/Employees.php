<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 17:16
 */
namespace app\admin\controller;
use api\Login;
use api\Model;
use app\admin\model\Menu;

class Employees extends Login {
    public $qurey='select `user`.*,department.`name` as department_name,position.position_name
                                        from user LEFT JOIN department on user.department_id=department.id 
                                        LEFT JOIN position on user.position_id=position.id where user.company_id=';
    function init(){
        $d=new Model();
        $data['my_menu']=$d->sql_operation('select id,functional_group_id from permission_group WHERE user_id='.$this->user_id);
        $data['department']=$d->sql_operation('select id,name from department WHERE company_id='.$this->company_id);
        $data['menu']=$d->sql_operation('select functional_group.id as functional_group_id,functional_group.department_id,
                functional_group.menu_id,menu.`name` as menu_name from functional_group LEFT JOIN menu on
                 functional_group.menu_id=menu.id WHERE functional_group.company_id='.$this->company_id);
        include_once './app/admin/view/employees/init.php';
    }
    function employees(){
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $company_id=$_SESSION['admin']['company_id'];
        $data = new Model();
        $news = ($page-1)*$limit;
        $q=$this->qurey;

        if(!empty($_GET['send_name'])){
//            $sousuo = $_GET['send_name'];
//            var_dump($q.$company_id.' and user.name like "%'.$_GET['send_name'].'%" limit '.$news.','.$limit );
            $d =   $data->sql_operation($q.$company_id.' and user.name like "%'.$_GET['send_name'].'%" limit '.$news.','.$limit );
            $s =   $data->sql_operation($q.$company_id.' and user.name like "%'.$_GET['send_name'].'%"');
        }else{
            $dd=$q.$company_id.' limit '.$news.','.$limit;
            $d =$data->sql_operation("$dd");//查找每页显示的员工
            $s =$data->sql_operation($q.$company_id);//查找该公司所有的员工
        }

            $msg['code'] =0;//状态码
            $msg['count'] = count($s);//数据集
            $msg['data'] = $d;//内容数据
        echo json_encode($msg);
    }
    function employee(){
        $d=new Model();
        $name=$_POST['name'];
        $data = $d->sql_operation("delete from user WHERE name='$name'");
        if($data){
            echo json_encode(array('type' => 1, 'data' =>'删除成功！'));
        }else{
            echo json_encode(array('type' => 0, 'data' =>'删除失败！'));
        }
    }
    function em_update(){
        $d=new Model();
        $id=$_POST['id'];
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $company_id=$_POST['company_id'];
        $ba = $d->sql_operation("update user set name='$name',pwd='$pwd',company_id='$company_id' where id='$id'");
        if($ba){
           echo json_encode(array('type' => 1, 'data' =>'修改成功！')) ;
        }else{
           echo json_encode(array('type' => 0, 'data' =>'修改失败！'));
        }
    }
    function em_insert(){
        $d=new Model();
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $department_id=$_POST['department_id'];
        $company_id=$_POST['company_id'];
        $permissions_id=$_POST['permissions_id'];
        $permissions_group_id=$_POST['permissions_group_id'];
        $type = $d->sql_operation("insert into user values (null,'$name','$pwd','$department_id','$company_id','$permissions_id','$permissions_group_id')");
        if($type){
            echo json_encode(array('type' => 1, 'data' =>'添加成功！')) ;
        }else{
            echo json_encode(array('type' => 0, 'data' =>'添加失败！')) ;
        }
    }
    function permission(){
        $id=$_POST['id'];
        $user_id=$_POST['user_id'];
        $idd=explode(',',$id);
        $d=new Model();
        $count=0;
        foreach ($idd as $val){
            $data=$d->sql_operation('select functional_group_id from permission_group WHERE functional_group_id='.$val.' and user_id='.$user_id);
            if(empty($data)){
                $data=$d->sql_operation('insert into permission_group VALUES (null,'.$val.','.$user_id.',0)');
                $count++;
            }
        }
        if($count){
            exit('权限添加成功'.$count.'项');
        }
        $count1=$d->sql_operation('select id from permission_group WHERE user_id='.$user_id);
        if(!$id){
            $data=$d->sql_operation("delete from permission_group WHERE functional_group_id not in ('$id') and user_id=$user_id");
            exit('权限清空成功');
        }
        if($id){
            $data=$d->sql_operation('delete from permission_group WHERE functional_group_id not in ('.$id.') and user_id='.$user_id);
            exit('权限取消成功'.$count1-count($idd).'项');
        }
    }
}