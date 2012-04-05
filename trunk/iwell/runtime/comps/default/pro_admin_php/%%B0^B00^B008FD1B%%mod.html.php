<?php /* Smarty version 2.6.18, created on 2011-07-03 20:17:04
         compiled from brand/mod.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 修改品牌 </title>
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
/index">品牌信息</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 修改品牌 </span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/update" method="post" enctype="multipart/form-data" >
<table width="100%" id="general-table">
		<tr>
				        <td class="label">品牌名称:</td>
						<td> <input type='text' name='b_name' maxlength="20" value='<?php echo $this->_tpl_vars['data']['b_name']; ?>
' size='27' /> <font color="red">*</font> </td>
		</tr>
				<tr>
				        <td class="label">品牌LOGO:</td>
						<td> <input type='file' name='logo' maxlength="30" value='' size='27' /> <font color="red">*</font><br>
						<input type='hidden' name='srcimg' value="<?php echo $this->_tpl_vars['data']['logo']; ?>
">
						<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['data']['id']; ?>
'>
						<img src="<?php echo $this->_tpl_vars['public']; ?>
/uploads/<?php echo $this->_tpl_vars['data']['logo']; ?>
" style="width:50px;height:50px">
						</td>
		</tr>
				<tr>
				        <td class="label">品牌地址:</td>
						<td> <input type='text' name='b_url' maxlength="20" value='<?php echo $this->_tpl_vars['data']['b_url']; ?>
' size='27' /> <font color="red">*</font> </td>
		</tr>
				<tr>
				        <td class="label">是否显示:</td>
						<td> <select name='is_show'>
								<option value='1' <?php if ($this->_tpl_vars['data']['is_show'] == '1'): ?> selected <?php endif; ?>>显示</option>
								<option value='0' <?php if ($this->_tpl_vars['data']['is_show'] == '0'): ?> selected <?php endif; ?> >不显示</option>
								</select>
						</td>
		</tr>
</table>
      <div class="button-div" style='margin-right:100px;margin-top:20px'>
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
      </div>

<!--表格结束 -->
</body>