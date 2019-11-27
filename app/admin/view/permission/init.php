<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 职能 - Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body >

        <span class="layui-breadcrumb">
  <a href="./?s=admin/Home/init">首页</a>
  <a href="/demo/">演示</a>
  <a><cite>职能管理</cite></a>
       </span>

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend style="font-size:150% ">职能等级</legend>
        </fieldset>

        <table id="demo" lay-filter="test"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
        <div class="demoTable">
        <div class="layui-inline">
        <input class="layui-input" name="id" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload" id="check">搜索</button>
            <button class="layui-btn" data-type="reload" id="insert">添加</button>
        </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        </script>


    <div class="layui-footer">
        <div id="demo7"></div>
    </div>


<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Permission/permission',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[ //表头
                { type: 'numbers', title: '序号' , width:80, sort: true, fixed: 'left'},
                {field: 'functional_grade', title: '职能等级'},
                {field: 'companyId', title: '公司'},
                {fixed: 'right', title:'操作', toolbar: '#barDemo', width:250}
            ]],
            id: 'testReload'
            ,page: true
            ,height:570
        }),
            //监听行工具事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('真的删除ID为：'+data.id+"的用户吗?", function(index){
                        $.ajax({
                            url:"./?s=admin/Permission/delete_permission",
                            type:'post',
                            data:{'id':data.id},//向服务端发送删除的id
                            success:function(data){
                                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                layer.close(index);
                                console.log(index);
                                layer.msg(data.data);
                            }
                        }) ;
                        layer.close(index);
                    });
                } else if(obj.event === 'edit'){
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.open({
                            skin:'layer-open',
                            btn:[],
                            area: ['500px', '300px'],
                        })
                    })


                } else if(obj.event === 'detail'){
                    layer.msg('name：'+ data.name  )
                }
            })

        //面包屑显示
        layui.use('element', function(){
            var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块

            //监听导航点击
            element.on('nav(demo)', function(elem){
                //console.log(elem)
                layer.msg(elem.text());
            });
        });

            })



</script>
</body>
</html>