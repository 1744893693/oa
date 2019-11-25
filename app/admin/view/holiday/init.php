<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 申请假期 - Layui</title>
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
          <a><cite>申请假期</cite></a>
        </span>

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <button class="layui-btn" data-type="reload" id="insert">申请</button>
                <button class="layui-btn" data-type="reload" id="delete">一键清空</button>
            </div>
        </script>


        <div id="qj" style="display: none;margin-top: 20px">
            <form class="layui-form" >
            <div class="layui-form-item">
                <label class="layui-form-label">请假人</label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['admin']['name'] ?>"  lay-verify="pass" placeholder="请输入请假人" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">开始时间</label>
                <div class="layui-input-inline">
                    <input type="text" id="start_time" name="start_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">结束时间</label>
                <div class="layui-input-inline">
                    <input type="text" id="end_time" name="end_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">审批人</label>
                <div class="layui-input-block  " style="width: 190px" >
                    <select id="approver">
                    <!--                    <select  <input type="text" id="approver" name="approver" lay-verify="pass"  placeholder="请输入审批人" autocomplete="off" class="layui-input">>-->
                    <option value=""></option>
                    <option value="人事部经理">人事部经理</option>
                    <option value="老板">老板</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item project-hide"  >
                <label class="layui-form-label">请假类型</label>
                <div class="layui-input-block  " style="width: 190px">
                    <select id="type1">
<!--                    <select <input type="text" id="type1" name="type1" lay-verify="pass"  placeholder="请输入请假类型" autocomplete="off" class="layui-input">>-->
                        <option value=""></option>
                        <option value="事假">事假</option>
                        <option value="病假">病假</option>
                        <option value="产假">产假</option>
                        <option value="年假">年假</option>
                        <option value="其它">其它</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">请假原因</label>
                <div class="layui-input-inline">
                    <input type="text" id="reason" name="reason" lay-verify="pass" placeholder="请输入请假原因" autocomplete="off" class="layui-input">
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
                    alert($('#start_time').val());
                    return  $('#end_Time').val()
                }
                layui.use('laydate', function(){
                    var laydate = layui.laydate;
                    laydate.render({
                        elem: '#start_time', //指定元素
                        calendar: true,
                        min: maxDate(),
                        type: 'datetime',
                        done: function(value, date, endDate){
                            laydate.render({
                                elem: '#end_Time' ,//指定元素
                                calendar: true,
                                min: value,
                                type: 'datetime'
                            })
                        }
                    })
                })
            });

            layui.use('laydate', function() {
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#start_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
                laydate.render({
                    elem: '#end_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
            });
            layui.use('table', function(){
                var table = layui.table;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/Holiday/holiday',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips',
                        skin: 'layui-layer-molv',
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                        {field: 'name', title: '请假人' },
                        {field: 'start_time', title: '开始时间' },
                        {field: 'end_time', title: '结束时间' },
                        {field: 'approver', title: '审批人' },
                        {field: 'type', title: '请假类型' },
                        {field: 'reason', title: '请假原因' },
                        {field: 'audit', title: '请假审批',templet:function (d) {
                            if (d.audit==0) {  // 自定义内容
                                return "<span style='color: red'>未审批</span>";
                            } else if (d.audit==1) {
                                return "<span style='color: green'>已通过</span>";
                            }else if(d.audit==2){
                                return "<span style='color: red'>已拒绝</span>";
                            }
                        }}
                    ]],
                    id: 'testReload'
                    ,page: true
                    ,height: 'full-50'
                }),
                    $(document).on('click','#insert', function(){
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.open({
                                    skin: 'layui-layer-molv',
                                    area: ['650px', '450px'],
                                    type:1,
                                    btn:['确定','取消'],
                                    content:$('#qj'),
                                    shade:.0,
                                    yes: function(index){
                                        $.post('?s=admin/Holiday/holiday_insert', {
                                             name:$('#name').val(),start_time:$('#start_time').val(),end_time:$('#end_time').val(),
                                            approver:$('#approver').val(),type:$('#type1').val(),reason:$('#reason').val()
                                           },function () {

                                            layui.table.reload('testReload');
                                        })
                                        layer.close(index)//如果设定了yes回调，需进行手工关闭
                                    },
                                })
                            })
                    }),

                    $(document).on('click','#delete', function(){
                        layer.confirm("是否清除所有信息?", function(index){
                            $.ajax({
                                url:"./?s=admin/Holiday/delete",
                                success:function(){
                                    layui.table.reload('testReload');
                                }
                            })
                            layer.close(index);
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