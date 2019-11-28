<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
</head>
<body>
<div>
<span class="layui-breadcrumb">
  <a>公司打卡设置</a>
</span>
</div>
<div>
    <div class="layui-inline">
        <label class="layui-form-label">上班时间</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test14" placeholder="请选择上班时间"style="position: relative">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">下班时间</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test15" placeholder="请选择下班时间">
        </div>
    </div>
    <button type="button" class="layui-btn layui-btn-lg">确认</button>

      <div>
      <span class="layui-breadcrumb">
       <a>公司更名设置</a>
       </span>
       </div>
<div style=" text-align:center;float: left" class="layui-form-item">
    <input type="text" id="change"  name="change" style=" height:30px;margin-right:50px;">
</div>
<button type="button" class="layui-btn"id="que">确认</button>
      <div>
         <span class="layui-breadcrumb"style="margin-left: -225px">
          <a>公司法人设置</a>
         </span>
      </div>
    <div style=" text-align:center;float: left" class="layui-form-item">
 <input type="text" id="legal"  name="legal" style=" height:30px;margin-right:50px;">
    </div>
<button type="button" class="layui-btn"id="fa">确认</button>

<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var laydate = layui.laydate;

        laydate.render({
            elem: '#test14'
            ,type: 'time'
            ,format: 'H:m'
        });
        laydate.render({
            elem: '#test15'
            ,type: 'time'
            ,format: 'H:m'
        });
        $(function () {
            $('.layui-btn-lg').click(function () {
                var towork = $('#test14').val(),
                    offwork = $('#test15').val();
                if(towork ==''){
                    layer.msg('上班时间未设置');
                    return false;
                }
                if (offwork == ''){
                    layer.msg('下班时间未设置');
                    return false;
                }

                $.ajax({
                    type:'post',
                    url:'./?s=admin/CompanyTime/settime',
                    data:{
                        towork:towork,
                        offwork:offwork
                    },
                    success:function(res){
                            layer.msg('设置成功');
                        }
                    })
            })

            $("#que").click(function () {
                layui.use('layer', function () {
                    var layer = layui.layer;
                    var name = $("#change").val();
                    $.post("./?s=admin/CompanyTime/company", {name: name}, function (index) {
                        layer.msg('公司名称修改成功')

                    })
                })
            })
                $("#fa").click(function () {
                    layui.use('layer', function () {
                    var layer = layui.layer;
                    var name = $("#legal").val();
                    $.post("./?s=admin/CompanyTime/person", {name: name}, function (index) {
                        layer.msg('公司法人修改成功')
                    })
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
        });
    })

</script>
</body>
</html>