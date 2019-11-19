<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/19
 * Time: 16:29
 */
namespace app\admin\model;
use Model;
class Dment
{
    function select(){
        $d =  new \mysqli('106.54.76.194','blog','root321.','oa');
        $s = $d->query('set name utf8');
        $s = $d->query('select * from department');
        $data=[];
        while ($da=mysqli_fetch_assoc($s)){
            $data[]=$da;
        }
        $d->close();
        //var_dump($data);
        return $data;

    }

}