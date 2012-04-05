<?php /* Smarty version 2.6.18, created on 2011-07-08 22:51:47
         compiled from user/reg.html */ ?>
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
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/password_strength.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/reg.js"></script> -->
<script src="<?php echo $this->_tpl_vars['public']; ?>
/js/ajax3.0.js"></script>
<script src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.passwordStrength.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	var $pwd = $('input[name="reg_password"]');					   
	$pwd.passwordStrength();
});
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>

<body onload="form.reg_username.focus()">
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="#">首页</a> &gt; <span>注册新用户</span></p>
	<div class="user_reg">
		<h2 class="user_reg_tit">注册新用户</h2>
		<div class="user_reg_inn">
			<form name="form" method="post" action="<?php echo $this->_tpl_vars['url']; ?>
/insert" id="user_reg_form">
			<table align="center" >
				<tbody valign="top">
					<tr>
						<td>用 户 名</td>
						<td colspan="2"><input type="text"  id="reg_username" name='reg_username' onblur='show()'/></td>
						<td><div id='jiance' style='color:green'></div></td>
						<script>
										var bz=true;
										function show(){
												var u=document.form.reg_username.value;
												aj.post('<?php echo $this->_tpl_vars['url']; ?>
/yz',{reg_username:u},hd);
										}
										function hd(o){
												document.getElementById('jiance').innerHTML=o;
										}
										function email(){
												var myReg = /^[-a-zA-Z0-9_\.]+@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$/; 
												 var email = document.getElementById("reg_email").value;
												if(!myReg.test(email)){
															document.getElementById('email').innerHTML='邮件格式不正确';	
															bz=false;
											  	}else{
															document.getElementById('email').innerHTML='';	
															bz=true;
												}

										}
										function pass(){
												if(document.form.reg_password.value != document.form.re_password.value){
															document.getElementById('pass').innerHTML='俩次密码不一样';
															bz=false;
												}else{
															document.getElementById('pass').innerHTML='';
															bz=true;
												}
										}
										function sub(){
											if(document.form.reg_username.value==""){
												alert('用户名不允许为空');
												return false;
											}
											if(document.form.reg_password.value==""){
												alert('密码不允许为空');
												return false;
											}
											if(document.form.reg_email.value==""){
												alert('电子邮箱不允许为空');
												return false;
											}
											if(bz){
														document.form.submit();

											}else{
													alert('信息输入不正确');
											}
										}
										
							</script>

					</tr>
					<tr>
						<td>邮件地址</td>
						<td colspan="2"><input type="text" id="reg_email" name='reg_email' onblur='email()'/></td>
						<td><div id='email' class='verify' style='color:red'></div></td>
					</tr>
					<tr>
						<td>设置密码</td>
						<td colspan="3"><input type="password" id="reg_password" name='reg_password' class='test'/><p class="c999">密码请设置6 - 16位、字母或数字</p></td>
					</tr>
					<!--
						p id="password_strength" 给:
						
						class=""
							password_strength_0 弱
							password_strength_1 中
							password_strength_2 强
					-->
					<tr>
						<td>密码强度</td>
							 <td colspan="3"><div id="passwordStrengthDiv" class="is0"></div>  </td>  
						<!--<p id="password_strength" class="">password_strength</p></td>-->
					</tr>
					<tr>
						<td>确认密码</td>
						<td colspan="2"><input type="password" id="reg_confirm" onblur="pass()" name='re_password' /></td>
						<td><div id='pass' style='color:red'></div></td>
					</tr>
					<tr valign="middle">
						<td>验证码</td>
						<td><input type="text" id="reg_verify"/></td>
						<td><a href="#"><img  src="<?php echo $this->_tpl_vars['url']; ?>
/code" id='img'></a></td>
						<td><span class="c999">看不清？</span><a  class="c110" onclick="document.getElementById('img').src='<?php echo $this->_tpl_vars['url']; ?>
/code/'+Math.random()">换一张</a></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3"><input type="checkbox" checked="checked"/> <a href="帮助中心.html" class="c110" target="_blank">阅读心云商城注册条款</a></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3"><input type='button' id='user_reg_submit' value='提交' style='border:0' onclick='sub()'></td>
						<!--<td colspan="3"><a href="regwin.php" id="user_reg_submit">提 交</a></td> -->
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!--优势保障 start-
	<div class="w960 mt_10 index_odds">
		<ul>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_0.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">央企电子商务</span><span class="block c502">质量保证</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_1.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">100%正品真货</span><span class="block c502">假一赔十</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_2.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">满499免运费</span><span class="block c502">全场商品</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_3.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">1100个城市</span><span class="block c502">送货上门</span></p>
			</li>
		</ul>
	</div>
	优势保障 end-->
</div>

</body>
</html>