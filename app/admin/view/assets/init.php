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
<form class="layui-form"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
    <div  class="layui-form-item">
        <label class="layui-form-label">公司钱包</label>
        <div style="line-height: 38px;margin-left: 100px;color: red;font-size: 20px" id="money"></div>
    </div>
    <div  class="layui-form-item">
        <label class="layui-form-label">迟到处罚</label>
        <div style="line-height: 38px;margin-left: 100px;color: red;font-size: 20px" id="late"></div>
    </div>
    <div  class="layui-form-item">
        <label class="layui-form-label">旷工处罚</label>
        <div style="line-height: 38px;margin-left: 100px;color: red;font-size: 20px" id="obsent"></div>
    </div>
    <div class="layui-form-item" style="display: none;margin-top: 30px" id="wallet_set">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <input type="text" name="" placeholder="请输入" autocomplete="off" class="layui-input" style="width: 200px" id="wallet_input">
        </div>
    </div>
    <div class="layui-form-item" style="display: none;margin-top: 30px" id="late_set">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <input type="text" name="" placeholder="请输入" autocomplete="off" class="layui-input" style="width: 200px" id="late_input">
        </div>
    </div>
    <div class="layui-form-item" style="display: none;margin-top: 30px" id="obsent_set">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <input type="text" name="" placeholder="请输入" autocomplete="off" class="layui-input" style="width: 200px" id="obsent_input">
        </div>
    </div>
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">下拉选择框</label>-->
<!--        <div class="layui-input-block">-->
<!--            <select name="interest" lay-filter="aihao">-->
<!--                <option value="0">写作</option>-->
<!--                <option value="1">阅读</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">复选框</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="checkbox" name="like[write]" title="写作">-->
<!--            <input type="checkbox" name="like[read]" title="阅读">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">开关关</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="checkbox" lay-skin="switch">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">开关开</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="checkbox" checked lay-skin="switch">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">单选框</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="radio" name="sex" value="0" title="男">-->
<!--            <input type="radio" name="sex" value="1" title="女" checked>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-form-item layui-form-text">-->
<!--        <label class="layui-form-label">请填写描述</label>-->
<!--        <div class="layui-input-block">-->
<!--            <textarea placeholder="请输入内容" class="layui-textarea"></textarea>-->
<!--        </div>-->
<!--    </div>-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <div class="layui-btn" lay-submit lay-filter="*" id="wallet_bu">公司钱包充值</div>
            <button class="layui-btn" lay-submit lay-filter="*" id="late_bu">设置迟到处罚</button>
            <button class="layui-btn" lay-submit lay-filter="*" id="obsent_bu">设置旷工处罚</button>
<!--            <button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
        </div>
    </div>
    <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
<script>


        layui.use('layer', function(){
            var layer = layui.layer;
            $.post('./?s=admin/Assets/wallet',function (data) {
                if(data.wallet==null){
                    $('#money').html('钱包空空如也')
                    $('#late').html('请设置处罚')
                    $('#obsent').html('请设置处罚')
                    layer.msg('请添加公司基本财务信息')
                }else {
                    $('#money').html(data.wallet)
                    $('#late').html(data.late_money)
                    $('#obsent').html(data.obsent_money)
                }
                $('#late_input').val()
                $('#obsent_input').val()
                $('#wallet_bu').click(function () {
                    layer.open({
                        skin: 'layui-layer-molv',
                        btn: ['确定', '取消'],
                        area: ['400px', '200px'],
                        formType:2,
                        title:'公司钱包充值',
                        content:$('#wallet_set'),
                        icon:0,
                        shade:.0,
                        type:1,
                        yes: function(index){
                            if($('#wallet_input').val()){
                                $.post('./?s=admin/Assets/update_w',{wallet:$('#wallet_input').val()},function (data) {
                                    if(data){ layer.msg('成功充值'+$('#wallet_input').val()+'元') }

                                })
                            }else {
                                layer.msg('金额不能为空')
                            }
                            layer.close(index)
                        },
                    })
//
                    return false
                })

                $('#late_bu').click(function () {
                    layer.open({
                        skin: 'layui-layer-molv',
                        btn: ['确定', '取消'],
                        area: ['400px', '200px'],
                        formType:2,
                        title:'迟到处罚设置',
                        content:$('#late_set'),
                        icon:0,
                        shade:.0,
                        type:1,
                        yes: function(index){
                            if($('#late_input').val()){
                                $.post('./?s=admin/Assets/update_l',{late:$('#late_input').val()},function (data) {
                                    if(data){ layer.msg('迟到处罚成功设置为'+$('#late_input').val()+'元') }
                                })
                            }else {
                                layer.msg('金额不能为空')
                            }
                            layer.close(index)
                        },
                    })
                    return false
                })

                $('#obsent_bu').click(function () {
                    layer.open({
                        skin: 'layui-layer-molv',
                        btn: ['确定', '取消'],
                        area: ['400px', '200px'],
                        formType:2,
                        title:'旷工处罚设置',
                        content:$('#obsent_set'),
                        icon:0,
                        shade:.0,
                        type:1,
                        yes: function(index){
                            if($('#obsent_input').val()){
                                $.post('./?s=admin/Assets/update_o',{obsent:$('#obsent_input').val()},function (data) {
                                    if(data){ layer.msg('旷工处罚成功设置为'+$('#obsent_input').val()+'元') }
                                })
                            }else {
                                layer.msg('金额不能为空')
                            }
                            layer.close(index)
                        },
                    })
//
                    return false
                })
            },'json')


        })





//    layui.use('form', function(){
//        var form = layui.form;
//
//        //各种基于事件的操作，下面会有进一步介绍
//    });
</script>
</body>
</html>