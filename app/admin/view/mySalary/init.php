<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 员工管理 - Layui</title>
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
          <a href="/demo/">演示</a>
          <a><cite>我的工资</cite></a>
        </span>



        <table id="demo" lay-filter="test" style="height: 100%;width: 100%"></table>
        <table class="layui-hide" id="test" lay-filter="test"></table>
        <div id="permission" style="display: none">
            <form class="layui-form" style="margin: 30px 30px 0 30px">
                <?php $j=0; foreach ($data['department'] as $department){
                ?>
                <div style="margin-top: 25px"><?php echo $department['name']?></div>
                <hr class="layui-bg-green">
                <?php
                $i=0;
                foreach ($data['menu'] as $menu){
                    if($menu['department_id']==$department['id']){
                        $j++;
                        $i++;
                        ?>
                        <input  type="checkbox" name="mes" value="<?php  echo $menu['functional_group_id']?>" id="fun<?php echo $j ?>" title="<?php  echo $menu['menu_name']?>"
                        <hr class="layui-bg-green">
                        <?php
                    }
                }
                if(!$i) { ?><div style="height: 30px"><?php echo $department['name'].'暂未添加任何功能';}
                    }?></div>
                <hr class="layui-bg-green">


                <!--                <input type="checkbox" name="" title="写作" lay-skin="primary" checked>-->
                <!--                <input type="checkbox" name="" title="发呆" lay-skin="primary">-->
            </form>
        </div>
        <script type="text/html" id="toolbarDemo">
            <div class="demoTable">
                <div class="layui-inline">
                    <input class="layui-input" value="" name="id" id="id" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload" id="check">搜索</button>
<!--                <button class="layui-btn" data-type="reload" id="insert">生成上月工资信息</button>-->
            </div>
        </script>

<!--        <script type="text/html" id="barDemo">-->
<!--            <!--            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="permission">详细</a>-->-->
<!--            <a class="layui-btn layui-btn-xs" lay-event="edit">发放</a>-->
<!--        </script>-->

        <!--        <div id="yg" style="display: none;margin-top: 20px">-->
        <!--            <form class="layui-form" >-->
        <!--                <div class="layui-form-item">-->
        <!--                    <label class="layui-form-label">账号</label>-->
        <!--                    <div class="layui-input-inline">-->
        <!--                        <input type="text" id="name1" name="name1" lay-verify="pass" placeholder="请输入账号" autocomplete="off" class="layui-input">-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="layui-form-item">-->
        <!--                    <label class="layui-form-label">密码</label>-->
        <!--                    <div class="layui-input-inline">-->
        <!--                        <input type="text" id="pwd" name="pwd" lay-verify="pass" value="111111" placeholder="请输入密码" autocomplete="off" class="layui-input">-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="layui-form-item">-->
        <!--                    <label class="layui-form-label">选择部门</label>-->
        <!--                    <div class="layui-input-block" style="width: 190px">-->
        <!--                        <select id="department_id">-->
        <!--                            <option value=""></option>-->
        <!--                            --><?php //foreach ($date['department'] as $val){
        //                                ?>
        <!--                                <option value="--><?php //echo $val['id']?><!--">--><?php //echo $val['name']?><!--</option>-->
        <!--                                --><?php
        //                            }?>
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="layui-form-item">-->
        <!--                    <label class="layui-form-label">选择职位</label>-->
        <!--                    <div class="layui-input-block" style="width: 190px">-->
        <!--                        <select id="position_id">-->
        <!--                            <option value=""></option>-->
        <!--                            --><?php //foreach ($date['position'] as $val){
        //                                ?>
        <!--                                <option value="--><?php //echo $val['id']?><!--">--><?php //echo $val['position_name']?><!--</option>-->
        <!--                                --><?php
        //                            }?>
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->


        <div class="layui-footer">
            <div id="demo7"></div>
        </div>


        <script type="text/javascript">
            layui.use(['table','form'], function(){
                var table = layui.table;
                var form=layui.form;
                table.render({
                    elem: '#demo',//指定表格元素
                    url: './?s=admin/MySalary/employees',//请求路径
                    toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
                    defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips'
                    }],
                    cols: [[
                        { type: 'numbers', title: '序号' , width:70, sort: true, fixed: 'left',style:'background-color: #eee;'},
                        {field: 'user_name', title: '名字', width:120 },
                        {field: 'month', title: '月份', },
                        {field: 'base_salary', title: '基本工资',align:'right',width:90, },
                        {field: 'other_salary', title: '其他工资',align:'right',width:90, },
                        {field: 'absenteeism', title: '旷工天数',align:'center',width:90, },
                        {field: 'late', title: '迟到早退',align:'center',width:90, },
                        {field: 'ready_salary', title: '实发工资',align:'right' ,width:90,},
                        {field: 'send_time', title: '发放时间',align:'center',width:100, templet:function (d) {
                            if (d.send_time=='未发放') {  // 自定义内容
                                return "<span style='color: red'>未发放</span>";
                            } else{
                                return '<span style="color: green">'+d.send_time+'</span>';
                            }
                        } },
                    ]],
                    id: 'testReload'
                    ,page: true
                    ,height: 'full-50',
                }),
                    //监听行工具事件
//                    table.on('tool(test)', function(obj){
//                        var data = obj.data;
//                        if(obj.event === 'del'){
//                            layer.confirm("是否删除该用户?", function(index){
//                                $.ajax({
//                                    url:"./?s=admin/Employees/employee",
//                                    type:'post',
//                                    data:{'id':data.id},//向服务端发送删除的id
//                                    success:function(type){
//                                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
//                                        layer.close(index);
////                                layer.msg(type.data);
//                                    }
//                                })
//                                layer.close(index);
//                            })
//                        } else if(obj.event === 'edit'){
//                            layui.use('layer', function(){
//                                var layer = layui.layer;
//                                if(data.ready_salary==0){
//                                    layer.msg(data.user_name+'没有可发的工资');
//                                    return false
//                                }
//                                if(data.send_time=='未发放'){
//                                    $.post('./?s=admin/Salary/em_update', {
//                                        id:data.id,
//                                        user_id:data.user_id,
//                                        salary:data.ready_salary,
//                                    },function (type) {
//                                        layer.msg(data.user_name+type);
//                                        layui.table.reload('testReload');
//                                    })
//                                }else {
//                                    layer.msg(data.user_name+'的工资已经发放，请不要重复发放');
//                                }
//
//                            })
//                        }
//                    }),

//                    $(document).on('click','#insert',function(){
//                        layui.use('layer', function (){
//                            var layer = layui.layer;
//                            $.post('?s=admin/Salary/sa_insert', function () {
//
//                                layui.table.reload('testReload');
//                            } )

//                            var loading = layer.load(0, {
//                                shade: false,
//                                time: 2*1000
//                            });


//                            layer.open({
//                                skin: 'layui-layer-molv',
//                                area: ['650px', '450px'],
//                                type:1,
//                                btn:['确定','取消'],
//                                shade:.0,
//                                content: $('#yg'),
//                                yes: function (index) {
//                                    $.post('?s=admin/Employees/em_insert', {
//                                        name: $('#name1').val(),
//                                        pwd: $('#pwd').val(),
//                                        department_id:$('#department_id').val(),
//                                        position_id:$('#position_id').val(),
//                                    }, function () {
//
//                                        layui.table.reload('testReload');
//                                    })
//                                    layer.close(index)
//                                }
//                            })
//                        })
//                    }),
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