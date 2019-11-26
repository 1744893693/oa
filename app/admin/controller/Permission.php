<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 16:39
 */
namespace app\admin\controller;
    use api\Login;
    use api\Model;
    use app\admin\model\Menu;

    class Permission extends Login {
        function init(){
            include_once './app/admin/view/permission/init.php';
        }
        function permission(){
            $aa = new Menu();
            $data = $aa->positionc();
            if($data){
                $d=[];
                $d['code']=0;
                $d['count']=count($data);
                $d['msg']="";
                $d['data']=$data;
            }
            echo json_encode($d);
        }
        function delete_permission(){
            $d=new Model();
            $id=$_POST['id'];
            $d->sql_operation("delete from position WHERE id='$id'");
        }

    }