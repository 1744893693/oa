<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>公司注册</title>
    <link rel="stylesheet" href="./public/css/style.css" />
<body>
<div class="register-container">
    <h1>公司系统注册网</h1>
    <div class="connect">
        <p>●洪福齐天●一统网吧●</p>
    </div>
    <form action="" method="post" id="registerForm">
        <div>
            <input id="company_name" type="text" name="company_name" class="username" placeholder="公司名字" autocomplete="off"/>
        </div>
        <div>
            <input id="username" type="text" name="username" class="username" placeholder="法人名字" autocomplete="off"/>
        </div>
        <div>
            <input id=account type="text" name="account" class="account" placeholder="输入账号" oncontextmenu="return false" onpaste="return false" />
        </div>
        <button type="person" class="submit">注 册</button>
    </form>
</div>
<script src="./public/js/jquery.min.js"></script>
<script src="./public/js/common.js"></script>
<!--背景图片自动更换-->
<script src="./public/js/supersized.3.2.7.min.js"></script>
<script src="./public/js/supersized-init.js"></script>
<!--表单验证-->
<script src="./public/js/jquery.validate.min.js?var1.14.0"></script>
<script type="text/javascript">
    $(function () {
        $(document).keydown(function(event){
            if (event.keyCode==13) {
                $(".submit").click();
            }
        })
    })
</script>
</body>
</html>