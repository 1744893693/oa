<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/26
 * Time: 17:50
 */
namespace app\admin\controller;
use api\Login;
use api\Model;

class Logistic extends Login{
    function init(){
        include_once './app/admin/view/logistic/init.php';
    }
    function logistic(){
        $aa = new Model();
//        $limit = $_GET['limit'];
//        $page = $_GET['page'];
//        $news = ($page - 1) * $limit;
//        limit $news,$limit
        if(!empty($_GET['send_name'])){
            $data=$aa->sql_operation("select * from logistic where name like '%$_GET[send_name]%' or apply_name  like '%$_GET[send_name]%' ");
        }else{
            $data=$aa->logistic();
        }
        if(empty($data)){
            $data=$aa->logistic();
        }
        if($data){
            $d=[];
            $d['code']=0;
            $d['count']=count($data);
            $d['msg']="";
            $d['data']=$data;
        }
        echo json_encode($d);

//        $limit = $_GET['limit'];
//        $page = $_GET['page'];
//        $news = ($page - 1) * $limit;
//        $data = new Model();
////        $uid = $_SESSION['admin'][0]['departmentId'];
//        $sousuo = $_GET['send_name'];
//
//        if(!empty($sousuo)){
//            $b = $data->query("select * from logistic where name like '%$sousuo%' or apply_name  like '%$sousuo%'  LIMIT $news,$limit ");
//            $ff = $data->query("select * from logistic where name like '%$sousuo%' or apply_name  like '%$sousuo%'");
//        }else{
//            $b = $data->query("select * from logistic where name like '%$sousuo%' or apply_name  like '%$sousuo%'  LIMIT $news,$limit ");
//            $ff = $data->query("select * from logistic where name like '%$sousuo%' or apply_name  like '%$sousuo%' ");
//        }
//        $a['code'] = 0;
//        $a['count'] = count($ff);
////        foreach ($b as $k => $v) {
////            $b[$k]['foodsApplyTimes'] = date('Y-m-d H:i:s', $v['foodsApplyTimes']);
////        }
//        $a['data'] = $b;
//        echo json_encode($a);





    }
    function update1(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from logistic where id=$id ");
        if($b[0]['audit'] == 2){
            exit(json_encode(['type' => 201, 'data' => '哦，拒绝过了，不要重复拒绝']));
        }
        $type = $aa->sql_operation("update logistic set audit=2 where id=$id");
        if($type){
            exit(json_encode(['type' => 202, 'data' => '东西才用了好久，不给！']));
        }
    }
    function update2(){
        $aa = new Model();
        $id = $_POST['id'];
        $b = $aa->sql_operation("select * from logistic where id=$id ");
        if($b[0]['audit'] == 1){
            exit(json_encode(['type' => 201, 'data' => '哦，同意过了，不要重复同意']));
        }
        $number = $_POST['number'];
        $warehous_id = $_POST['wa'];
        $war=$aa->sql_operation("select id,number from warehous where id=$warehous_id");
        $wid = $war[0]['id'];
        $wnumber = $war[0]['number'];
       $app= $aa->sql_operation("update logistic set audit=1 where id=$id");
        if($app){
            $newwar = $wnumber-$number;
            $type = $aa->sql_operation("update warehous set number =  '$newwar' where id =$wid");
            if($type){
                exit(json_encode(array('type'=>101,'data'=>'申请通过，请等待发放！'))) ;
            }
        }
    }
}