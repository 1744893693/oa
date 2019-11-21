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



       <span class="layui-breadcrumb">
  <a href="./?s=admin/Home/init">首页</a>
  <a href="/demo/">演示</a>
  <a><cite>职位管理</cite></a>
       </span>

        <table id="demo" lay-filter="test"></table>
        <table class="layui-hide" id="test" lay-filter="test" style="height:100%"></table>

        <script type="text/html" id="toolbarDemo">
        <div class="demoTable">
        <div class="layui-inline">
        <input class="layui-input" name="id" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload" id="jia">添加</button>
        </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        </script>
    </div>

        <div id="tan" style="display: none">
            <div style=" text-align:center" >职位昵称 <input type="text" id="position_name"  name="position_name"style="width: 150px;height: 30px"></div>
        </div>

        <div id="plus" style="display: none">
            <div style=" text-align:center" >职位昵称 <input type="text" id="position_namepuls"  name="position_name"style="width: 150px;height: 30px"></div>
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
                {field:'id',type:'checkbox',sort: true},
                {field: 'id', title: 'ID', sort: true},
                {field: 'position_name', title: '职位'},
//                {field: 'status', title: 'ID', width:150, sort: true},
                {fixed: 'right', title:'操作', toolbar: '#barDemo'}
            ]],
            id: 'testReload'
            ,page: true
            ,height:630
        }),

            //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
                   var position_name =$('#position_name').val(data.position_name);

            if(obj.event === 'del'){
                layer.confirm('真的删除ID为：'+data.id+"的职位吗?", function(index){
                  $.post('./?s=admin/Position/positionsc',{id:data.id})
                    obj.del();
                  layer.close(index);
                    layui.table.reload('testReload');
                });
            }  else if(obj.event === 'edit'){
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.open({
                        skin:'layer-open',
                        btn: ['确定', '取消'],
                        area: ['500px', '300px'],
                        formType:2,
                        title:'编辑信息详情',
                        content:$('#tan'),
                        shade:0,
                        type:1,
                        yes: function(index){
                            $.post('./?s=admin/Position/updatetian', {id:data.id,position_name:$('#position_name').val()},function (date) {
                                layer.msg(date)
                                layui.table.reload('testReload');
                            })
                            layer.close(index)
                        },
                    })
                })
            }
        })

        $(document).on('click','#jia',function(){

                layui.use('layer', function() {
                    var layer = layui.layer;
                    layer.open({
                        skin: 'layer-open',
                        btn: ['确定', '取消'],
                        area: ['500px', '300px'],
                        formType: 2,
                        title:'添加信息详情',
                        content: $('#plus'),
                        shade: 0,
                        type: 1,
                        yes: function (index) {
                            $.post('./?s=admin/Position/puls', {position_name:$('#position_namepuls').val()}, function (date) {
                                layer.msg(date)
                                layui.table.reload('testReload');
                            })
                            layer.close(index)
                        }
                    })
                })
            })
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