<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 任务发布 - Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body>
        <span class="layui-breadcrumb">
          <a href="">首页</a>/
          <a><cite>任务发布</cite></a>
        </span>

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" value="" name="id" id="id" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
                <button class="layui-btn" data-type="reload" id="insert">发布</button>
                <button class="layui-btn" data-type="reload" id="delete">一键清空</button>
            </div>
        </script>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="agree">接收</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="refuse">驳回</a>
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
                        <input type="text" id="release_time" name="release_time" lay-verify="required" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">截止时间</label>
                    <div class="layui-input-inline">
                        <input type="text" id="submission_time" name="submission_time" lay-verify="required" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
<!--                <div class="layui-form-item">-->
<!--                    <label class="layui-form-label">发布时间</label>-->
<!--                    <div class="layui-input-inline">-->
<!--                        <input id="release_time" type="text" name="kaishi" required lay-verify="required" placeholder="请选择" autocomplete="off" class="layui-input">-->
<!--                    </div>-->
<!--                    <div class="layui-form-mid layui-word-aux">-->
<!--                        <span style="color: rgba(255,10,30,0.5)">* 必填项</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="layui-form-item">-->
<!--                    <label class="layui-form-label">截止时间</label>-->
<!--                    <div class="layui-input-inline">-->
<!--                        <input id="submission_time" type="text" name="jieshu" required lay-verify="required" placeholder="请选择" autocomplete="off" class="layui-input">-->
<!--                    </div>-->
<!--                    <div class="layui-form-mid layui-word-aux">-->
<!--                        <span style="color: rgba(255,10,30,0.5)">* 必填项</span>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="layui-form-item">
                    <label class="layui-form-label">选择部门</label>
                    <div class="layui-input-block" style="width: 190px">
                        <select id="department_id">
                            <option value=""></option>
                            <?php foreach ($date['department'] as $val){
                                ?>
                                <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                                <?php
                            }?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">任务内容</label>
                    <div class="layui-input-block" >
                        <textarea id="test_content" name="test_content" placeholder="请输入任务内容" class="layui-textarea"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="layui-footer">
            <div id="demo7"></div>
        </div>

        <script type="text/javascript">
            $(function () {
                function maxDate() {
                    var now = new Date();
                    return now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
                }
                function tim(){
                    alert($('#release_time').val());
                    return  $('#release_time').val()
                }
                layui.use('laydate', function(){
                    var laydate = layui.laydate;
                    laydate.render({
                        elem: '#release_time', //指定元素
                        calendar: true,
                        min: maxDate(),
                        type: 'datetime',
                        done: function(value, date, endDate){
                            laydate.render({
                                elem: '#submission_time' ,//指定元素
                                calendar: true,
                                min: value,
                                type: 'datetime'
                            });
                        }
                    });
                });
            });
//            layui.use('laydate', function() {
//                var laydate = layui.laydate;
//                laydate.render({
//                    elem: '#release_time'
//                    ,min: 0
//                    ,max: 365
//                    ,type: 'datetime'
//                });
//                laydate.render({
//                    elem: '#submission_time'
//                    ,min: 0
//                    ,max: 365
//                    ,type: 'datetime'
//                });
//            });

            layui.use('table', function(){
                var table = layui.table;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/Test/test',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips',
                        skin: 'layui-layer-molv',
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                        {field: 'name', title: '任务发布人' },
                        {field: 'test_name', title: '任务名' },
                        {field: 'release_time', title: '发布时间' },
                        {field: 'submission_time', title: '截止时间' },
                        {field: 'department_id', title: '任务部门' },
                        {field: 'test_content', title: '任务内容' },
                        {field: 'audit', title: '任务详情',templet:function (d) {
                            if (d.audit==0) {  // 自定义内容
                                return "<span style='color: red'>待领取</span>";
                            } else if (d.audit==1) {
                                return "<span style='color: green'>已接收</span>";
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
                        if(obj.event === 'refuse'){
                            layer.confirm('是否确定驳回？', function(index){
                                $.post('?s=admin/Test/update1', {
                                    id:data.id,audit:data.audit
                                }, function (type) {
                                    layer.msg(type.data);
                                    layui.table.reload('testReload');
                                },'json')
                                layer.close(index)
                            })
                        }else if(obj.event === 'agree'){
                            layer.confirm('是否确定接收？', function(index){
                                $.post('?s=admin/Test/update2', {
                                    id:data.id,audit:data.audit
                                }, function (type) {
                                    layer.msg(type.data);
                                    layui.table.reload('testReload');
                                },'json')
                                layer.close(index)
                            });
                        }
                    }),



                    $(document).on('click','#insert', function(){
                        layui.use('layer', function(){
                            var layer = layui.layer;
                            layer.open({
                                skin: 'layui-layer-molv',
                                area: ['600px', '600px'],
                                type:1,
                                btn:['确定','取消'],
                                content:$('#rw'),
                                shade:.0,
                                yes: function(index){
                                    $.post('?s=admin/Test/test_insert', {
                                        test_name:$('#test_name').val(),release_time:$('#release_time').val(),submission_time:$('#submission_time').val(),
                                        test_content:$('#test_content').val(),department_id:$('#department_id').val(),company_id:$('#company_id').val()
                                    },function (v) {
                                        layer.msg(v.data);
                                        layui.table.reload('testReload');
                                    },'json')
                                    layer.close(index)//如果设定了yes回调，需进行手工关闭
                                },
                            })
                        })
                    }),

                    $(document).on('click','#delete', function(){
                        layer.confirm("是否清除所有信息?", function(index){
                            $.ajax({
                                url:"./?s=admin/Test/delete",
                                success:function(){
                                    layui.table.reload('testReload');
                                }
                            })
                            layer.close(index);
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