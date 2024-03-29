<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="./public/img/fa.ico" />
    <title>oa管理系统</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo" id="title" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis"></div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left" id="top-menu">
<!--            <li class="layui-nav-item layui-nav-itemed"><a href="javascript:menu_child('+val.department_id+')">个人中心</a></li>-->
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:menu_child(0);">
<!--                    <img src="" class="layui-nav-img">-->
                    <?php echo $_SESSION['admin']['name']?>
                </a>
            </li>
            <li class="layui-nav-item" id="l"> </li>
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
        <div style="padding: 10px 10px 0 10px; height: calc(100% - 15px)">
            <iframe   height="100%" width="100%" frameborder="0"></iframe>
        </div>
    </div>
    <div class="layui-footer">

    </div>
</div>
<script>
        var menu=[]
    $.post('./?s=admin/Home/menu',function (data) {
        menu=data
        $('#title').html(data.company[0].company_name+'系统')
        $('#l').append('<a href="javascript:login_out()">退出</a>')
        if (menu.department[0]['department_id']!=null){
            for(val of menu.department){
                $('#top-menu').append('<li class="layui-nav-item layui-nav-itemed"><a href="javascript:menu_child('+val.department_id+')">'+val.department_name+'</a></li>')
            }
            menu_child(menu.department[0].department_id)
//            list()
        }
        layui.use('element', function(){
            var element = layui.element;
        })
    },'json')


function list(tt) {
    for(val of menu.menu){
        if(val.menu_id==tt) {
            if (val.method) {
                $('iframe')[0].contentWindow.location.href = './?s=' + val.method

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
    var count=0
    for(val of menu.menu){
        if(val.department_id==id){
            $('#left_menu').append('<li class="layui-nav-item layui-nav-itemed" id="audit" style=" text-align:center"><a href="javascript:list('+val.menu_id+')">'+val.menu_name+'</a></li>')
            if(count==0){
                list(val.menu_id)
                count++
            }

        }
    }
}
</script>
</body>
</html>

