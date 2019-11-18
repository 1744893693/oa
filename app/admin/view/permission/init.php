<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <link rel="stylesheet" href="./public/layui/css/layui.css">
    <script src="./public/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo" id="title"></div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left" id="top-menu">
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test" id="left_menu">
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px; height: 100%">

            <table id="demo" lay-filter="test"></table>
            <table class="layui-hide" id="test" lay-filter="test"></table>

            <!--<script type="text/html" id="toolbarDemo">-->
            <!--<div class="demoTable">-->
            <!--<div class="layui-inline">-->
            <!--<input class="layui-input" name="id" id="demoReload" autocomplete="off">-->
            <!--</div>-->
            <!--<button class="layui-btn" data-type="reload" id="check">搜索</button>-->
            <!--</div>-->
            <!--</script>-->

<!--            <script type="text/html" id="barDemo">-->
<!--                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>-->
<!--                <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>-->
<!--                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>-->
<!--            </script>-->





        </div>
    </div>

    <div class="layui-footer">

    </div>
</div>
<script>
    //JavaScript代码区域
    var menu=[]
    $.post('./?s=admin/home/menu',{name:'shen'},function (data) {
        menu=data
        if(1){ //session里面拿到的用户信息。如果里面的用户是董事会成员（val==menu.）则进入
            var count=0
            for(val of menu.department){
                if(count!==0){
                    if(val.company_id==1){
                        $('#top-menu').append('<li class="layui-nav-item"><a href="javascript:menu_child('+val.id+')">'+val.name+'</a></li>')
                    }
                }else{
                    $('#title').html(val.name+'管理系统')
                }
                count++
            }
        }else {
            for(val of menu.menu){
                if(val.department_id==3){
                    $('#top-menu').append('<li class="layui-nav-item"><a href="javascript:menu_child('+val.id+')">'+val.name+'</a></li>')
                }
            }
        }
    },'json')
    layui.use('element', function(){
        var element = layui.element;
    })
    function menu_child(id){
        $('#left_menu').html('')
        for(val of menu.menu){
            if(val.department_id==id){
                $('#left_menu').append('<li class="layui-nav-item layui-nav-itemed"><a href="javascript:">'+val.name+'</a></li>')
            }
        }
    }




    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',
            url: './?s=admin/permission/permi',
//            toolbar: '#toolbarDemo',
//            defaultToolbar: ['filter', 'exports', 'print', {
//                title: '提示',
//                layEvent: 'LAYTABLE_TIPS',
//                icon: 'layui-icon-tips'
//            }],
            cols: [[ //表头
                {field: 'id', title: 'ID', width:150, sort: true},
                {field: 'functional-grade', title: '职能等级', width:150},
                {field: 'companyid', title: '公司', width:150},
            ]],
            id: 'testReload'
            ,page: true
            ,height: 310
        })

            //监听行工具事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('真的删除ID为：'+data.id+"的用户吗?", function(index){
                        $.ajax({
                            url:"{:url('admin/accountlist/del')}",
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
                            content:'<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;"><legend style="font-size:150% ">编辑账号详情</legend></fieldset>' +
                            '<form class="layui-form" action="" lay-filter="example"><div class="layui-form-item"><label class="layui-form-label">账号</label><div class="layui-input-inline"><input  id="name"  lay-verify="pass" placeholder="" autocomplete="off" class="layui-input"> </div></div>' +
                            '<div class="layui-form-item"> <label class="layui-form-label">密码</label> <div class="layui-input-inline"> <input type="password" id="pwd" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input"> </div> <div class="layui-form-mid layui-word-aux">请填写6到24位密码</div> </div>' +  +
                            '<div class="layui-form-item"> <div class="layui-input-block"> <button type="submit" id="bu" class="layui-btn" lay-submit="" lay-filter="demo1">提交</button> </div> </div>'
                        })
                    })


                } else if(obj.event === 'detail'){
                    layer.msg('name：'+ data.name  )
                }
            });
        //重载
        $(function () {
            $('#check').click(function () {
                var demoReload=$('#demoReload').val();
                $.ajax({
                    url:'{:url("admin/Accountlist/con")}',
                    data:{demoReload:demoReload},
                    dataType:'json',
                    type:'post',
                    success:function (data) {
                        layui.use('layer', function(){
                            var layer = layui.layer;
                            layer.msg(data.data);
                        });
                    }
                })
                active = {
                    reload: function(){
                        var demoReload = $('#demoReload');
                        //执行重载
                        table.reload('testReload', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                key: {
                                    id: demoReload.val()
                                }
                            }
                        }, 'data');
                    }
                }
                $('.demoTable .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            })
        })
    })




</script>
</body>
</html>
