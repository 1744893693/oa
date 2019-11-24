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
    <script type="text/javascript" src="./public/js/extend/miaov.js"></script>
</head>

<style type="text/css">
    *{

        margin: 0;
        padding:0;
        font-family: "微软雅黑";
    }
    ul{
        list-style: none;
        /*position: relative;*/
        top:30px;
        left: 30px;
    }
    ul li{
        position: absolute;
        top:0;
        overflow: hidden;
        width: 56px;
        height: 92px;
    }
    ul li img{
        display: block;
        position: absolute;
    }
    ul li .pic01{
        top:0;
    }
    ul li .pic02{
        top:92px;
    }
</style>

<body>


<ul id="panel">
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
    <li>
        <img src="">

    </li>
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
    <li>
        <img src="">

    </li>
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
    <li>
        <img src="" class="pic01"> <img src="" class="pic02">
    </li>
</ul>
<script type="text/javascript">
    window.onload=function(){
        var arr=['public/img/0.png','public/img/1.png','public/img/2.png','public/img/3.png','public/img/4.png','public/img/5.png','public/img/6.png','public/img/7.png','public/img/8.png','public/img/9.png','public/img/mao.png',]
        var panel=document.getElementById("panel");
        var aLi=panel.getElementsByTagName("li");
        var nTime=null;
        var str=null;
        var nstr;
        for(var i=0;i<aLi.length;i++){
            aLi[i].style.left=56*i+'px';
        }

        function showTime1(){
            var iNow=new Date();
            var nHours=iNow.getHours();
            var nMinutes=iNow.getMinutes();
            var nSecondes=iNow.getSeconds();
            str=toTwo(nHours)+':'+toTwo(nMinutes)+':'+toTwo(nSecondes);
        }

        function showTime2(){
            var iNow=new Date();
            nTime=iNow.getTime()+1000;
            iNew=new Date(nTime);
            var tHours=iNew.getHours();
            var tMinutes=iNew.getMinutes();
            var tSecondes=iNew.getSeconds();
            nstr=toTwo(tHours)+':'+toTwo(tMinutes)+':'+toTwo(tSecondes);
        }

        showTime1();
        showTime2();
        setInterval(function(){
            showTime1();
            showTime2();
        },1000);

        function initial(aLi){
            for(var i=0;i<aLi.length;i++){
                if(i!=2&&i!=5){
                    aLi[i].getElementsByTagName("img")[0].src=arr[str.charAt(i)];
                    aLi[i].getElementsByTagName("img")[1].src=arr[nstr.charAt(i)];
                }else{
                    aLi[i].getElementsByTagName("img")[0].src=arr[10];
                }
            }
        }
        initial(aLi);

        timeRoll(aLi,0);
        timeRoll(aLi,1);
        timeRoll(aLi,3);
        timeRoll(aLi,4);
        timeRoll(aLi,6);
        timeRoll(aLi,7);

        function timeRoll(obj,i){
            setInterval(function(){
                var pNumber=str.charAt(i);
                var tNumber=nstr.charAt(i);
                var pImg=obj[i].getElementsByTagName("img")[0];
                var nImg=obj[i].getElementsByTagName("img")[1];
                if(pNumber!==tNumber&&parseInt(getStyle(nImg,'top'))==92){

                    nImg.src=arr[nstr.charAt(i)];
                    doMove(nImg,'top',5,0,function(){

                    });
                    doMove(pImg,'top',5,-92,function(){
                        pImg.style.top='92px';
                        pImg.src=arr[str.charAt(i)];

                    });

                }else if(pNumber!==tNumber&&parseInt(getStyle(pImg,'top'))==92){

                    pImg.src=arr[nstr.charAt(i)];
                    doMove(pImg,'top',5,0,function(){

                    });
                    doMove(nImg,'top',5,-92,function(){
                        nImg.style.top='92px';
                        nImg.src=arr[str.charAt(i)];

                    });
                }
            },1000)
        };

    }

</script>
</body>
</html>