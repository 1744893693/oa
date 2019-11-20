<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/11
 * Time: 11:18
 */
namespace api;
class Model{
    public $connect;
    function __construct(){
        $data=new \mysqli('106.54.76.194','blog','root321.','oa');
        $data->query('set names utf8');
        $this->connect=$data;
    }

    function sql_operation($sql){
        $data=$this->connect;
        $data=$data->query($sql);

        if (is_bool($data)){
            return $data;
        }else{
            $date=[];
            while ($val=mysqli_fetch_assoc($data)){
                $date[]=$val;
            }
            return $date;
        }
    }

    function select($table){
        $data=$this->connect->query('select * from '.$table );
        $date=[];
        while ($val=mysqli_fetch_assoc($data)){
            $date[]=$val;
        }
        return $date;
    }


    function selects(){

        $data=$this->connect->query('select * from company');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }

    function positionc(){
        $data=$this->connect->query('select * from position');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function employee(){
        $data=$this->connect->query('select * from user');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function permiss(){
        $data=$this->connect->query('select * from permissions');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
}