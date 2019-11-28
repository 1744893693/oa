<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 菜单 - Layui</title>
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
  <a><cite>职位管理</cite></a>
       </span>

       <table id="demo" lay-filter="test"></table>
       <table class="layui-hide" id="test" lay-filter="test" style="height:100%"></table>

</div>

       <script type="text/html" id="toolbarDemo">
           <div class="demoTable">
               <button class="layui-btn" data-type="reload" id="jia">添加功能菜单</button>
<!--               <div class="layui-inline">-->
<!--                   <input class="layui-input" name="id" id="demoReload" autocomplete="off">-->
<!--               </div>-->

<!--           </div>-->
       </script>

       <script type="text/html" id="barDemo">
           <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
           <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
       </script>
       </div>

       <div id="tan" style="display: none;margin-top: 20px">
           <form class="layui-form" >
               <div class="layui-form-item">
                   <label class="layui-form-label">选择部门</label>
                   <div class="layui-input-block" style="width: 250px">
                       <select id="edit_department">
                           <?php foreach ($date['department'] as $val){
                               ?>
                               <option value="<?php echo $val['id']?>"><?php echo $val['department_name']?></option>
                               <?php
                           }?>
                       </select>
                   </div>
               </div>
           </form>
       </div>

       <div id="plus" style="display: none;margin-top: 20px">
<!--           <div style=" text-align:center;margin-top: 80px;" >职位昵称 <input type="text" id="position_namepuls"  name="position_name"style="width: 150px;height: 30px"></div>-->
           <form class="layui-form" >
               <div class="layui-form-item" >
                   <label class="layui-form-label">选择功能</label>
                   <div class="layui-input-block" style="width: 250px">
                       <select  id="menu" >
                           <?php foreach ($date['menu'] as $val){
                               ?>
                               <option value="<?php echo $val['id']?>"><?php echo $val['menu_name']?></option>
                               <?php
                           }?>
                       </select>
                   </div>
               </div>
               <div class="layui-form-item">
                   <label class="layui-form-label">选择部门</label>
                   <div class="layui-input-block" style="width: 250px">
                       <select id="department">
                           <?php foreach ($date['department'] as $val){
                               ?>
                               <option value="<?php echo $val['id']?>"><?php echo $val['department_name']?></option>
                               <?php
                           }?>
                       </select>
                   </div>
               </div>
           </form>
       </div>


       <script type="text/javascript">

           layui.use('table', function(){
               var table = layui.table;
               table.render({
                   elem: '#demo',//指定表格元素
                   url: './?s=admin/Menu/menu_list',//请求路径
//                   method: 'POST',
//                   where:{},
                   toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板

                   defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                       title: '提示',
                       layEvent: 'LAYTABLE_TIPS',
                       icon: 'layui-icon-tips'
                   }],
                   cols: [[ //表头
//                       {field:'id',type:'checkbox',sort: true},
                       { type: 'numbers', title: '序号' , width:80, fixed: 'left'},
                       {field: 'menu_name', title: '菜单名'},
                       {field: 'department_name', title: '所属部门',sort: true},
                       {fixed: 'right', title:'操作', toolbar: '#barDemo',align: 'right'}
                   ]],
                   id: 'testReload'
                   ,page: true
                   ,height: 'full-50',
               }),

                   //监听行工具事件
                   table.on('tool(test)', function(obj){
                       var data = obj.data;
                       if(obj.event === 'del'){
                           if(data.menu_name=='菜单管理'){
                               layer.msg('此功能为系统默认功能，禁止此危险操作')
                               return false
                           }
                           layer.confirm('请确认是否删除'+data.menu_name+"功能?", {
                               skin:'layui-layer-molv',
                           },function(index){

                               $.post('./?s=admin/Menu/del',{id:data.id},function (date) {
                                   if(date) layer.msg(data.menu_name+'功能删除成功')
                               })

                               layer.close(index);
                               layui.table.reload('testReload');
                           });
                       }  else if(obj.event === 'edit'){
                           layui.use('layer', function(){
                               var layer = layui.layer;

                               layer.open({
                                   skin:'layui-layer-molv',
                                   btn: ['修改', '取消'],
                                   area: ['450px', '300px'],
                                   formType:2,
                                   title:'修改功能所属部门',
                                   content:$('#tan'),
                                   shade:0,
                                   type:1,
                                   yes: function(index){
                                       var editid=$('#edit_department').val()
                                       var dename=$('#edit_department').find("option:selected").text();
                                       $.post('./?s=admin/Menu/edit', {id:data.id,did:editid},function (date) {
                                           if(date) layer.msg('已经修改'+data.department_name+'所属部门为'+dename)
                                       })
                                       layer.close(index)
                                       layui.table.reload('testReload');
                                   },
                               })
                           })
                       }
                   })

               $(document).on('click','#jia',function(){

                   layui.use('layer', function() {
                       var layer = layui.layer;
//                       $('#form').css('display','block')
                       layer.open({
                           skin: 'layui-layer-molv',
                           btn: ['确定', '取消'],
                           area: ['450px', '465px'],
                           formType: 2,
                           title:'添加功能菜单',
                           content: $('#plus'),
                           shade: 0,
                           type: 1,
                           yes: function (index) {
                               var menu_id=$('#menu').val()
                               var de_id=$('#department').val()
                               var mmame=$('#menu').find("option:selected").text();
                               $.post('./?s=admin/Menu/add_menu', {menu_id:menu_id,department_id:de_id,mmame:mmame}, function (date) {
                                   layer.msg(date)
                                   layui.table.reload('testReload');
                               })
                               layer.close(index)
                           }
                       })
                   })
               })
               //面包屑显示
               layui.use('element', function(){
                   var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块

                   //监听导航点击
                   element.on('nav(demo)', function(elem){
                       //console.log(elem)
                       layer.msg(elem.text());
                   });
               })
           })
       </script>
</body>
</html>