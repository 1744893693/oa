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
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
    <legend><?php  ?>日志</legend>
</fieldset>
<ul class="layui-timeline">
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis"></i>
        <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title"> <?php echo date("Y-m-d H:i:s",time()); ?></h3>
            <p>
                <?php  foreach ($data as $k) {?>
                    <?php echo $k['name']?>
                    <?php echo $k['start']?>
                <?php } ?>
<!--                <i class="layui-icon"></i>-->
            </p>
        </div>
    </li>

</body>
</html>