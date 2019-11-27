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
<div style="margin-top:150px">
    <tr>
        <th><button type="button" class="layui-btn layui-btn-lg" id="up">上班打卡</button></th>
        <th><button type="button" class="layui-btn layui-btn-lg" id="db">下班打卡</button></th>

        <th><button type="button"class="layui-btn layui-btn-lg layui-btn-danger" id="bu" value="<?php echo date('H:i:s',time())?>"onclick="list3(this.value)" >补卡</button></th>


        <div id="bk" style="display: none;margin-top:65px">
            <div style=" text-align:center" class="layui-form-item">姓名 <input type="text" id="name"              name="name" style="width: 150px;height:30px;margin-left:20px "></div>
            <div style=" text-align:center" class="layui-form-item">原因<input                              type="text"id="reasons"name="reasons" style="width: 150px;height:30px;margin-left:23px "></div>
        </div>
    </tr>
</div>
<script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(function () {
    layui.use('table', function() {
        $('#up').click(function () {
            $.ajax({url:"./?s=admin/Punchin/upb",
                success:function(data){
                    layer.msg(data.data)
                }
            })
        })

        $('#db').click(function () {
            $.ajax({url:"./?s=admin/Punchin/dbb",
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
              skin:'layer-open',
              btn: ['提交', '取消'],
              area: ['500px', '300px'],
              formType:2,
              title:'提交补卡申请',
              content:$('#bk'),
              icon:0,
              shade:.0,
              type:1,
              yes: function(index){
                  $.post('./?s=admin/punchin/buk', {name:$("#name").val(),reasons:$("#reasons").val()},function (index) {
                          layer.msg('提交补卡申请成功')
                          // layui.table.reload('testReload');
                      }
                  )
                  layer.close(index)
              },
          })
        })
    }


</script>

</body>
</html>