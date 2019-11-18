<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./public/layui/css/layui.css" >
    <script src="./public/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body>
<h1 style=" text-align:center">OA公司注册审核</h1>
<div class="layui-btn layui-btn-lg"><a href="./?s=admin/Home/init">返回</a></div>
<br>
<table id="demo" lay-filter="test">

    <?php foreach ($data as $k=>$value){?>
    <tr>
        <?php echo $value['id']?>
    </tr>

    <tr>
        <?php echo $value['company_name']?>
    </tr>

    <?php echo $value['status']?>

    <a href="./?s=admin/status/up&id=<?php echo $value['id']?>">同意</a>
    <a href="./?s=admin/status/du&id=<?php echo $value['id']?>">否定</a>
    </tr>

<?php }?>

</table>


</body>
</html>