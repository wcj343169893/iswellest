<?php /* Smarty version 2.6.18, created on 2011-07-04 14:24:53
         compiled from user/pass.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 修改密码</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
<script>
		function show(){
					if(document.frm.username.value==""){
						alert('用户名不允许为空');
					}
					else if(document.frm.password.value=="" ){
						alert('密码不允许为空');
					}else if(document.frm.newpassword.value==""){
						alert('密码不允许为空');
					}else if(document.frm.repassword.value==""){
						alert('密码不允许为空');
					}else if(document.frm.newpassword.value!=document.frm.repassword.value){
						alert('重复密码与新密码不一致');
					}else{
							document.getElementById("frm").submit();
					}
		}
</script>
</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo $this->_tpl_vars['url']; ?>
/index">用户信息</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 修改密码</span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/uppass" method='post' name='frm' id='frm'>
<table width="100%" id="general-table">
		<tr>
				        <td class="label">用户名称:</td>
						<td> <input type='text' name='username' maxlength="20" value='<?php echo $this->_tpl_vars['username']; ?>
' size='27' /> <font color="red">*</font> </td>
		</tr>
		<tr>
					 <td class="label">旧密码:</td>
					 <td> <input type='password' name='password' maxlength="20" value='' size='27' /> <font color="red">*</font> </td>

		</tr>
				<tr>
					 <td class="label">新密码:</td>
					 <td> <input type='password' name='newpassword' maxlength="20" value='' size='27' /> <font color="red">*</font> </td>
					 <input type='hidden' name='id' value=''>

		</tr>
						<tr>
					 <td class="label">重复密码:</td>
					 <td> <input type='password' name='repassword' maxlength="20" value='' size='27' /> <font color="red">*</font> </td>
					 <input type='hidden' name='id' value='<?php echo $this->_tpl_vars['id']; ?>
'>

		</tr>
</table>

      <div class="button-div" style='margin-right:300px;margin-top:20px'>
        <input type="button" value=" 确定 " onclick="show()" id="pass"/>&nbsp;&nbsp;
        <input type="reset" value=" 重置 " />
      </div>
</form>
<!--表格结束 -->
</body>