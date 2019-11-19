<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>网站后台内容管理系统登录登陆界面模板 - 站长素材</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="public/css/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <!-- Loding font -->
    <!-- Custom Styles -->

</head>
<body>


<!-- Backgrounds -->

<div id="login-bg" class="container-fluid">
    <div class="bg-color"></div>
    <div class="bgr-color"></div>
</div>

<!-- End Backgrounds -->

<div class="container" id="login">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login" style="text-align: center">

                <h1>注册</h1>

                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="公司名字">
                    </div>
                    <div class="form-group">
                        <input type="teXt" class="form-control" id="exampleInputPassword1" placeholder="公司所有人">
                    </div>
                    <br>
                     <button id="registerid" type="submit" class="btn btn-lg btn-block btn-success">注册</button>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $(function () {
            $('#exampleInputEmail1').keyup(function () {
                var names = $('#exampleInputEmail1').val()
                var pan = /^[\u4e00-\u9fa5]{4,8}$/
                var tee = pan.test(names)
                if (tee == false){  //错误变红色
                    $('#exampleInputEmail1').parent().css("border","3px solid #f00")
                    $('#exampleInputEmail1').parent().css("border-radius","30px 30px 30px 30px")
                    return false
                }
                if (tee == true){  //正确变绿色
                    $('#exampleInputEmail1').parent().css("border","3px solid #0f0")
                    $('#exampleInputEmail1').parent().css("border-radius","30px 30px 30px 30px")
                    return true
                }

            })
            $('#exampleInputPassword1').keyup(function () {
                var names = $('#exampleInputPassword1').val()
                var pan = /^[\u4e00-\u9fa5]{2,5}$/
                var tee = pan.test(names)
                if (tee == false){  //错误变红色
                    $('#exampleInputPassword1').parent().css("border","3px solid #f00")
                    $('#exampleInputPassword1').parent().css("border-radius","30px 30px 30px 30px")
                    return false
                }
                if (tee == true){  //正确变绿色
                    $('#exampleInputPassword1').parent().css("border","3px solid #0f0")
                    $('#exampleInputPassword1').parent().css("border-radius","30px 30px 30px 30px")
                    return true
                }

            })


            $(document).keydown(function () {
                if (event.keyCode == "13"){
                    $('#registerid').click();
                }
            })
            var a1=$('#exampleInputEmail1').val()
            var b2=$('#exampleInputPassword1').val()

            $('#registerid').click(function () {
                $.ajax({
                    url:'./?s=oa/Index/company',
                    data:{a1:a1,b2:b2},
                    type:'post',
                    dataType:'json',
                    success:function(aha) {
                        alert(aha)
                        window.location.href='./?s=admin/login/init'
                    }
                })
            })
        })
    </script>

</body>
</html>