<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 9:12
 */
session_start();
header ('Content-Type: image/png');
$im = @imagecreatetruecolor(60, 50)
or die('Cannot Initialize new GD image stream');
//$text_color = imagecolorallocate($im, 233, 14, 91);
for($i = 1; $i<=10;$i++){
    imageline($im,rand(5,15)*$i,rand(5,15),rand(20,30)*$i,rand(20,30),imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255)));
    }
$data='';
for ($i = 1; $i<=4;$i++){
    $d = rand(0,9);
    $data.=$d;
    imagestring($im,6, 5*$i*2, rand(5,15),  $d, imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255)));
}

$_SESSION['yzm']=$data;

imagepng($im);
imagedestroy($im);
