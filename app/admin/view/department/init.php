<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>部门管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<table class="layui-hide" id="test" lay-filter="test"></table>

<script type="textml" id="toolbarDemo" >
    <div class="demoTable">
        <div class="layui-inline" id="insearch">
            <input class="layui-input"  name="name" id="nametext"  autocomplete="off">
        </div>
         <button class="layui-btn" data-type="reload" id="search">搜索</button>
         <button class="layui-btn" data-type="reload" id="insert">添加</button>
    </div>
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<div id="tan" style="display: none;margin-top:65px">
    <div style=" text-align:center" class="layui-form-item">部门名字：
        <input type="text" id="nametest" name="name" style="width: 150px;height:30px ">
    </div>
</div>


<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script type="text/javascript">
    layui.use('table', function() {
        var table = layui.table;
        table.render({
            elem: '#test'
            , url: './?s=admin/Department/search'
            , toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            , defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示'
                , layEvent: 'LAYTABLE_TIPS'
                , icon: 'layui-icon-tips'
            }]
            , cols: [[
               // {type: 'checkbox', fixed: 'left'}
                 {type: 'numbers', title: '序号', width: 80, fixed: 'left', unresize: true, sort: true}
                , {field: 'name', title: '部门名字',  edit: 'text'}
                , {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 200,align: 'center' }
            ]]
            , id: 'department'
            , page: true
            ,height: 'full-50'
        });

        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                if(data.name=='人事部'){
                    layer.msg('禁止此操作')
                    return false
                }
                layer.confirm('是否删除：' + data.name + "部门?",{ skin: 'layui-layer-molv', } ,function (index) {
                    $.post('./?s=admin/Department/delete', {id: data.id});
                    obj.del();
                    //layer.close(index);
                    layer.msg('删除成功')
                    layui.table.reload('department');
                });
            }
            else if(obj.event === 'edit'){
                if(data.name=='人事部'){
                    layer.msg('禁止此操作')
                    return false
                }
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.open({
                        skin: 'layui-layer-molv',
                        btn: ['确定', '取消'],
                        area: ['500px', '300px'],
                        formType:2,
                        title:'编辑信息详情',
                        content:$('#tan'),
                        shade:.0,
                        type:1,
                        yes: function(index){
                            var name=$('#nametest').val();
                            $.post('./?s=admin/Department/update', { id:data.id,name:name},function (date) {
                                layer.msg('编辑成功');
                                layui.table.reload('department');
                            });
                            layer.close(index)
                        }
                    })
                })
            }
        });
        $(document).on('click','#insert',function(){
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.open({
                    skin: 'layui-layer-molv',
                    btn: ['确定', '取消'],
                    area: ['500px', '300px'],
                    formType: 2,
                    title:'添加信息详情',
                    content: $('#tan'),
                    shade: 0,
                    type: 1,
                    yes: function (index) {
                        var name=$('#nametest').val();
                        $.post('./?s=admin/Department/insert', {name:name}, function (date) {
                                    layer.msg('添加成功');
                                    layui.table.reload('department');
                        });
                        layer.close(index)
                    }
                })
            })
        });
        $(document).on('click','#search',function(){
            // 搜索条件
            var name = $('#nametext').val();
            table.reload('department', {
                method: 'post'
                , where: {
                    'name': name
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
