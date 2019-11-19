<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 11:22
 */
namespace app\admin\controller;
use api\Model;

class  status
{
    function company()
    {
        $d=new Model();
        $data=$d->selects();

        include_once './app/admin/view/status/company.php';
    }
    function up(){

        $d=new Model();
        $d->update1($_GET['id']);
      header('Location:http://127.0.0.1/oa/?s=admin/status/company');
    }

    function du(){
        $d=new Model();
        $d->update0($_GET['id']);
        header('Location:http://127.0.0.1/oa/?s=admin/status/company');
    }



    function layuia(){

        $d=new Model();
        $data=$d->selects();
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