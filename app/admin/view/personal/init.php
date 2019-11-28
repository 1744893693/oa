<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layui</title>
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

<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>


<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<div id="tan" style="display: none;margin-top:30px">
    <div style=" text-align:center" class="layui-form-item" id="id">
        <div>名字：<input type="text" id="name" name="name" style="width: 150px;height:30px "></div>
        <div>密码：<input type="text" id="pwd" name="pwd" style="width: 150px;height:30px "></div>
        <div>身份证号：<input type="text" id="intion" name="intion" style="width: 150px;height:30px "></div>
        <div>性别：<input type="text" id="gender" name="gender" style="width: 150px;height:30px "></div>
        <div>电话：<input type="text" id="telephone" name="telephone" style="width: 150px;height:30px "></div>
        <div>地址：<input type="text" id="address" name="address" style="width: 150px;height:30px "></div>
    </div>
    </div>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script>
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#test'
            ,url:'./?s=admin/Personal/select'
            ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示'
                ,layEvent: 'LAYTABLE_TIPS'
                ,icon: 'layui-icon-tips'
            }]
            ,table:'user'
            ,cols: [[
                {type:'numbers', title:'序号', width:80, unresize: true, sort: true}
                ,{field:'name', title:'名字', width:120, edit: 'text'}
                ,{field:'pwd', title:'密码', width:80, edit: 'text'}
                ,{field:'company_id', title:'公司', width:80, edit: 'text'}
                ,{field:'department_id', title:'部门',width:80,edit: 'text'}
                ,{field:'position_id', title:'职位',width:80,edit: 'text'}
                ,{field:'base_salary', title:'工资', width:80,edit: 'text'}
                ,{field:'intion', title:'身份证号', width:120}
                ,{field:'gender', title:'性别', width:80}
                ,{field:'telephone', title:'电话', width:80}
                ,{field:'address', title:'地址',width:80}
                ,{fixed: 'right', title: '操作', toolbar: '#barDemo', width: 120}
            ]]
            , id: 'department'
            ,height:'full-50'
            ,page: false
        });

        //头工具栏事件
        table.on('toolbar(test)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'getCheckData':
                    var data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：'+ data.name + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选': '未全选');
                    break;

                //自定义头工具栏右侧图标 - 提示
                case 'LAYTABLE_TIPS':
                    layer.alert('这是工具栏右侧自定义的一个图标按钮');
                    break;
            }
        });


        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            //console.log(obj)
            if(obj.event === 'del'){
//                layer.confirm('是否删除：'+data.name+'员工？', function(index){
//                    $.post('./?s=admin/lllersonal/delete',{id:data.id}) ;
//                    obj.del();
//                    //layer.msg('删除成功！');
//                    layer.msg('data');
//                    layui.table.reload('department');
////                    layer.close(index);
//                });
            } else if(obj.event === 'edit'){
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.open({
                        skin:'layer-open',
                        btn: ['确定', '取消'],
                        area: ['500px', '350px'],
                        formType:2,
                        title:'修改信息详情',
                        content:$('#tan'),
                        shade:.0,
                        type:1,
                        yes: function(index){
                            $.post('./?s=admin/Personal/update', { id:data.id,name:$('#name').val(),pwd:$('#pwd').val(),intion:$('#intion').val(),gender:$('#gender').val(),telephone:$('#telephone').val(),address:$('#address').val() },function (date) {
                                layer.msg('修改成功')
                                layui.table.reload('department');
                            });
                            layer.close(index)
                        }
                    })
                })
            }
        });
    });
</script>

</body>
</html>