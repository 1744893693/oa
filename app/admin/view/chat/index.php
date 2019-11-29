<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./public/layui-v2.5.5/layui/css/layui.css">
    <script src="./public/layui-v2.5.5/layui/layui.js"></script>
    <script type="text/javascript" src="./public/js/extend/jquery-3.4.1.min.js"></script>
    <style type="text/css">
        .talk_con{
            width:600px;
            height:500px;
            border:1px solid #666;
            /*margin:50px auto 0;*/
            background:#f9f9f9;
        }
        .talk_show{
            width:580px;
            height:420px;
            border:1px solid #666;
            background:#fff;
            margin:10px auto 0;
            overflow:auto;
        }
        .talk_input{
            width:580px;
            margin:10px auto 0;
        }
        .whotalk{
            width:80px;
            height:30px;
            float:left;
            outline:none;
        }
        .talk_word{
            width:420px;
            height:26px;
            padding:0px;
            float:left;
            margin-left:10px;
            outline:none;
            text-indent:10px;
        }
        .talk_sub{
            width:56px;
            height:30px;
            float:left;
            margin-left:10px;
        }
        .atalk{
            margin:10px;
        }
        .atalk span{
            display:inline-block;
            background: #05ccae;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
        .btalk{
            margin:10px;
            text-align:right;
        }
        .btalk span{
            display:inline-block;
            background:#ef8201;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
    </style>
    <script type="text/javascript">
        //
        window.onload = function(){
            var Words = document.getElementById("words");
            var Who = document.getElementById("who");
            var TalkWords = document.getElementById("talkwords");
            var TalkSub = document.getElementById("talksub");
//            $("#duoren").click(function () {
//                style.display='none'
//            })
//            $("#danren").click(function () {
//                style.display='none'
//            })



            TalkSub.onclick = function(){
                //定义空字符串
                var str = "";
                if(TalkWords.value == ""){
                    // 消息为空时弹窗
                    alert("消息不能为空");
                    return;
                }

            $.ajax({
        url:"./?s=admin/Chat/chatname",
                dataType:"json",
                    success:function(data){
                        if(Who.value == 0) {
                            //如果Who.value为0n那么是 A说
                            str ='<div class="btalk"><span>'+data.data+'说：'+TalkWords.value +'</span></div>';
//                            console.log(str);
                        }else{
                            str = '<div class="atalk"><span>B说 :' + TalkWords.value +'</span></div>' ;
                        }
                        Words.innerHTML = Words.innerHTML + str;
                        var content=str
                        $.post("./?s=admin/Chat/contenttj",{content:content},$('#talkwords').val("")),location.reload();
                }
            })
        }
     }


    </script>
</head>
<body>
<div class="talk_con"style="width: 100%;height: 556px;position: relative">   <div align="center"><?php echo $gs ?></div>
    <div class="talk_show" id="words"style="width: 100%;height: 100%;" ><div id="duoren">多人聊天</div>
        <?php foreach ($data as $k) {?>
        <div class="atalk">
            <span id="asay">
<br>
        <?php echo $k['company_name'] ?>
        <?php echo $k['chat'] ?>
            </span>
    </div>
        <?php } ?>
    </div>
    <div class="talk_input">
        <select class="whotalk" id="who">
            <option value="0">我说：</option>
            <option value="1">B说：</option>
        </select>
        <input type="text" class="talk_word" id="talkwords">
        <input type="button" value="发送" class="talk_sub" id="talksub">
    </div>
</div>
</body>
</html>
