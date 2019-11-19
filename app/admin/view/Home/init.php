<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>oa管理系统</title>
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
        <div style="padding: 15px; height: 100%">
            <iframe height="100%" width="100%" frameborder="0"></iframe>
        </div>
    </div>

    <div class="layui-footer">

    </div>
</div>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;
    })
    var menu=[]
     $.post('./?s=admin/home/menu',function (data) {
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
    function list(tt) {
         for(val of menu.menu){
             if(val.id==tt) {
                 if (val.method) {
                     $('iframe')[0].contentWindow.location.href = './?s=' + val.method
                 }
             }
         }
//
    }

//        $('iframe')[0].contentWindow.location.href='https://www.baidu.com/'
    function menu_child(id){
        $('#left_menu').text('')
        for(val of menu.menu){
            if(val.department_id==id){
               var audit=val.id
                $('#left_menu').append('<li class="layui-nav-item layui-nav-itemed" id="audit" style=" text-align:center"><a href="javascript:list('+val.id+')">'+val.name+'</a></li>')
            }


        }
//        if(val.department_id==id){
//            var audit=val.id
//            $('#left_menu').append('<li class="layui-nav-item layui-nav-itemed" id="audit" style=" text-align:center"><a href="javascript:">'+val.name+'</a></li>')
////            $('#audit').append('<li class="audits" style=" text-align:center"><a href="./?s=admin/status/company">oa审批</a></li>')
//        }
        layui.use('element', function(){
            var element = layui.element;
        })
    }

</script>
</body>
</html>

