<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 物质申请 - Layui</title>
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
          <a><cite>物质申请</cite></a>
        </span>

        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>

        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <button class="layui-btn" data-type="reload" id="insert">申请</button>
<!--                <button class="layui-btn" data-type="reload" id="delete">一键清空</button>-->
            </div>
        </script>


        <div id="qj" style="display: none;margin-top: 20px">
            <form class="layui-form" >
                <div class="layui-form-item">
                    <label class="layui-form-label">申请人</label>
                    <div class="layui-input-inline">
                        <input type="text" id="apply_name" name="apply_name" value="<?php echo $_SESSION['admin']['name'] ?>"  lay-verify="pass" placeholder="请输入申请人" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">申请部门</label>
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
                <div class="layui-form-item">
                    <label class="layui-form-label">物品名称</label>
                    <div class="layui-input-block" style="width: 190px">
                        <select id="name1">
                            <option value=""></option>
                            <?php foreach ($date['warehous'] as $val){
                                ?>
                                <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
                                <?php
                            }?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">仓库数量</label>
                    <div class="layui-input-block" style="width: 190px">
                        <select id="number">
                            <option value=""></option>
                            <?php foreach ($date['warehous'] as $val){
                                ?>
                                <option value="<?php echo $val['id']?>"><?php echo $val['name']?><?php echo $val['number']?></option>
                                <?php
                            }?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">申请数量</label>
                    <div class="layui-input-inline">
                        <input type="text" id="number1" name="number" lay-verify="pass" placeholder="请输入物质数量" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">申请时间</label>
                    <div class="layui-input-inline">
                        <input type="text" id="apply_time" name="apply_time" lay-verify="pass" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">申请原因</label>
                    <div class="layui-input-block" >
                        <textarea id="reason" placeholder="请输入申请原因" class="layui-textarea"></textarea>
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
                    elem: '#apply_time'
                    ,min: 0
                    ,max: 365
                    ,type: 'datetime'
                });
            });
            layui.use('table', function(){
                var table = layui.table;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/Apply/apply',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips',
                        skin: 'layui-layer-molv',
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:80,  fixed: 'left'},
                        {field: 'apply_name', title: '申请人' },
                        {field: 'department_id', title: '申请部门' },
                        {field: 'name', title: '物品名称' },
                        {field: 'number', title: '申请数量' },
                        {field: 'apply_time', title: '申请时间' },
                        {field: 'reason', title: '申请原因' },
                        {field: 'audit', title: '申请状态',templet:function (d) {
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
                                    $.post('?s=admin/Apply/apply_insert', {
                                        apply_name:$('#apply_name').val(), name:$('#name1').val(),number:$('#number1').val(),apply_time:$('#apply_time').val(),
                                       reason:$('#reason').val(), company_id:$('#company_id').val(),department_id:$('#department_id').val()
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