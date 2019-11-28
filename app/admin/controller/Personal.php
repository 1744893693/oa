<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 20:39
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Personal extends Login {
    function init(){
        include_once './app/admin/view/personal/init.php';
    }
    function select(){
        //$date=$_SESSION['admin']['company_id'];
        $id=$_SESSION['admin']['id'];
        $data=(new Model())->sql_operation("SELECT * from  user where id=$id  ");
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=100;
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function delete(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $data=(new Model())->sql_operation("delete from user name='$name' where id='$id' ");
    }
    function update(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $intion=$_POST['intion'];
        $gender=$_POST['gender'];
        $telephone=$_POST['telephone'];
        $address=$_POST['address'];
        $data=(new Model())->sql_operation("update user set  name='$name'  where id='$id'");
        $data=(new Model())->sql_operation("update user set  pwd='$pwd'  where id='$id'");
        $data=(new Model())->sql_operation("update user set  intion='$intion'  where id='$id'");
        $data=(new Model())->sql_operation("update user set  gender='$gender'  where id='$id'");
        $data=(new Model())->sql_operation("update user set  telephone='$telephone'  where id='$id'");
        $data=(new Model())->sql_operation("update user set  address='$address'  where id='$id'");

        var_dump($data);
    }
}


