// $(function () {
//     new Vue({
//         el:'#app',
//         data:{
//             a:4555,
//             b:1,
//             controller:45,
//             d:{
//                 a:22,
//                 b:'dfg',
//                 controller:544,
//             },
//             e:{background:'#f00',
//             },
//             f:{
//                 borderred:true,
//                 bordergreen:false,
//             }
//         },
//         watch:{
//             'f.borderred':function (val,aa) {
//                 console.log(val)
//             }
//         },
//         methods:{
//             k:function (data) {
//                 this.f.bordergreen=data
//                 this.f.borderred=!data
//             }
//         }
//     })
// })

function lunbo(id) {
    function echo(data) {
        console.log(data)
    }
    if($(id).length==1){
        this.height=typeof $(id).attr('height')=='undefined'?$(id).find('img').eq(0).height():$(id).height
        this.width=typeof $(id).attr('width')=='undefined'?$(id).find('img').eq(0).width():$(id).width

        var img=[]
        $(id).find('img').each(function (index,val) {
            img.push({src:$(val).attr('src')})
        })
        this.img=img
        $(id).replaceWith('<div id="'+$(id).attr('id')+'" :style="style" style="'+$(id).attr('style')+'"></div>')
        $(id).html('<ul @mouseover="over" :style="ulstyle"><li :style="[listyle,view]" style="float: left" view-for="(view,k,i) in li"></li></ul>')
        if(this.img.length>0){
            this.vue=new Vue({
                el:id,
                data:{
                    init:{
                        height:this.height,
                        width:this.width,
                        margin:'0',
                    },
                    margin:'0',
                    imgIndex:0,
                    widthList:8,
                    heightList:5,
                    height:this.height,
                    width:this.width,
                    img:this.img,
                    li:[],
                    ulstyle:{
                        height:this.height+'px',
                        width:this.width+'px',
                    }
                },
                created:function(){
                    for(var i=0;i<this.widthList*this.heightList;i++){
                        this.li.push({
                            backgroundPositionX:((i%(this.widthList))*(this.width/this.widthList)*-1)+'px',
                            backgroundPositionY:(Math.floor(i/this.widthList)*(this.height/this.heightList)*-1)+'px',
                        })
                    }
                },
                computed:{
                    style:function () {
                        return{
                            height:this.height+'px',
                            width:this.width+'px',
                            margin:'100px auto',
                        }
                    },
                    listyle:function () {
                        var height=this.height/this.heightList
                        var width=this.width/this.widthList
                        return{
                            height:height+'px',
                            width:width+'px',
                            margin:this.margin+'px',
                            backgroundSize:this.width+'px '+this.height+'px',
                            backgroundImage:'url("'+this.img[this.imgIndex].src+'")',
                        }
                    },
                },
                methods:{
                    over:function () {
                        this.margin=5
                        this.ulstyle={
                        position:'relative',
                        height:parseInt(this.init.height)+(this.margin*2*this.heightList)+'px',
                        width:parseInt(this.init.width)+(this.margin*2*this.widthList)+'px',
                        top:-(this.margin*2*this.heightList)/2+'px',
                        left:-(this.margin*2*this.widthList)/2+'px',
                        }
                    },
                }
            })
            var bb=this.vue

            setInterval(function () {
                if(bb.imgIndex==3){
                    bb.imgIndex=-1
                }
                bb.imgIndex=++bb.imgIndex
            },1000)
        }
    }else {
        echo(2%20)
    }
}