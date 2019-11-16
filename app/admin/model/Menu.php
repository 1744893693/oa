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
        $data=(new Model())->select('menu');
        return $data;
    }
}