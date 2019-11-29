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
</script>


<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
</script>
<div id="tan" style="display: none;margin-top:30px" >
    <div style=" text-align:center" class="layui-form-item" id="id" >
        <div style="margin: 5px">名&emsp;&emsp;字：<input type="text" id="name" name="name" value=""  style="width: 150px;height:30px;border-style:inset;"></div>
        <div style="margin: 5px">密&emsp;&emsp;码：<input type="text" id="pwd" name="pwd" style="width: 150px;height:30px;border-style:inset; "></div>
        <div style="margin: 5px">身份证号：<input type="text" id="intion" name="intion" style="width: 150px;height:30px;border-style:inset;"></div>
        <div style="margin: 5px">性&emsp;&emsp;别：<input type="text" id="gender" name="gender" style="width: 150px;height:30px;border-style:inset; "></div>
        <div style="margin: 5px">电&emsp;&emsp;话：<input type="text" id="telephone" name="telephone" style="width: 150px;height:30px;border-style:inset; "></div>
        <div style="margin: 5px">地&emsp;&emsp;址：<input type="text" id="address" name="address" style="width: 150px;height:30px;border-style:inset; "></div>
    </div>
</div>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script>
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#test'
            ,url:'./?s=admin/Personal/select'
            ,table:'user'
            ,cols: [[
                {type:'numbers', title:'序号', width:80, unresize: true, sort: true}
                ,{field:'name', title:'名字', width:120, edit: 'text'}
                ,{field:'pwd', title:'密码', width:80, edit: 'text'}
                ,{field:'intion', title:'身份证号'}
                ,{field:'gender', title:'性别'}
                ,{field:'telephone', title:'电话'}
                ,{field:'address', title:'地址'}
                ,{fixed: 'right', title: '操作', toolbar: '#barDemo',align: 'center'}
            ]]
            , id: 'department'
            ,height:'full-50'
            ,page: false
        });


        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            //console.log(obj)
            if(obj.event === 'del'){

            } else if(obj.event === 'edit'){
                var namea=$('#name').val(data.name);
                var pwda=$('#pwd').val(data.pwd);
                var intiona=$('#intion').val(data.intion)
                var gendera=$('#gender').val(data.gender)
                var telephonea=$('#telephone').val(data.telephone)
                var addressa=$('#address').val(data.address)
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.open({
                        skin:'layui-layer-molv',
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