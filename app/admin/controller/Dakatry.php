<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\11\24 0024
 * Time: 18:33
 */
namespace  app\admin\controller;
use api\Model;

class  Dakatry{
    function index(){
        include_once "./app/admin/view/Dakatry/index.php";
    }
    function init()
    {
        $d = new Model();
        $data = $d->sql_operation("select * from card_examine");
        if ($data) {
            $d = [];
            $d['code'] = 0;
            $d['count'] = 100;
            $d['msg'] = "";
            $d['data'] = $data;
        }
        echo json_encode($d);
    }
    function up(){
        $d= new Model();
        $id=$_POST['id'];
        $d->sql_operation("update card_examine set status=1 WHERE id='$id'");

    }

    function db(){
        $d= new Model();
        $id=$_POST['id'];
        $d->sql_operation("update card_examine set status=2 WHERE id='$id'");
    }
}