<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 物质管理 - Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body >

        <span class="layui-breadcrumb">
          <a href="">首页</a>/
          <a><cite>物资管理</cite></a>
        </span>

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" value="" name="id" id="id" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
                <button class="layui-btn" data-type="reload" id="insert">新品入库</button>
            </div>
        </script>



        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="agree">添加</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="fuse">上架</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="refuse">下架</a>
        </script>

        <div class="layui-footer">
            <div id="demo7"></div>
        </div>


        <div id="tan" style="display: none;margin-top: 20px" >
            <form class="layui-form" >
                <div class="layui-form-item">
                    <label class="layui-form-label">物品名称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" lay-verify="pass"  placeholder="请输入物品名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">物品数量</label>
                    <div class="layui-input-inline">
                        <input type="text" id="number" name="number" lay-verify="pass"  placeholder="请输入物品数量" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">物品价格</label>
                    <div class="layui-input-inline">
                        <input type="text" id="price" name="price" lay-verify="pass"  placeholder="请输入物品价格" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">入库时间</label>
                    <div class="layui-input-inline">
                        <input type="text" id="warehous_time" name="warehous_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>

        <div id="ei" style="display: none;margin-top: 20px" >
            <form class="layui-form" >
<!--                <div class="layui-form-item">-->
<!--                    <label class="layui-form-label">物品名称</label>-->
<!--                    <div class="layui-input-inline">-->
<!--                        <input type="text" id="name" name="name" lay-verify="pass"  placeholder="请输入物品名称" autocomplete="off" class="layui-input">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="layui-form-item">
                    <label class="layui-form-label">物品数量</label>
                    <div class="layui-input-inline">
                        <input type="text" id="number" name="number" lay-verify="pass"  placeholder="请输入物品数量" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">物品价格</label>
                    <div class="layui-input-inline">
                        <input type="text" id="price" name="price" lay-verify="pass"  placeholder="请输入物品价格" autocomplete="off" class="layui-input">
                    </div>
                </div>
<!--                <div class="layui-form-item">-->
<!--                    <label class="layui-form-label">入库时间</label>-->
<!--                    <div class="layui-input-inline">-->
<!--                        <input type="text" id="warehous_time" name="warehous_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">-->
<!--                    </div>-->
<!--                </div>-->
            </form>
        </div>


        <div class="layui-footer">
            <div id="demo7"></div>
        </div>

        <script type="text/javascript">
            layui.use('laydate', function() {
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#warehous_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
            });
            layui.use('table', function(){
                var table = layui.table;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/Warehouse/warehouse',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips'
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                        {field: 'name', title: '物品名称' },
                        {field: 'number', title: '物品数量' },
                        {field: 'price', title: '物品价格' },
                        {field: 'warehous_time', title: '入库时间' },
                        {field: 'company_id', title: '公司' },
                        {field: 'audit', title: '请假审批',templet:function (d) {
                            if (d.audit==0) {  // 自定义内容
                                return "<span style='color: green'>物品在架</span>";
                            } else if (d.audit==1) {
                                return "<span style='color: red'>物品下架</span>";
                            }
                        }},
                        {fixed: 'right', title:'操作', toolbar: '#barDemo'}
                    ]],
                    id: 'testReload'
                    ,page: true
                    ,height: 'full-50'
                }),
                    //监听行工具事件
                    table.on('tool(test)', function(obj){
                        var data = obj.data;
                        if(obj.event === 'agree'){
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.open({
                                    skin: 'layui-layer-molv',
                                    btn: ['确定', '取消'],
                                    area: ['500px', '300px'],
                                    formType:2,
                                    title:'编辑信息详情',
                                    content:$('#ei'),
                                    shade:0,
                                    type:1,
                                    yes: function(index){
                                        $.post('./?s=admin/Warehouse/warehouse_update', {
                                            id:data.id,
//                                            name:data.name,
                                            number:data.number,
                                            price:data.price,
//                                            warehous_time:data.warehous_time
                                        },function (type) {
                                            layer.msg(type.data);
                                            layui.table.reload('testReload');
                                        },'json')
                                        layer.close(index)//如果设定了yes回调，需进行手工关闭
                                    },
                                })
                            })
                        }else if(obj.event === 'refuse'){
                            layer.confirm('是否确定下架？', function(index){
                                $.post('?s=admin/Warehouse/update2',{id:data.id,audit:data.audit})
                                layer.close(index);
                                layui.table.reload('testReload');
                            });
                        }else if(obj.event === 'fuse'){
                            layer.confirm('是否确定下架？', function(index){
                                $.post('?s=admin/Warehouse/update1',{id:data.id,audit:data.audit})
                                layer.close(index);
                                layui.table.reload('testReload');
                            });
                        }
                    }),

                    $(document).on('click','#insert',function(){
                        layui.use('layer', function (){
                            var layer = layui.layer;
                            layer.open({
                                skin: 'layui-layer-molv',
                                area: ['500px', '300px'],
                                type:1,
                                btn:['确定','取消'],
                                shade:.0,
                                content: $('#tan'),
                                yes: function (index) {
                                    $.post('?s=admin/Warehouse/warehouse_insert', {
                                        name:$('#name').val(),
                                        number:$('#number').val(),
                                        price:$('#price').val(),
                                        warehous_time:$('#warehous_time').val(),
                                    }, function (type) {
                                        layer.msg(type.data);
                                        layui.table.reload('testReload');
                                    },'json')
                                    layer.close(index)
                                }
                            })
                        })
                    }),


                    // 执行搜索，表格重载
                    $(document).on('click','#check',function(){
                        // 搜索条件
                        var send_name = $('#id').val();
                        table.reload('testReload', {
                            method: 'get'
                            , where: {
                                'send_name': send_name
                            }
                            , page: {
                                curr: 1
                            }
                        })
                    }),
                    //面包屑显示
                    layui.use('element', function(){
                        var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
                        //监听导航点击
                        element.on('nav(demo)', function(elem){
                            //console.log(elem)
                            layer.msg(elem.text());
                        })
                    });
            })
        </script>
</body>
</html>