<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>部门管理</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./public/layui-v2.5.5/layui/layui.js"></script>

</head>
<body>
<table class="layui-hide" id="test" lay-filter="test"></table>

<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" id="del">删除</a>
</script>


<script src="./public/layui-v2.5.5/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script type="text/javascript">
    layui.use('table', function(){

        var table = layui.table;

        table.render({
            elem: '#test'
            ,url:'./?s=admin/Department/select'
            ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示'
                ,layEvent: 'LAYTABLE_TIPS'
                ,icon: 'layui-icon-tips'
            }]
            ,title: '用户数据表'
            ,cols: [[
                ,{type: 'checkbox', fixed: 'left'}
                ,{field:'ip', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
                ,{field:'name', title:'用户名', width:120, edit: 'text'}
                ,{field:'company_id', title:'公司代码', width:80, edit: 'text', sort: true}
                ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
            ]]
            ,page: true
        });

        //头工具栏事件
//        table.on('toolbar(test)', function(obj){
//            var checkStatus = table.checkStatus(obj.config.id);
//            switch(obj.event){
//                case 'getCheckData':
//                    var data = checkStatus.data;
//                    layer.alert(JSON.stringify(data));
//                    break;
//                case 'getCheckLength':
//                    var data = checkStatus.data;
//                    layer.msg('选中了：'+ data.length + ' 个');
//                    break;
//                case 'isAll':
//                    layer.msg(checkStatus.isAll ? '全选': '未全选');
//                    break;
//
//                //自定义头工具栏右侧图标 - 提示
//                case 'LAYTABLE_TIPS':
//                    layer.alert('这是工具栏右侧自定义的一个图标按钮');
//                    break;
//            };
//
//        });

        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            //console.log(obj)
            if(obj.event === 'del'){
                layer.confirm('真的删除'+data.name+"部门吗?", function(index){
                    $.ajax({
                        url:'./?s=admin/Department/delete',
                        type:'post',
                        data:{'id':data.id},
                })
                    obj.del();
                    layer.close(index);
                });

            } else if(obj.event === 'edit'){
                layer.prompt({
                    formType: 2
                    ,value: data.email
                }, function(value, index){
                    obj.update({
                        email: value
                    });
                    layer.close(index);
                });
            }
        });
    });
</script>




</body>
</html>