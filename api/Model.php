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

        $g=$_SESSION['admin']['company_id'];
        $data=$this->connect->query('SELECT position.id,position_name,department.id as department_id,department.name
        from position LEFT JOIN department ON  department.id=position.department_id WHERE department.company_id='.$g);
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
    function operation(){
        $data=$this->connect->query('select * from operation');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }


    function selectsearch(){
        $as=$_SESSION['admin']['company_id'];
        $data=$this->connect->query('select * from department where company_id= '.$as );
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }

    function test(){
        $data=$this->connect->query('select * from test');

        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function department(){
        $data=$this->connect->query('select * from department');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function logistic(){
        $data=$this->connect->query('select * from logistic');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }
    function warehous(){
        $data=$this->connect->query('select * from warehous');
        $dat=[];
        while ($d=mysqli_fetch_assoc($data)){
            $dat[]=$d;
        }
        return $dat;
    }

}