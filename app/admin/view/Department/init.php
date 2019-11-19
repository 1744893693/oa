<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>table模块快速使用</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>

</head>
<body>

<table id="demo" lay-filter="test"></table>

<script src="./public/layui-v2.5.5/layui/layui.js"></script>
<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;

        //第一个实例
        table.render({
            elem: '#demo'
            ,height: 312
            ,url: './app/admin/model/' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
                ,{field: 'name', title: '名字', width:80}
                ,{field: 'mudule', title: '性别', width:80, sort: true}
                ,{field: 'controller', title: '城市', width:80}
                ,{field: 'method', title: '签名', width: 177}
                ,{field: 'company_id', title: '积分', width: 80, sort: true}
            ]]
        });

    });
</script>
</body>
</html>