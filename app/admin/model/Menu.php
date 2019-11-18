<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/9
 * Time: 16:30
 */

namespace app\admin\model;
use \api\Model;
class menu
{
    function init(){

        $data['department']=(new Model())->select('department');
        $data['menu']=(new Model())->select('menu');
//        $data['user']=(new Model())->selectOne('user,shen');

        return $data;
    }

}