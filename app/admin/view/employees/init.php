<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 员工管理 - Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body >
<!--<div class="layui-layout layui-layout-admin">-->
<!---->
<!--    <div class="layui-body">-->
        <!-- 内容主体区域 -->
<!--        <a href="" style="font-size:150% ">首页</a>/-->
<!--        <a href="" style="font-size:150% ">演示</a>/-->
<!--        <a href="" style="font-size:150% ">导航元素</a>-->

        <fieldset class="layui-elem-field layui-field-title" style="">
            <legend style="font-size:150% ">员工管理</legend>
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
            <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        </script>
<!--    </div>-->

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <!--© layui.com - 底部固定区域-->
        <div id="demo7"></div>
    </div>
<!--</div>-->

<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Employees/employees',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[ //表头
                {field:'checkbox',type:'checkbox', width:150, sort: true},
                {field: 'id', title: 'ID', width:150, sort: true},
                {field: 'name', title: '名字', width:150},
                {field: 'pwd', title: '密码', width:150},
                {field: 'type', title: '权限', width:150},
                {field: 'company_id', title: '公司', width:150},
                {fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
            ]],
            id: 'testReload'
            ,page: true
            ,height: 310
        }),
            //监听行工具事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('真的删除ID为：'+data.id+"的用户吗?", function(index){
                        $.ajax({
                            url:"./?s=admin/Employees/employee",
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
                            content:'<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;"><legend style="font-size:150% ">修改信息详情</legend></fieldset>' +
                            '<form class="layui-form" action="" lay-filter="example"><div class="layui-form-item"><label class="layui-form-label">名字</label><div class="layui-input-inline"><input  id="name"   placeholder="" autocomplete="off" class="layui-input"> </div></div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label" >密码</label> <div class="layui-input-inline"> <input  type="password" id="pwd"  placeholder="请输入密码" autocomplete="off" class="layui-input"> </div> </div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label">权限</label> <div class="layui-input-inline"> <input type="permission"  placeholder="请输入权限" autocomplete="off" class="layui-input"> </div>  </div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label">公司</label> <div class="layui-input-inline"> <input type="company"  placeholder="请输入公司" autocomplete="off" class="layui-input"> </div>  </div>' +
                            '<div class="layui-form-item"> <div class="layui-input-block"> <button type="submit" id="bu" class="layui-btn" >提交</button> </div> </div>'

                        })
                    })
                }
//                else if(obj.event === 'detail'){
//                    layer.msg('name：'+ data.name  )
//                }
            })
    })

</script>
</body>
</html>