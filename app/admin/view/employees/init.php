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
        <span class="layui-breadcrumb">
          <a href="">首页</a>/
          <a href="/demo/">演示</a>
          <a><cite>导航元素</cite></a>
        </span>

<!--        <fieldset class="layui-elem-field layui-field-title" style="">-->
<!--            <legend style="font-size:150% ">员工管理</legend>-->
<!--        </fieldset>-->

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" name="id" id="id" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
                <button class="layui-btn" data-type="reload" id="insert">添加</button>
            </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
            <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
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
            url: './?s=admin/Employees/employees',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[ //表头
                {field:'checkbox',type:'checkbox' , sort: true},
                {field: 'id', title: 'ID',sort: true},
                {field: 'name', title: '账号', },
                {field: 'pwd', title: '密码', },
                {field: 'company_id', title: '公司ID', },
                {field: 'permissions_id', title: '职能ID', },
                {field: 'permissions_group_id', title: '职能组ID', },
                {fixed: 'right', title:'操作', toolbar: '#barDemo', }
            ]],
            id: 'testReload'
            ,page: true
            ,height: 715
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
                            success:function(type){
                                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                layer.close(index);
                                console.log(index);
                                layer.msg(type.data);
                            }
                        });
                        layer.close(index);
                    });
                } else if(obj.event === 'edit'){
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.open({
                            skin:'layer-open',
                            area: ['500px', '300px'],
                            content:'<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;"><legend style="font-size:150% ">修改信息详情</legend></fieldset>' +
                            '<div class="layui-form-item"><label class="layui-form-label">ID</label><div class="layui-input-inline"><input  value="'+data.id+'" name="id" lay-verify="pass" id="id"  class="layui-input"> </div></div>' +
                            '<div class="layui-form-item"><label class="layui-form-label">账号</label><div class="layui-input-inline"><input  value="'+data.name+'" name="name" lay-verify="pass" id="name"  class="layui-input"> </div></div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label" >密码</label> <div class="layui-input-inline"> <input value="'+data.pwd+'" name="pwd"  type="password" id="pwd" lay-verify="pass"   autocomplete="off" class="layui-input"> </div> </div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label">公司ID</label> <div class="layui-input-inline"> <input value="'+data.company_id+'" lay-verify="pass" name="company_id" id="company_id" type="company"   autocomplete="off" class="layui-input"></div></div>',
                            yes: function(index){
                                $.post('./?s=admin/Employees/em_update', {id:$('#id').val(),name:$('#name').val(),pwd:$('#pwd').val(),type:$('#type').val(),company_id:$('#company_id').val()},function (type) {
//                                        layer.msg(type.data)
                                        layui.table.reload('testReload');
                                    }
                                )
                                layer.close(index)//如果设定了yes回调，需进行手工关闭
                            },
                        })
                    })
                }
                else if(obj.event === 'detail'){
                    layer.msg('name：'+ data.name  )
                }
            }),

                $(document).on('click','#insert',function(){
                    layui.use('layer', function (){
                        var layer = layui.layer;
                        layer.open({
                            skin: 'layer-open',
                            area: ['500px', '300px'],
                            content: '<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;"><legend style="font-size:150% ">添加员工信息</legend></fieldset>' +
                            '<div ><label class="layui-form-label">账号</label><div class="layui-input-inline"><input   name="name" lay-verify="pass" id="name"  class="layui-input"> </div></div>' +
                            '<div ><label class="layui-form-label" >密码</label> <div class="layui-input-inline"> <input  name="pwd"  type="password" id="pwd" lay-verify="pass"   autocomplete="off" class="layui-input"> </div> </div>' +
                            '<div ><label class="layui-form-label">公司ID</label> <div class="layui-input-inline"> <input  lay-verify="pass" name="company_id" id="company_id"  autocomplete="off" class="layui-input"></div></div>'+
                            '<div ><label class="layui-form-label">职能ID</label> <div class="layui-input-inline"> <input  lay-verify="pass" name="permissions_id" id="permissions_id"  autocomplete="off" class="layui-input"></div></div>'+
                            '<div ><label class="layui-form-label">职能组ID</label> <div class="layui-input-inline"> <input  lay-verify="pass" name="permissions_group_id" id="permissions_group_id"  autocomplete="off" class="layui-input"></div></div>',
                            yes: function (index) {
                                $.post('?s=admin/Employees/em_insert', {
                                    name: $('#name').val(),
                                    pwd: $('#pwd').val(),
                                    type: $('#type').val(),
                                    company_id: $('#company_id').val(),
                                    permissions_id:$('#permissions_id').val(),
                                    permissions_group_id:$('#permissions_group_id').val()
                                }, function (type) {
//                                    layer.msg(type.data);
                                    layui.table.reload('testReload');
                                })
                                layer.close(index)
                            },
                        })
                    })
                }),

            // 执行搜索，表格重载
            $(document).on('click','#check',function(){
                // 搜索条件
                var send_name = $('#id').val();
                table.reload('testReload', {
                    method: 'post'
                    , where: {
                        'send_name': send_name
                    }
                    , page: {
                        curr: 1
                    }
                });
            }),

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