<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 16:22
 */
namespace app\admin\controller;

use api\Model;

class Department{
    function init(){
        include_once './app/admin/view/department/init.php';
    }
    function select(){
        $data=( new Model())->sql_operation('select * from department');
        foreach ($data as $k=>$v){
            $data[$k]['ip']=$k+1;
        }
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
        $data=(new Model())->sql_operation("delete from department WHERE id='$id'");
        //var_dump($data);
    }
    function update(){
        $id=$_POST['id'];
        $data=(new Model())->sql_operation("update department set id='$id'");
        //var_dump($data);
    }


}