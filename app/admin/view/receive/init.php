<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 任务接收 - Layui</title>
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
          <a><cite>任务接收</cite></a>
        </span>

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

<!--        <script type="text/html" id="toolbarDemo">-->
<!--            <div class="demoTable">-->
<!--                <button class="layui-btn" data-type="reload" id="insert">接收任务</button>-->
<!--            </div>-->
<!--        </script>-->

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="refuse">领取</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="agree">提交</a>
        </script>

        <div id="rw" style="display: none;margin-top: 20px">
            <form class="layui-form" >
                <div class="layui-form-item">
                    <label class="layui-form-label">任务发布人</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['admin']['name'] ?>"  lay-verify="pass"  autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">任务名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="test_name" name="test_name" lay-verify="pass" placeholder="请输入任务名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">发布时间</label>
                    <div class="layui-input-inline">
                        <input type="text" id="release_time" name="release_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">截止时间</label>
                    <div class="layui-input-inline">
                        <input type="text" id="submission_time" name="submission_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">任务内容</label>
                    <div class="layui-input-inline">
                        <input type="text" id="test_content" name="test_content" lay-verify="pass" placeholder="请输入任务内容" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>

        <div class="layui-footer">
            <div id="demo7"></div>
        </div>

        <script type="text/javascript">

            layui.use('laydate', function() {
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#release_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
                laydate.render({
                    elem: '#submission_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
            });

            layui.use('table', function(){
                var table = layui.table;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/Receive/receive',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips',
                        skin: 'layui-layer-molv',
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                        {field: 'test_name', title: '任务名' },
                        {field: 'release_time', title: '发布时间' },
                        {field: 'submission_time', title: '截止时间' },
                        {field: 'test_content', title: '任务内容' },
                        {field: 'audit', title: '任务详情',templet:function (d) {
                            if (d.audit==0) {  // 自定义内容
                                return "<span style='color: red'>待完成</span>";
                            } else if (d.audit==1) {
                                return "<span style='color: green'>已审批</span>";
                            }else if(d.audit==2){
                                return "<span style='color: red'>已驳回</span>";
                            }else if(d.audit==3){
                                return "<span style='color: yellowgreen'>已提交</span>";
                            }else if(d.audit==4){
                                return "<span style='color: darkgrey'>已领取</span>";
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
                            layer.confirm('是否确定提交？', function(index){
                                $.post('?s=admin/Receive/update', {
                                    id:data.id,audit:data.audit
                                },function (v) {
                                        layer.msg(v.data);
                                        layui.table.reload('testReload');
                                },'json')
                                layer.close(index);
                            });
                        }else if(obj.event === 'refuse'){
                                layer.confirm('是否确定领取？', function(index){
                                    $.post('?s=admin/Receive/update1', {
                                        id:data.id,audit:data.audit
                                    },function (v) {
                                        layer.msg(v.data);
                                        layui.table.reload('testReload');
                                    },'json')
                                    layer.close(index);
                                });
                            }
                    }),



//                    $(document).on('click','#insert', function(){
//                        layui.use('layer', function(){
//                            var layer = layui.layer;
//                            layer.open({
//                                skin: 'layui-layer-molv',
//                                area: ['650px', '450px'],
//                                type:2,
//                                btn:['确定','取消'],
//                                content:'?s=admin/Test/test',
//                                shade:.0,
//                                yes: function(index){
//                                    $.post('?s=admin/Test/test', {
////                                        test_name:$('#test_name').val(),release_time:$('#release_time').val(),submission_time:$('#submission_time').val(),
////                                        test_content:$('#test_content').val()
//                                    },function (v) {
////                                        layer.msg(v.data);
////                                        layui.table.reload('testReload');
//                                    },'json')
//                                    layer.close(index)//如果设定了yes回调，需进行手工关闭
//                                },
//
//                            })
//                        })
//                    }),

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