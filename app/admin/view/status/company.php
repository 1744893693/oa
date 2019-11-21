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
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend style="font-size:150% ">OA公司注册管理</legend>
</fieldset>

<table id="demo" lay-filter="test"></table>
<table class="layui-hide" id="test" lay-filter="test" style="height:100%"></table>

<script type="text/html" id="toolbarDemo">
    <div class="demoTable">
        <div class="layui-inline">
            <input class="layui-input" name="id" id="id" autocomplete="off">
        </div>
        <div class="layui-inline">
            <button class="layui-btn" data-type="reload" id="check">搜索</button>
        </div>
        <div class="layui-inline">

        </div>
    </div>
</script>




<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" id="del">删除</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="up" id="up">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="db" id="db">驳回</a>
</script>

<div id="tan" style="display: none">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend style="font-size:150% ">修改信息详情</legend></fieldset>

    <div style=" text-align:center" class="layui-form-item">注册公司 <input type="text" id="company_name"  name="company_name" style="width: 150px;height:30px "></div>
    <div style=" text-align:center;top: 30px" class="layui-form-item">公司法人<input type="text"id="legal_person"style="width: 150px;height:30px "></div>
</div>
<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Status/layuia',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[ //表头

                {field: 'id', title: 'ID', width:150, sort: true},
                {field: 'company_name', title: '注册公司', width:150, sort: true},
                {field: 'legal_person', title: '法人', width:150},
                {field: 'status', title: '状态', width:150},
                {fixed: 'right', title:'操作', toolbar: '#barDemo', width:260}
            ]],
            id: 'testReload'
            ,page: true

        });


        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            var company_name= $('#company_name').val(data.company_name),
                legal_person= $('#legal_person').val(data.legal_person);
            if(obj.event === 'del'){
                layer.confirm('真的删除状态为：'+data.id+"的职位吗?", function(index){
                    $.post('./?s=admin/Status/statussc',{id:data.id})
                    obj.del();
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            } else if(obj.event === 'up'){
                layer.confirm('真的修改状态为：'+data.id+"的职位吗?", function(index){
                    $.post('./?s=admin/status/up',{id:data.id})
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            }else if(obj.event === 'db'){
                layer.confirm('真的修改状态为：'+data.id+"的职位吗?", function(index){
                    $.post('./?s=admin/status/db',{id:data.id})
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            }else if(obj.event === 'edit'){

                layui.use('layer', function(){

                    var layer = layui.layer;
                    layer.open({
                        skin:'layer-open',
                        btn: ['确定', '取消'],
                        area: ['500px', '300px'],
                        formType:2,
                        title:false,
                        content:$('#tan'),
                        shade:.0,
                        type:1,
                        yes: function(index){

                            $.post('./?s=admin/Status/updatetan', {id:data.id,company_name:$('#company_name').val(),legal_person:$('#legal_person').val()},function (date) {
                                    layer.msg(date)
                                    layui.table.reload('testReload');
                                }
                            )
                            layer.close(index)
                        },
                    })
                })
            }

        });

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
        });

    })




</script>
</body>
</html>