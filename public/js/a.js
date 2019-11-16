$(function () {
    $('body').append('<div id="topDiv"></div>')
    $('#topDiv').append('<div class="bgDiv"></div><div class="demo2" ></div><div class="demo3" ></div>').css({
        height:'170px',
        backgroundImage:'url("./public/img/header.png")',
        backgroundPosition:'top center'
    })
    $('.bgDiv').append('<div ></div><div ></div><div class="qiu"></div>')
    $('.bgDiv>div').css({
        height:'42px',
        width:'100%',
        position: 'absolute',
        top:'0px',
    })
    $('.bgDiv>div:first-child').css({
        backgroundImage:'url("./public/img/header.png")',
        backgroundPosition:'top center',
        filter:'blur(2px)',
        zIndex:'0',
    })
    $('.bgDiv>div:nth-child(2)').css({
        background:'rgba(255,255,255,0.3)',
        zIndex:'1',
    })
    $('.bgDiv>div:nth-child(2)').append('<div class="top-center" ></div>')
    $('.top-center').css({
        width:'980px',
        margin:'0px auto',
        height:'100%',
    })
    $('.top-center').append('<div class="left"></div><div class="right"></div>')
    $('.left').css({
        height:'42px',
        float:'left',
    })
    $('.right').css({
        height:'42px',
        float:'right',
    })
    $('.left').append('<ul></ul>')
    $('.left>ul').css({
        height:'42px',
    })

    $.post('./home.php/?s=home/top',function (data) {
        var result=eval(('('+data+')'))
        for( val of result){
            $('.left>ul').append('<li><a href="'+val[2]+'">'+val[1]+'</a></li>')
            $('.left>ul>li').css({
                height:'42px',
                float:'left',
                lineHeight:'42px',
                position:'relasive',
            })
            $('.left>ul>li>a').css({
                height:'42px',
                padding:'0 7px',
                display:'block',
                lineHeight:'42px',
                color:'#222',
                fontSize:'12px',
                textDecoration: 'none',
            })
            // $('.left>ul>li').last().css('position','absolute')
            $('.left>ul>li').mouseover(function () {
                $(this).css({
                    background:'rgba(255,255,255,0.4)',
                })
                if($(this).find('div').length){
                    $(this).find('div').addClass('am')
                    $(this).find('div').css('display','block')
                }
            })
            $('.left>ul>li').mouseout(function () {
                $(this).css({
                    background:'none',
                })
                    $(this).find('div').removeClass('am')
                    $(this).find('div').css('display','none')
            })

        }
        $('.left>ul>li').last().append('<div class="er"><img alt=""></div>')
        $('.er').css({
            backgroundImage:'url(./public/img/erweima.png)',
            backgroundPosition:'top center',
            width:'259px',
            height:'174px',
            position:'absolute',
            top:'42px',
            left:'470px',
            display:'none',
        })
        $('.er>img').attr('src','./public/img/app.png')
        $('.er>img').css({
            width:'97px',
            height:'97px',
            position:'absolute',
            top:'32px',
            left:'82px',
        })
    })
    $('.right').append('<ul></ul>')
    $('.right>ul').css({
        height:'42px',
    })
    $('.right>ul').append('<li class="photo"><img  alt=""></li>')
    $('.right>ul').append('<li class="rightData"><a href="https://www.bilibili.com/">动态</a></li>')
    $('.right>ul').append('<li class="rightData"><a href="https://www.bilibili.com/">历史</a></li>')
    $('.right>ul').append('<li class="rightData"><a href="https://www.bilibili.com/">创作中心</a></li>')
    $('.right>ul').append('<li class="send"><a href="https://www.bilibili.com/">投稿</a></li>')
    $('.right>ul>li').css({
        float:'left',
        position:'relasive',
        height:'42px',
        lineHeight:'42px',

    })
    $('.photo>img').attr('src','./public/img/photo.jpg')
    $('.photo>img').css({
        height:'32px',
        marginTop:5,
        borderRadius:'50%',
    })
    $('.rightData>a').css({
        height:'42px',
        padding:'0 10px ',
        lineHeight:'42px',
        display:'block',
        color:'#222',
        fontSize:'12px',
        textDecoration: 'none',
    })
    $('.rightData').mouseover(function () {
        $(this).css({
            background:'rgba(255,255,255,0.4)',
        })
    })
    $('.rightData').mouseout(function () {
        $(this).css({
            background:'none',
        })
    })
    $('.send>a').css({
        height:'46px',
        width:'68px',
        background:'#f45a8d',
        borderRadius:'0 0 5px 5px',
        display:'block',
        lineHeight:'42px',
        textAlign:'center',
        color:'#fff',
        fontSize:'14px',
        textDecoration: 'none',
    })
    $('.bgDiv>div:last').css({
        height:'170px',
        width:'980px',
        position:'relative',
        margin:'0px auto'
    })
    $('.qiu').append('<div class="left"></div><div class="right"></div>')
    $('.qiu>.left').css({
        height:'105px',
        width:'220px',
        background:'url(./public/img/qiu.png)',
        position:'absolute',
        top:'55px',
        left:'24px',
    })

    $('.qiu>.right').css({
        height:'32px',
        width:'268px',
        backgroundColor:'#e5e9ef',
        backgroundColor: 'rgba(0,0,0,.12)',
        position:'absolute',
        padding: '2px 2px 2px 72px',
        borderRadius: 6,
        fontSize: 12,
        bottom:'20px',
        right:'0px',
    })
    $('.qiu>.right').append('<a><span>排行榜</span></a><form action=""><input type="text"><button></button></form>')
    $('.qiu>.right>a').css({
        position: 'absolute',
        left: '2px',
        top: '2px',
        height: '32px',
        lineHeight: '32px',
        backgroundColor: '#fff',
        backgroundColor: 'hsla(0,0%,100%,.88)',
        borderRadius: '4px',
        width: '68px',
        transition: 'backgroundColor .2s',
    })
    $('.qiu>.right>a>span').css({
        paddingLeft: '26px',
        color: '#f25d8e',
        display: 'Block',
        background: 'url(./public/img/icons.png) -659px -655px no-repeat',
        textDecoration: 'none',
    })
    $('.qiu>.right>form').css({
        backgroundColor: '#fff',
        backgroundColor: 'hsla(0,0%,100%,.88)',
        display: 'block',
        height: '32px',
        borderRadius: '4px',
        transition: 'backgroundColor .2s',
    })
    $('.qiu>.right>form>input').css({
        float: 'left',
        width: '200px',
        color:' #222',
        fontSize: '12px',
        overflow: 'hidden',
        height: '32px',
        lineHeight: '32px',
        padding: '0 12px',
        border: '0',
        boxShadow: 'none',
        backgroundColor: 'transparent',
    })
    $('.qiu>.right>form>button').css({
        display:'block',
        position:'absolute',
        right:'0',
        width:'48px',
        minWidth:'0',
        cursor:'pointer',
        height:'32px',
        background:'url(./public/img/icons.png) -653px -720px',
        margin:'0',
        padding:'0',
        border:'0',
    })
    $('.demo2').css({
        height:'59px',
        width: '980px',
        margin: '0 auto',
    })
    $('.demo2').append('<div></div>')
    $('.demo2>div').css({
        position: 'relative',
        width: '980px',
        height: '50px',
        padding: '15px 0 0',
        margin: '0 auto 4px',
        zIndex: '99',
        borderBottom: '1px solid #fff',
    })
    $('.demo2>div').append('<ul class="muen"></ul>').css({
        position: 'relative',
        zIndex: '200',
        height: '42px',
        color: '#222',
    })
    $('.demo2>div').append('<div class="gif"><a href=""><img src="" alt=""></a></div>')
    $('.gif').css({
        position: 'absolute',
        background:'green',
        right: 0,
        top: 0,
        width: '60px',
        height: '50px',
        padding: '4px 0',
    })
    $.post('./home.php/?s=home/mune',function (data) {

        var mune=eval(('('+data+')'))
        $('.muen').append('<li clas="home"><a class="yi" href="https://www.bilibili.com/"><div class="shou">首页</div></a></li>')
        for( val of mune){
            // $('.muen').append('<li>'+val[1]+'</li>')
            $('.muen').append('<li clas="home"><a href="https://www.bilibili.com/"><div><span class="ss">'+val[3]+'</span></div><div class="zhi">'+val[1]+'</div></a></li>')
            $('.muen>li').css({
                float: 'left',
                width: '46px',
                height: '48px',
                textAlign: 'center',
                display: 'block',
                position: 'relative',
                marginRight: '0',
            })
            $('.ss').css({
                display: 'inlineBlock',
                // verticalAlign: 'top',
                marginTop:'20px',
                fontSize: '12px',
                transform: 'scale(.85)',
                color:' #fff',
                backgroundColor: '#ffafc9',
                borderRadius: '3px',
                height: '12px',
                lineHeight: '14px',
                maxWidth: '28px',
                padding: 'auto 3px',
                fontFamily: 'sansSerif,sansSerifsansSerif,Calibri,Arial,Helvetica',
            })
            $('.muen>li>a').css({
                textDecoration: 'none',
            })
        }

        $('.muen>li:first').css({
            marginRight:'8px',
            width: '24px',
            top:'0px'
        })
        $('.yi').css({
            width: 'auto',
            display: 'block',
            background: 'url(./public/img/icons.png) -660px -1176px no-repeat',
        })
        $('.shou').css({
            display: 'inlineBlock',
            verticalAlign: 'middle',
            color: '#222',
            fontSize: '12px',
            height: '40px',
            paddingTop: '2px',
            lineHeight: '50px',
        })
    })
    $('.demo3').css({
        width:'980px',
        height:'11111px',
        margin:'0 auto'
    })
    $.post('./home.php/?s=home/data',function (data) {
        var data=eval(('('+data+')'))
        $('.demo3').append('<div class="first"></div>')
        $('.first').append('<div class="fleft"></div><div class="frihgt"></div>')
        for(val of data){
            $('.demo3').append('<div>'+val[1]+'</div>')

        }
        $('.demo3>div').css({
            height:'260px',
            paddingBottom:'40px',
            background: '#5EA964',
        })
        $('.first').css({
            height:'260px',
            paddingBottom:'40px',
        })
        $('.fleft').css({
            width: 440,
            background: '#5E5564',
            height: 220,
            float: 'left',
            position:'relative',
            top:0,

        })
        $('.fleft').append('<ul class="pic"></ul><ul class="trit"></ul>')
        $('.pic').css('position','relative')
        $.post('./home.php/?s=home/fpx',{table:'data_copy'},function (data) {
            var mune=eval(('('+data+')'))
            var m=0
            var n=4

            for (val of mune){
                $('.trit').append('<li class="li'+ n-- +'"></li>')

                $('.pic').append('<li class="li'+ m++ +'"><img style="width: 440px; height: 220px" src="'+val[2]+'" alt=""><a href="#">'+val[1]+'</a></li>')
            }
            $('.trit>li').css({
                width: '18px',
                height: '18px',
                backgroundImage: 'url(./public/img/icons.png)',
                backgroundPosition: '-855px -790px',
                backgroundColor: 'transparent',
                transition: 'none',
                float:'right',
                marginLeft:'8px',
            })
            $('.trit>.li0').css('backgroundPosition','-855px -727px')
            $('.trit').css({
                position: 'absolute',
                zIndex: '3',
                bottom: '6px',
                right: '20px',
            })

            var i=0
            setInterval(function () {
                $('.trit>.li'+(i))
                if(i==4){
                    $('.trit>.li'+(i)).css('backgroundPosition', '-855px -790px')
                    $('.pic>.li'+i).css('display','none')
                    i=-1
                    $('.trit>.li'+i).css('backgroundPosition', '-855px -727px')
                    $('.pic>.li'+i).css('display','block')
                }
                $('.trit>.li'+i).css('backgroundPosition', '-855px -790px')
                $('.pic>.li'+i).css('display','none')
                i++
                $('.trit>.li'+i).css('backgroundPosition','-855px -727px')
                $('.pic>.li'+i).css('display','block')
            },3000)

            $('.pic>li>a').css({
                zZndex: '2',
                position: 'absolute',
                bottom: 0,
                left: 0,
                color:'#fff',
                width: '100%',
                height: '35px',
                lineHeight: '35px',
                background: 'rgba(0,0,0,.5)',
                fontSize: '14px',
                textDecoration: 'none',
            })
            $('.pic>li').css({
                width:'440px',
                height:'220px',
                display:'none',

            })
            $('.pic>li:first').css({
                display:'block'
            })


            $('.fleft>.pic')
            $('.fleft>.pic').css({
                width: '500%',
                marginLeft: '0%',
                height:'220px',
            })


        })

        $('.frihgt').css({
            width: 540,
            background: '#533564',
            height: 220,
            float: 'right',
        })




    })





})
