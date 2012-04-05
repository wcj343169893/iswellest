<?php /* Smarty version 2.6.18, created on 2011-07-08 22:30:38
         compiled from user/login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/reg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/reg.js"></script>
</head>

<body onload="frm.reg_username.focus()">
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="index.html">首页</a> &gt; <span>登陆心云</span></p>
	<div class="login_quick">
		<div class="user_login">
			<h2 class="user_login_tit">登陆心云商城</h2>
			<ul id="user_login_type">
				<li class="active"><a href="javascript:void(0)">普通用户</a></li>
				<li><a href="javascript:void(0)">集团用户</a></li>
			</ul>
			<div id="user_login_type_list">
				<div class="user_login_form">
					<table align="center" border=0>
					<form action="<?php echo $this->_tpl_vars['url']; ?>
/isLogin" method='post' name='frm'>
						<tbody>
							<tr>
								<td>用户名</td>
								<td><input type="text" class="input_0" name='reg_username'/></td>
							</tr>
							<tr>
								<td>密　码</td>
								<td><input type="password" class="input_0" name='reg_password'/></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								
								<td><input type='button' id='user_reg_submit' value='登陆' style="border:0" onclick="show()"> <nobr><a href="注册.html" class="a_1">注册</a></td>
								</form>
								<script>
										function show(){
													if(document.frm.reg_username.value==""){
														alert('用户名不允许为空');
													}else if(document.frm.reg_password.value==""){
														alert('密码不允许为空');
													}else{
														document.frm.submit();
													}
										}
								</script>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="user_login_form none">
					<table align="center">
						<tbody>
							<tr>
								<td>集团名</td>
								<td><input type="text" class="input_0"/></td>
							</tr>
							<tr>
								<td>密　码</td>
								<td><input type="password" class="input_0"/></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><a href="#" class="a_0">登陆</a> <a href="#" class="a_1">注册</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="mt_10 pl_40">
				<p class="cf00">温馨提示：</p>
				<p>1、请输入您的心云商城用户名及密码进行登录；</p>
				<p>2、如果还未注册心云商城用户名，请您在右侧直接进行注册<br />&nbsp;&nbsp;&nbsp;即可，如有疑问请进入帮助中心或联系在线客服。</p>
				<p>3、如果您忘记了密码，请点击"找回密码"进行密码找回。</p>
			</div>
		</div>
		<div class="quick_reg">
			<h2 class="quick_reg_tit"><strong class="f14">注册新用户</strong> <span class="cf00 ml_10">10秒钟快速注册</span></h2>
			<div class="quick_reg_form">
				<table align="center">
					<tbody>
						<tr>
							<td align="right">用户名</td>
							<td colspan="3"><input type="text" class="input_0" /></td>
						</tr>
						<tr valign="top">
							<td align="right">请填写您的E-mail地址</td>
							<td colspan="3">
								<input type="text" class="input_0" />
								<p class="c999">填写正确的Email地址非常重要，<br />它是您进行密码找回的重要依据。<br />同时我们会给您所注册的地址发送<br />注册信息、订单通知以及优惠信息等</p>
							</td>
						</tr>
						<tr valign="top">
							<td align="right">请设定密码</td>
							<td colspan="3">
								<input type="password" class="input_0" />
								<p class="c999">密码请设定位6－16字母或数字</p>
							</td>
						</tr>
						<tr>
							<td align="right">密码强度</td>
							<td colspan="3"><p id="password_strength">password_strength</p></td>
						</tr>
						<tr>
							<td align="right">请再次输入设定密码</td>
							<td colspan="3"><input type="password" class="input_0" /></td>
						</tr>
						<tr valign="middle">
							<td align="right">验证码</td>
							<td><input type="text" id="reg_verify"></td>
							<td><a href="#"><img  src="<?php echo $this->_tpl_vars['url']; ?>
/code" id='img'></a></td>
							<td><span class="c999">看不清？</span><a class="c110" href="#">换一张</a></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3"><input type="checkbox" checked="checked"> <a target="_blank" class="c110" href="帮助中心.html">阅读心云商城注册条款</a></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3"><a href="注册成功.html" class="a_0">立即注册</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</body>
</html>