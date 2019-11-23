<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>oa管理系统</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo" id="title"></div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left" id="top-menu">
<!--            <li class="layui-nav-item"><a href="">控制台</a></li>-->
<!--            <li class="layui-nav-item"><a href="">商品管理</a></li>-->
<!--            <li class="layui-nav-item"><a href="">用户</a></li>-->
<!--            <li class="layui-nav-item">-->
<!--                <a href="javascript:;">其它系统</a>-->
<!--                <dl class="layui-nav-child">-->
<!--                    <dd><a href="">邮件管理</a></dd>-->
<!--                    <dd><a href="">消息管理</a></dd>-->
<!--                    <dd><a href="">授权管理</a></dd>-->
<!--                </dl>-->
<!--            </li>-->
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:menu_child(0);">
<!--                    <img src="" class="layui-nav-img">-->
                    <?php echo $_SESSION['admin']['name']?>
                </a>
<!--                <dl class="layui-nav-child">-->
<!--                    <dd><a href="">基本资料</a></dd>-->
<!--                    <dd><a href="">安全设置</a></dd>-->
<!--                </dl>-->
            </li>
            <li class="layui-nav-item" id="l"></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test" id="left_menu">

<!--                <li class="layui-nav-item layui-nav-itemed">-->
<!--                    <a class="" href="javascript:;">所有商品</a>-->
<!--                    <dl class="layui-nav-child">-->
<!--                        <dd><a href="javascript:;">列表一</a></dd>-->
<!--                        <dd><a href="javascript:;">列表二</a></dd>-->
<!--                        <dd><a href="javascript:;">列表三</a></dd>-->
<!--                        <dd><a href="">超链接</a></dd>-->
<!--                    </dl>-->
<!--                </li>-->
<!--                <li class="layui-nav-item">-->
<!--                    <a href="javascript:;">解决方案</a>-->
<!--                    <dl class="layui-nav-child">-->
<!--                        <dd><a href="javascript:;">列表一</a></dd>-->
<!--                        <dd><a href="javascript:;">列表二</a></dd>-->
<!--                        <dd><a href="">超链接</a></dd>-->
<!--                    </dl>-->
<!--                </li>-->
<!--                <li class="layui-nav-item"><a href="">云市场</a></li>-->
<!--                <li class="layui-nav-item"><a href="">发布商品</a></li>-->
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 10px 10px 0 10px; height: calc(100% - 10px)">
            <iframe   height="100%" width="100%" frameborder="0"></iframe>
        </div>
    </div>

    <div class="layui-footer">

    </div>
</div>
<script>

        var menu=[]
        $.post('./?s=admin/Home/company',{id:'<?php echo $_SESSION['admin']['company_id']?>'},function (data) {
            $('#title').html(data[0].company_name+'OA后台管理')
        },'json')
        $.post('./?s=admin/Home/menu',{id:'<?php echo $_SESSION['admin']['company_id']?>'},function (data) {
            menu=data
//            layui.use('element', function(){
//                var element = layui.element;
//            })
            for(val of menu.department){
                if(1==<?php echo $_SESSION['admin']['permissions_group_id']?>){
                    if(val.company_id==<?php echo $_SESSION['admin']['company_id']?>){
                        $('#top-menu').append('<li class="layui-nav-item layui-nav-itemed"><a href="javascript:menu_child('+val.id+')">'+val.name+'</a></li>')
                    }
                }else if (val.permissions_group_id==<?php echo $_SESSION['admin']['permissions_group_id']?>){
                    if(val.permissions_id == <?php echo $_SESSION['admin']['permissions_id']?>){
                        if(val.company_id==<?php echo $_SESSION['admin']['company_id']?>){
                            $('#top-menu').append('<li class="layui-nav-item layui-nav-itemed"><a href="javascript:menu_child('+val.id+')">'+val.name+'</a></li>')
                        }
                    }
                }
            }
            $('#l').append('<a href="javascript:login_out()">退出</a>')
            menu_child(0)
        },'json')
        function list(tt) {
            for(val of menu.menu){
                if(val.id==tt) {
                    if (val.method) {
                        $('iframe')[0].contentWindow.location.href = './?s=' + val.method+'&id=<?php echo $_SESSION['admin']['id']?>'
                    }
                }
            }
        }

        function login_out() {
            $.post('./?s=admin/Home/out',function (data) {
                window.location.href="./"
            })
        }
        function menu_child(id){
            $('#left_menu').text('')
            for(val of menu.menu){
                if(val.department_id==id){
                    if(val.permissions_id>=<?php echo $_SESSION['admin']['permissions_id']?>){
                        var audit=val.id
                        $('#left_menu').append('<li class="layui-nav-item layui-nav-itemed" id="audit" style=" text-align:center"><a href="javascript:list('+val.id+')">'+val.name+'</a></li>')
                    }
                }

            }
            layui.use('element', function(){
                var element = layui.element;
            })
        }


</script>
</body>
</html>

