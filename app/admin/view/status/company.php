
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
  <a><cite>公司管理</cite></a>
</span>
<table id="demo" lay-filter="test"></table>
<table class="layui-hide" id="test" lay-filter="test" style="height:100%";></table>


<script type="text/html" id="toolbarDemo">
    <div class="demoTable">

<!--<div style="width:100px ;float: left">-->
<!--    <select name="modules" lay-verify="required" lay-search="" id="check"style="width:60px ">-->
<!--        <option value="">选择字段</option>.-->
<!--     --><?php //foreach ([1,2,5,8,8] as $k){?>
<!--            <option value="17">--><?php //echo $k ?><!--</option>-->
<!--        --><?php //}?>
<!--    </select>-->
<!--</div>-->
         <div class="layui-inline" >
<!--        </div>-->
         <div class="layui-inlinex">
             <div style="float: left">
                 <input class="layui-input" name="id" id="id" autocomplete="off" >
             </div>
            <button class="layui-btn" data-type="reload" id="check">搜索</button>
        </div>
    </div>
 </div>
<!--            <div class="layui-input-inline">-->
<!--            </div>-->
<!--        <div class="layui-inline">-->
<!--     </div>-->

</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" id="del">删除</a>
    <a class="layui-btn layui-btn-xs" lay-event="up" id="up">同意</a>

</script>

<div id="tan" style="display: none;margin-top:65px">
    <div style=" text-align:center" class="layui-form-item">注册公司 <input type="text" id="company_name"  name="company_name" style="width: 150px;height:30px;margin-left:20px "></div>
    <div style=" text-align:center" class="layui-form-item">公司法人<input type="text"id="legal_person"style="width: 150px;height:30px;margin-left:23px "></div>
</div>
<script type="text/javascript">
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#demo',//指定表格元素
            url: './?s=admin/Status/layuia',//请求路径
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips',
                cellMinWidth: 80
            }],
            cols: [[ //表头
                { type: 'numbers', title: '序号' , width:80, sort: true, fixed: 'left'},
                {field: 'company_name', title: '注册公司'},
                {field: 'legal_person', title: '法人'},
                {field: 'account', title: '账号'},
                {field: 'status', title: '状态' ,width:100,align: 'center',sort: true, templet:function (d) {
                 if (d.status==0) {  // 自定义内容
                     return "<span style='color: red'>未审批</span>";
                 } else if (d.status==1) {
                     return "<span style='color: green'>已通过</span>";
                 }else if(d.status==2) {
                     return "<span style='color: red'>已拒绝</span>";
                 }
                }},
                {fixed: 'right', title:'操作', toolbar: '#barDemo',width:210,align: 'right'}
            ]],
            id: 'testReload'
            ,page: true
            ,height:630
        });
        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            var company_name= $('#company_name').val(data.company_name),
                legal_person= $('#legal_person').val(data.legal_person);
            if(obj.event === 'del'){
                if(data.id==3){
                    layer.msg('禁止此危险操作')
                    return false
                }
                layer.confirm('你确定删除：'+data.company_name+"的公司吗?",{skin:'layui-layer-molv',}, function(index){
                    $.post('./?s=admin/Status/statussc',{id:data.id})
                    obj.del();
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            } else if(obj.event === 'up'){
                layer.confirm('你确定通过'+data.company_name+"注册申请吗?", {
                    skin:'layui-layer-molv',
                }, function(index){
                    $.post('./?s=admin/Status/up',{id:data.id,account:data.account})
                    layer.close(index);
                    layui.table.reload('testReload');
                });
            }else if(obj.event === 'edit'){

                layui.use('layer', function(){

                    var layer = layui.layer;
                    layer.open({
                        skin: 'layui-layer-molv',
                        btn: ['确定', '取消'],
                        area: ['500px', '300px'],
                        formType:2,
                        title:'修改信息详情',
                        content:$('#tan'),
                        icon:0,
                        shade:.0,
                        type:1,
                        yes: function(index){

                            $.post('./?s=admin/Status/updatetan', {id:data.id,company_name:$('#company_name').val(),legal_person:$('#legal_person').val()},function (date) {
                                    layer.msg(date)
                                    layui.table.reload('testReload');
                                }
                            )
                            layer.close(index)
                        },
                    })
                })
            }

        });

        // 执行搜索，表格重载
        $(document).on('click','#check',function(){
            // 搜索条件
            var send_name = $('#id').val();
            table.reload('testReload', {
                method: 'post'
                , where: {
                    'send_name': send_name
                }
                , page: {
                    curr: 1
                }
            });
        });
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