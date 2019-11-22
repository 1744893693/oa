<?php
namespace app\admin\controller;
use api\Model;

class Department{
    function init(){
        include_once './app/admin/view/department/init.php';
    }
    function select(){
        $data=(new Model())->sql_operation("select * from department ");
        foreach ($data as $k=>$v){
            $data[]=0;
            $data[$k][]=$k+1;
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


}