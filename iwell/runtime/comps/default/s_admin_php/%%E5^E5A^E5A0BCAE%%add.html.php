<?php /* Smarty version 2.6.18, created on 2011-07-04 09:43:22
         compiled from brand/add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加品牌 </title>
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
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 添加品牌 </span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/insert" method="post" enctype="multipart/form-data" >
<table width="100%" id="general-table">
		<tr>
				        <td class="label">品牌名称:</td>
						<td> <input type='text' name='b_name' maxlength="50" value='' size='27' /> <font color="red">*</font> </td>
		</tr>
				<tr>
				        <td class="label">品牌LOGO:</td>
						<td> <input type='file' name='logo' maxlength="50" value='' size='27' /> <font color="red">*</font> </td>
		</tr>
				<tr>
				        <td class="label">品牌地址:</td>
						<td> <input type='text' name='b_url' maxlength="50" value='http://' size='27' /> <font color="red">*</font> </td>
		</tr>
				<tr>
				        <td class="label">是否显示:</td>
						<td> <select name='is_show'>
								<option value='1'>显示</option>
								<option value='0'>不显示</option>
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