<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<!--    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">-->
<!--    <script src="./public/layui-v2.5.5/layui/layui.js"></script>-->
<!--    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>-->
    <?php include_once "./app/admin/view/punchin/index.php";?>
</head>
<style>
#aa{
    color: red;;
}
</style>

<div style="margin-top:150px">
    <tr>
        <th><button type="button" class="layui-btn layui-btn-lg" id="up">上班打卡</button></th>
        <th><button type="button" class="layui-btn layui-btn-lg" id="db">下班打卡</button></th>

        <th><button type="button"class="layui-btn layui-btn-lg layui-btn-danger" id="bu" value="<?php echo date('H:i:s',time())?>"onclick="list3(this.value)" >补卡</button></th>


        <div id="bk" style="display: none;margin-top:65px">
            <div style=" text-align:center" class="layui-form-item">姓名 <input type="text" value="<?php echo $_SESSION['admin']['name'] ?>" id="name"  name="name" style="width: 150px;height:30px;margin-left:20px "></div>
<!--            <div style=" text-align:center" class="layui-form-item">原因<input type="text"id="reasons"name="reasons" style="width: 150px;height:30px;margin-left:23px "></div>-->

           <textarea rows="3" cols="20"type="text"id="reasons"name="reasons" style="width: 350px;height:100px;margin-left:95px ">
补卡原因：
</textarea>

        </div>
    </tr>
</div>
<table id="demo" lay-filter="test"></table>
<script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(function () {
    layui.use('table', function() {
        $('#up').click(function () {

            $.ajax({
                dataType:'json',
                url:"./?s=admin/Punchin/upb",

                success:function(data){
                    layer.msg(data.data)
                }
            })
        })

        $('#db').click(function () {
            $.ajax({
                dataType:'json',
                url:"./?s=admin/Punchin/dbb",

                success:function(data){
                    layer.msg(data.data)
                }
            })
        })

    })
});

    function list3(value) {
        layui.use('table', function() {
            var datt=$("#bu").val();

          layer.open({
              skin: 'layui-layer-molv',
              btn: ['提交', '取消'],
              area: ['500px', '400px'],
              formType:2,
              title:'提交补卡申请',
              content:$('#bk'),
              icon:0,
              shade:.0,
              type:1,
              yes: function(index){
                  $.post('./?s=admin/Punchin/buk', {name:$("#name").val(),reasons:$("#reasons").val()},function (index) {
                          layer.msg(index.data)
                           layui.table.reload('testReload');
                      },'json')

                  layer.close(index)
              },
          })
        })
     }
layui.use('table', function() {
    var table = layui.table;
    table.render({
        elem: '#demo',//指定表格元素
        url: './?s=admin/Punchin/ddd',//请求路径
        toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
        defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
            title: '提示',
            layEvent: 'LAYTABLE_TIPS',
            icon: 'layui-icon-tips',
            cellMinWidth: 80
        }],
        cols: [[ //表头
            {type: 'numbers', title: '序号', width: 80, sort: true, fixed: 'left'},
            {field: 'name', title: '员工名字'},
            {field: 'start', title: '上班打卡时间',templet:function (d) {


//                return '+a+';
                return   new Date(parseInt(d.start) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ')
            }},
            {field: 'end', title: '下班打卡时间'},
        ]],
        id: 'testReload'
        , page: true
        , height: 630
    });
});
</script>

</body>
</html>