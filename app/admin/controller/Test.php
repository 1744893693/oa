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
        $aa = new Model();
        $date['department']=$aa->sql_operation('select * from department ');
        include_once "./app/admin/view/test/init.php";
    }
    function test(){
        $aa = new Model();
        $app =  $this->name;
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from test where  name like '%$_GET[send_name]%' or test_name like '%$_GET[send_name]%' or  department_id like '%$_GET[send_name]%' release_time like '%$_GET[send_name]%'  and name='$app' ");
        }else{
            $data=$aa->test();
        }
        if(empty($data)){
            $data=$aa->test();
        }



//        $data = $aa->sql_operation("select * from test where name='$app'");
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
        $name=$_SESSION['admin']['name'];
        $test_name = $_POST['test_name'];
        $release_time = $_POST['release_time'];
        $submission_time = $_POST['submission_time'];
        $test_content= $_POST['test_content'];
        $department_id= $_POST['department_id'];
        $company_id=$_SESSION['admin']['company_id'];
        $b = $aa->sql_operation("select name from department where id='$department_id' ");
        if(empty($test_name)||empty($release_time)){
            exit(json_encode(array('v'=>201,'data'=>'时间不能为空！')));
        }
        if(empty($test_content)){
            exit(json_encode(array('v'=>202,'data'=>'请详述任务内容！')));
        }
        if(empty($department_id)){
            exit(json_encode(array('v'=>203,'data'=>'请指定任务部门！')));
        }
        $p=$b[0]['name'];
        $v = $aa->sql_operation("insert into test (name,test_name,release_time,submission_time,test_content,department_id,company_id) 
                                 VALUES  ('$name','$test_name','$release_time','$submission_time','$test_content','$p','$company_id')");

        if($v){
            exit(json_encode(array('v'=>1,'data'=>'请等待领取！')));
        }else{
            exit(json_encode(array('v'=>0,'data'=>'请重新发布！')));
        }
    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from test where id=$id ");
        if($b[0]['audit'] == 2){
            exit(json_encode(['type' => 201, 'data' => '已经驳回了，不用重复了，亲']));
        }
        $type = $aa->sql_operation("update test set audit=2 where id=$id");
        if($type){
            exit(json_encode(['type' => 204, 'data' => '驳回成功！']));
        }
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from test where id=$id ");
        if($b[0]['audit'] == 1){
            exit(json_encode(['type' => 202, 'data' => '已经接收了，你想要接受几次蛮！']));
        }
        $type = $aa->sql_operation("update test set audit=1 where id=$id");
        if($type){
            exit(json_encode(['type' => 203, 'data' => '接收成功！']));
        }
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