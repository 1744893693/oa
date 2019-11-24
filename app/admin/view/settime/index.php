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
    <div class="layui-inline">
        <label class="layui-form-label">时间选择器</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test14" placeholder="请选择上班时间">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">时间选择器</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test15" placeholder="请选择下班时间">
        </div>
    </div>
    <button type="button" class="layui-btn layui-btn-lg">确认</button>
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
                    url:'./?s=admin/Settime/settime',
                    data:{
                        towork:towork,
                        offwork:offwork
                    },
                    success:function(res){
                            layer.msg('设置成功');
                        }
                    })

            })

        })

    })
</script>
</body>
</html>