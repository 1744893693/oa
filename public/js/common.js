//打开字滑入效果
window.onload = function(){
	$(".connect p").eq(0).animate({"left":"0%"}, 600);
	$(".connect p").eq(1).animate({"left":"0%"}, 400);
};
//jquery.validate表单验证
$(document).ready(function(){
	//注册表单验证
    $("#registerForm").validate({
		rules:{
            company_name:{
                required:true,//必填
                minlength:3, //最少6个字符
                maxlength:20,//最多20个字符
            },
			username:{
				required:true,//必填
				minlength:2, //最少6个字符
				maxlength:12,//最多20个字符
			},
			password:{
				required:true,
				minlength:6,
				maxlength:32,
                digits:true,

			},
		},
		//错误信息提示
		messages:{
            company_name:{
                required:"必须填写公司名",
                minlength:"公司名至少为3个任意字符",
                maxlength:"公司名至多为20个任意字符",
                remote: "公司名已存在",
            },
			username:{
				required:"必须填写用户名",
				minlength:"用户名至少为2个任意字符",
				maxlength:"用户名至多为12个任意字符",
				remote: "用户名已存在",
			},
			password:{
				required:"必须填写密码",
				minlength:"密码至少为6个数字字符",
				maxlength:"密码至多为32个数字字符",
                digits:"必须填写数字"
			},
		 },
        submitHandler:function (form) {
            $('.submit').click(function () {
                $.ajax({
                    url: './?s=admin/Register/company',
                    data:{company_name:$('#company_name').val(),username:$('#username').val(),password:$('#password').val()},
                    type:'post',
                    dataType:'json',
                    success:function(data) {
                        alert('公司申请成功，请耐心等待！')
						window.location.href='./?s=admin/register/init'
                    }
                })
            })
        },
        invalidHandler: function(form, validator) {return false;}
	});

	//添加自定义验证规则
	// jQuery.validator.addMethod("phone_number", function(value, element) {
	// 	var length = value.length;
	// 	var phone_number = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/
	// 	return this.optional(element) || (length == 11 && phone_number.test(value));
	// }, "手机号码格式错误");
});
