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
    function update1($a){
        $data=$this->connect->query('update company set status=1 WHERE id='.$a.'');
        return $data;
    }
    function update0($a){
        $data=$this->connect->query('update company set status=0 WHERE id='.$a.'');
        return $data;
    }

    function positionc(){
        $data=$this->connect->query('select * from position');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function  positionsc($a){
        $data=$this->connect->query(  "delete from position WHERE id='.$a.'");
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $data;
    }

}