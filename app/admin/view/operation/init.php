<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 申请假期 - Layui</title>
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
          <a><cite>导航元素</cite></a>
        </span>

<table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
<table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" value="" name="id" id="id" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
            </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="agree">同意</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="refuse">拒绝</a>
        </script>

<div class="layui-footer">
    <div id="demo7"></div>
</div>

<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Operation/operation',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                {field: 'name', title: '请假人' },
                {field: 'start_time', title: '开始时间' },
                {field: 'end_time', title: '结束时间' },
                {field: 'position_id', title: '审批人' },
                {field: 'type', title: '请假类型' },
                {field: 'reason', title: '请假原因' },
                {field: 'audit', title: '请假审批', templet:function (d) {
                    if (d.audit==0) {
                        return "<span style='color: red'>未审批</span>";
                    } else if (d.audit==1) {
                        return "<span style='color: green'>已通过</span>";
                    }else if(d.audit==2){
                        return "<span style='color: red'>已拒绝</span>";
                    }
                }},
                {fixed: 'right', title:'操作', toolbar: '#barDemo'}
            ]],
            id: 'testReload'
            ,page: true
            ,height: 'full-50'
        }),
            //监听行工具事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                if(obj.event === 'refuse'){
                    layer.confirm('是否确定拒绝？', function(index){
                        $.post('?s=admin/Operation/update1', {
                            id:data.id,audit:data.audit
                        }, function (type) {
                            layer.msg(type.data);
                            layui.table.reload('testReload');
                        },'json')
                        layer.close(index)
                    })
                }else if(obj.event === 'agree'){
                    layer.confirm('是否确定同意？', function(index){
                        $.post('?s=admin/Operation/update2', {
                            id:data.id,audit:data.audit
                        }, function (type) {
                            layer.msg(type.data);
                            layui.table.reload('testReload');
                        },'json')
                        layer.close(index)
                    });
                }
            }),
            // 执行搜索，表格重载
            $(document).on('click','#check',function(){
                // 搜索条件
                var send_name = $('#id').val();
                table.reload('testReload', {
                    method: 'get'
                    , where: {
                        'send_name': send_name
                    }
                    , page: {
                        curr: 1
                    }
                })
            }),
            //面包屑显示
            layui.use('element', function(){
                var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
                //监听导航点击
                element.on('nav(demo)', function(elem){
                    //console.log(elem)
                    layer.msg(elem.text());
                })
            });
    })
</script>
</body>
</html>