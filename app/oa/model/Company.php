<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/18
 * Time: 9:28
 */
namespace app\oa\model;
use Model;
class Company
{
    public $connect;
    function __construct()
    {
        $data=new \mysqli('106.54.76.194','blog','root321.','oa');
        $data->query('set names utf8');
        $this->connect=$data;
    }

    function insert($a,$b){
        $data=$this->connect->query("INSERT INTO `company` (`company_name`, `legal_person`, `status`) VALUES ('$a','$b',0)");
        return $data;
    }
}