<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/9
 * Time: 16:30
 */

namespace app\admin\model;
use \api\Model;
class menu{
    function init(){
        $data['department']=(new Model())->select('department');
        $data['menu']=(new Model())->select('menu');
        return $data;
    }
    function log($sql){
        $d =  new \mysqli('106.54.76.194','blog','root321.','oa');
        $s = $d->query('set name utf8');
        $s = $d->query($sql);
        $data=[];
        while ($da=mysqli_fetch_assoc($s)){
            $data[]=$da;
        }
        $d->close();

        return $data;
    }

    function permi(){
        $d =  new \mysqli('106.54.76.194','blog','root321.','oa');
        $s = $d->query('set name utf8');
        $s = $d->query('select * from permissions');
        $data=[];
        while ($da=mysqli_fetch_assoc($s)){
            $data[]=$da;
        }
        $d->close();
        return $data;
    }

}