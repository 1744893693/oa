<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 8:54
 */

namespace app\admin\controller;
use api\Login;
use api\Model;

class Test extends Login{
    function init(){
        include_once "./app/admin/view/test/init.php";
    }
    function test(){
        $aa = new Model();
        $data = $aa->sql_operation("select * from test");
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);
    }
    function test_insert(){
        $aa = new Model();
        $test_name = $_POST['test_name'];
        $release_time = $_POST['release_time'];
        $submission_time = $_POST['submission_time'];
        $test_content= $_POST['test_content'];
        if(empty($test_name)||empty($release_time)){
            exit(json_encode(array('v'=>201,'data'=>'时间不能为空！')));
        }
        if(empty($test_content)){
            exit(json_encode(array('v'=>202,'data'=>'请详述任务内容！')));
        }
        $v = $aa->sql_operation("insert into test (test_name,release_time,submission_time,test_content ) VALUES  ( '$test_name','$release_time','$submission_time','$test_content')");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'请等待接收！')));
        }else{
            exit(json_encode(array('v'=>0,'data'=>'请重新发布！')));
        }
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update test set audit=2 where id=$id");
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $aa->sql_operation("update test set audit=1 where id=$id");
    }
    function delete(){
        $aa = new Model();
        $v= $aa->sql_operation("delete from test");
        if($v){
            exit(json_encode(array('v'=>1,'data'=>'清除成功！'))) ;
        }else{
            exit(json_encode(array('v'=>0,'data'=>'清除失败！'))) ;
        }
    }

}