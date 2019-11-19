<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<!doctype html>-->
<!--<html lang="en">-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 登录 - Layui</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body class="b">
<table>
<div class="lg">
    <form action="" >
        <div class="lg_top"></div>
        <div class="lg_main">
            <div class="lg_m_1">
                <div id="a">
                    <input id="name"  class="ur" placeholder="请输入账号">
                </div>
                <div id="b">
                    <input  id="pwd"  class="pw" placeholder="请输入密码">
                </div>
                <div id="c">
                    <input  id="yzm"  class="vc" placeholder="请输入验证码">
                </div>

            <div >
                <img src="./yzm.php" class="yz"  alt="" onclick="this.setAttribute('src','http://127.0.0.1/oa/yzm.php')">
            </div>

        <div class="lg_foot">
            <div  value="Login In" class="bu">登录</div>
        </div>
            </div>
        </div>
    </form>
</div>

<div style="text-align:center;">

</div>
<script src="./public/layui-v2.5.5/layui/layui.js"></script>
<script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(function () {

        function packaging(input, Regular,ss) {
            var zen = $('#' + input).val()
            var ze = Regular;
            var comparison = ze.test(zen)
            var change = document.querySelector('#' + ss)
            if (comparison == false) {
                change.style.borderColor = 'red'
                return false;
            }
            else {
                change.style.borderColor = 'green'
                return true;
            }
        }
        $('#name').keyup(function () {
            packaging('name', /^[0-9A-Za-z]{6,24}$/,'a')
        })
        $('#pwd').keyup(function () {
            packaging('pwd', /^0-9A-Za-z]{6,24}$/,'b')
        })
        $('#yzm').keyup(function () {
            packaging('yzm', /^[0-9a-zA-Z]{4}$/,'c')
        })


        $('.bu').click(function () {
                var name = $('#name').val();
                var pwd = $('#pwd').val();
                var yzm = $('#yzm').val();
            $.ajax({
                    url: './?s=admin/Login/login',
                    data: {name:name,pwd:pwd,yzm:yzm},
                    dataType:'json',
                    type:'post',
                    success:function (type) {

                            alert(type.data)
                            window.location.href="./?s=admin/home/init"
                    },
                    error:function (type) {
                }
                })
        })
        $(document).keydown(function(event){
            if (event.keyCode==13) {
                $(".bu").click();
            }
        })
    })


</script>
</table>
</body>
</html>










