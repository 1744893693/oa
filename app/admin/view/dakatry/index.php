<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body>
<table id="demo" lay-filter="test"></table>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="up" id="up">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="db" id="db">驳回</a>
</script>
<script type="text/javascript">
    layui.use('table', function() {
            var table = layui.table;
            table.render({
                elem: '#demo',//指定表格元素
                url: './?s=admin/Dakatry/init',//请求路径
                defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                    title: '提示',
                    layEvent: 'LAYTABLE_TIPS',
                    icon: 'layui-icon-tips',
                    cellMinWidth: 80
                }],
                cols: [[ //表头
                    {type: 'numbers', title: '序号', width: 80, sort: true, fixed: 'left'},
                    {field: 'name', title: '姓名'},
                    {field: 'reasons', title: '迟到原因'},
                    {field: 'latetime', title: '补卡时间'},
                    {
                        field: 'status', title: '状态', sort: true, templet: function (d) {
                            if (d.status == 0) {  // 自定义内容
                                return "<span style='color: red'>未审批</span>";
                            } else if (d.status == 1) {
                                return "<span style='color: green'>已通过</span>";
                            } else if (d.status == 2) {
                                return "<span style='color: red'>已拒绝</span>";
                            }
                        }
                    },
                    {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 210}
                ]],
                id: 'testReload'
                , page: true
                , height: 630
            });

        table.on('tool(test)', function(obj){
            var data = obj.data;
            var name= $('#name').val(data.company_name);
             if(obj.event === 'up'){
                layer.confirm('你确定更改：'+data.name+"的状态为已通过吗?", function(index){
                    $.post('./?s=admin/Dakatry/up',{id:data.id})
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            }else if(obj.event === 'db'){
                layer.confirm('你确定驳回：'+data.name+"的状态为不通过吗?", function(index){
                    $.post('./?s=admin/Dakatry/db',{id:data.id})
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            }
        });
    })
</script>
</body>
</html>