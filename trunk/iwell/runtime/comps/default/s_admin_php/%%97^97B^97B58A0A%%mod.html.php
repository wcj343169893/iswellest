<?php /* Smarty version 2.6.18, created on 2011-07-04 11:48:18
         compiled from user/mod.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加用户 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo $this->_tpl_vars['url']; ?>
/index">用户信息</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 修改用户</span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/update" method='post'>
<table width="100%" id="general-table">
		<tr>
				        <td class="label">用户名称:</td>
						<td> <input type='text' name='username' maxlength="20" value='<?php echo $this->_tpl_vars['data']['username']; ?>
' size='27' /> <font color="red">*</font> </td>
		</tr>
		<tr>
						<td class="label">用户身份:</td>
						<td> <select name='allow_1'>
									
									<option value='1' <?php if ($this->_tpl_vars['data']['allow_1'] == '1'): ?> selected <?php endif; ?>>管理员</option>
									<option value='2' <?php if ($this->_tpl_vars['data']['allow_1'] == '2'): ?> selected <?php endif; ?>>操作员</option>
									<option value='3' <?php if ($this->_tpl_vars['data']['allow_1'] == '3'): ?> selected <?php endif; ?>>信息统计员</option>

								</select>
						<font color="red">*</font> </td>
		</tr>
		<tr>
					 <td class="label">用户职位:</td>
					 <td> <input type='text' name='post' maxlength="20" value='<?php echo $this->_tpl_vars['data']['post']; ?>
' size='27' /> <font color="red">*</font> </td>

		</tr>
				<tr>
					 <td class="label">手机:</td>
					 <td> <input type='text' name='phone' maxlength="20" value='<?php echo $this->_tpl_vars['data']['phone']; ?>
' size='27' /> <font color="red">*</font> </td>
					 <input type='hidden' name='id' value='<?php echo $this->_tpl_vars['data']['id']; ?>
'>

		</tr>
</table>

      <div class="button-div" style='margin-right:100px;margin-top:20px'>
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
      </div>
</form>
<!--表格结束 -->
</body>