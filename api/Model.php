<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/11
 * Time: 11:18
 */
namespace api;
class Model
{
    public $connect;
    function __construct()
    {
        $data=new \mysqli('127.0.0.1','root','root','oa');
        $data->query('set names utf8');
        $this->connect=$data;
    }
    function select($table){
        $data=$this->connect->query('select * from '.$table );
        $date=[];
        while ($val=mysqli_fetch_assoc($data)){
            $date[]=$val;
        }
        return $date;
    }

}