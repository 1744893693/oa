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
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

    <div class="layui-body">
        <!-- 内容主体区域 -->


        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend style="font-size:150% ">OA公司注册管理</legend>
        </fieldset>

        <table id="demo" lay-filter="test"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
            </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        </script>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <!--© layui.com - 底部固定区域-->
        <div id="demo7"></div>
    </div>
</div>

<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Position/managements',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[ //表头
                {field:'id', title: 'ID',type:'checkbox', width:150,sort: true},
                {field: 'company_name', title: 'ID', width:150, sort: true},
                {field: 'legal_person', title: '注册公司', width:150},
                {field: 'status', title: '状态', width:150},
                {fixed: 'right', title:'操作', toolbar: '#barDemo', width:200}
            ]],
            id: 'testReload'
            ,page: true
            ,height: 310
        }),

            //监听行工具事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('真的修改状态为：'+data.id+"的职位吗?", function(index){
                        $.post('./?s=admin/status/up',{id:data.id})
                        obj.del();
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
            });
        //重载
        $(function () {
            $('#check').click(function () {
                var demoReload=$('#demoReload').val();
                $.ajax({
                    url:'{:url("admin/Accountlist/con")}',
                    data:{demoReload:demoReload},
                    dataType:'json',
                    type:'post',
                    success:function (data) {
                        layui.use('layer', function(){
                            var layer = layui.layer;
                            layer.msg(data.data);
                        });
                    }
                })
                active = {
                    reload: function(){
                        var demoReload = $('#demoReload');
                        //执行重载
                        table.reload('testReload', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                key: {
                                    id: demoReload.val()
                                }
                            }
                        }, 'data');
                    }
                }
                $('.demoTable .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            })
        })
    })

</script>
</body>
</html>