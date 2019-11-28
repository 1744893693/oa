<?php
namespace app\admin\controller;
use api\Login;
use api\Model;

class Department extends Login {
    function init(){
        $d=new Model();
        $data=$d->selectsearch();
        include_once './app/admin/view/department/init.php';
    }
//    function select(){
//        $data=(new Model())->sql_operation("select * from department ");
//        if($data){
//            $d=[];
//            $d['code']=0;
//            $d['count']=100;
//            $d['msg']="";
//            $d['data']=$data;
//        }
//        echo json_encode($d);
//    }
    function delete(){
        $id=$_POST['id'];
        $data=(new Model())->sql_operation("delete from department where id='$id'");
    }
    function update(){
        $id=$_POST['id'];
        $name=$_POST['name'];
//        var_dump($id);
//        var_dump($name);
        if(!$name == ''){
            $data=(new Model())->sql_operation("update department set  name='$name' where id='$id'");
        }
    }
    function insert(){
        $id=$_POST['id'];
        $name=$_POST['id'];
        if(!$id == ''){
                $data=(new Model())->sql_operation("insert into department (`id`,`name`,`company_id`)values('$id','$name' ,'$this->company_id')");
        }
    }
    function search(){
        $d=new Model();
        if(!empty($_POST['name'])){
            $data=$d->sql_operation("select * from department where   name like '%$_POST[name]%' AND  company_id=$this->company_id");
        }else{
            $data=$d->selectsearch();
        }
        if(empty($data)){
            $data=$d->selectsearch();
        }
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }


}