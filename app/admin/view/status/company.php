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
<style type="text/css">
thead {color:green}
tbody {color:blue;height:50px}
tfoot {color:red}

</style>
<body>
<h1 style=" text-align:center">OA公司注册审核</h1>
<div class="layui-btn layui-btn-lg"><a href='./?s=admin/Home/init'>返回</a></div>
<br>
<table border="1" width="100%" style="text-align:center">
    <thead>
    <tr>
        <th>ID</th>
        <th>申请公司</th>
        <th>法定人</th>
        <td>状态</td>

    </tr>
    </thead>
    <?php foreach ($data as $k=>$value){?>
    <tr>
        <th><?php echo $value['id']?></th>
        <th><?php echo $value['company_name']?></th>
        <th><?php echo $value['legal_person']?></th>
        <th><?php echo $value['status']?></th>

    <th><a href="./?s=admin/status/up&id=<?php echo $value['id']?>">同意</a></th>
    <th><a href="./?s=admin/status/du&id=<?php echo $value['id']?>">否定</a></th>
    </tr>

<?php }?>

</table>


</body>
</html>