<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="Chrome=1,IE=edge">
	<title>清风博客-用户登录</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/login-register.css">
	<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/login-register.js"></script>
	<script>
	 //改变验证码
	 var URL = '<?php echo U(GROUP_NAME . "/Login/verify");?>/';
	 function change_code(obj){
	 	$('#verify').attr("src",URL + Math.random());
	 	return false;
	 }
	 //注册按钮点击
	$(function(){
		$('#singup-click').click( function() {
			location.href = '<?php echo U(GROUP_NAME . "/Login/register");?>';
		});
	});
	
	</script>
</head>
<body style="background:#E5DDD0">
	<div id="container" style="background:#E5DDD0;margin-top: 30px;">
	    <div class="blog-logo"></div>
		<div id="signin" class="rl-modal in" aria-hidden="false">
		<div class="rl-modal-header">
		<h1>
			<span class="active-title">登录</span>
			<span data-fromto="signin:signup" id="singup-click">注册</span>
		</h1>
		<button type="button" class="rl-close" data-dismiss="modal" hidefocus="true" aria-hidden="true"></button>
		</div>
		<div class="rl-modal-body">
			<div class="clearfix">
			<div class="l-left-wrap l">
				<form action="<?php echo U(GROUP_NAME . '/Login/index');?>" method="post" id="signin-form" onsubmit="return checkUser();">
					<p class="rlf-tip-globle " id="signin-globle-error"></p>
					<div class="rlf-group">
						<input type="text" name="username"  autocomplete="off" class="ipt ipt-email js-own-name" placeholder="请输入登录邮箱或手机号码">
						<p class="rlf-tip-wrap"></p>
					</div>
					<!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
					<input style="display:none" type="text" name="fakeusernameremembered">
					<input style="display:none" type="password" name="fakepasswordremembered">
					<div class="rlf-group">
						<input type="password" name="password" autocomplete="off" class="ipt ipt-pwd" placeholder="请输入密码">
						<p class="rlf-tip-wrap"></p>
					</div>
					<div class="rlf-group js-verify-row clearfix">
					    <input type="text" name="verify" class="ipt ipt-verify l" placeholder="请输入验证码">
					    <a href="javascript:void(change_code(this));" class="verify-img-wrap js-verify-refresh"><img class="verify-img" src="<?php echo U(GROUP_NAME . '/Login/verify');?> " id="verify"></a>
			    		<a href="javascript:void(change_code(this));" class="icon-refresh js-verify-refresh"></a>
						<p class="rlf-tip-wrap"></p>
					</div>
					<div class="rlf-group rlf-appendix clearfix">
						<label for="auto-signin" class="rlf-autoin l" hidefocus="true"><input type="checkbox" checked="checked" class="auto-cbx" id="auto-signin">下次自动登录</label>
						<a href="<?php echo U(GROUP_NAME . '/Login/forgot');?>" class="rlf-forget r" hidefocus="true">忘记密码 </a>
					</div>
					<div class="rlf-group clearfix">
						<input type="submit" id="signin-btn" value="登录" hidefocus="true" class="btn-red btn-full">
					</div>
			    </form>
			</div>
			</div>
		</div>
		<div class="rl-model-footer" style="display:none">
		<div class="pop-login-sns clearfix">
			<span class="l">其他方式登录</span>
			<a href="javascript:void(0)" hidefocus="true" data-login-sns="/passport/user/tplogin?tp=weibo" class="pop-sns-weibo r"><i class="icon-weibo"></i></a>
			<a href="javascript:void(0)" hidefocus="true" data-login-sns="/passport/user/tplogin?tp=qq" class="pop-sns-qq r"><i class="icomoon qq"></i></a>
			<a href="javascript:void(0)" hidefocus="true" data-login-sns="/passport/user/tplogin?tp=weixin" class="pop-sns-weixin r"><i class="icomoon weixin"></i></a>
		</div>
		</div>
		</div> 
	</div>
</body>
</html>