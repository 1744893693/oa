<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>设置上下班打卡时间</title>
    <style type="text/css">
        #times{
            width: 200px;
            height: 20px;
            border: 3px solid gray;  /*如果不加实线无法显示边框*/
            text-align:center;
        }
        .layui-laydate-content > .layui-laydate-list {
            padding-bottom: 0px;
            overflow: hidden;
        }
        .layui-laydate-content > .layui-laydate-list > li {
            width: 50%
        }

    </style>
</head>
<link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
<script src="./public/layui-v2.5.5/layui/layui.js"></script>
<script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
<body>
<div id="times">
</div>
<script type="text/javascript">
    //得到时间并写入div
    function getDate(){
        //获取当前时间
        var date = new Date();
        //格式化为本地时间格式
        var date1 = date.toLocaleString();
        //获取div
        var div1 = document.getElementById("times");
        //将时间写入div
        div1.innerHTML = date1;
    }
    //使用定时器每秒向div写入当前时间
    setInterval("getDate()",1000);
</script>
<label class="layui-form-label"style="margin-top: 50px">设置上下班时间</label>
<div class="layui-input-inline">
    <input type="text" class="layui-input" name="test0" id="test0" placeholder=" - " style="margin-top: 50px">
</div>
    <script type="text/javascript">
        layui.use(['element', 'form','laydate'], function () {
            var laydate = layui.laydate;
//时间范围
            laydate.render({
                elem: '#test0'
                , type: 'time'
                , range: true
                , format: 'H:mm'
            })
        })
    </script>
</body>
</html>













