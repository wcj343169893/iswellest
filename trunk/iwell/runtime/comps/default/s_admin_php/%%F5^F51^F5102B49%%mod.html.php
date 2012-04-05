<?php /* Smarty version 2.6.18, created on 2011-07-04 09:50:08
         compiled from cat/mod.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 修改分类 </title>
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
/index">商品分类</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 修改分类 </span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/update/<?php echo $this->_tpl_vars['data']['id']; ?>
" method='post'>
<table width="100%" id="general-table">
		<tr>
				        <td class="label">分类名称:</td>
						<td> <input type='text' name='c_name' maxlength="20" value='<?php echo $this->_tpl_vars['data']['c_name']; ?>
' size='27' /> <font color="red">*</font> </td>
		</tr>
		<tr>
					 <td class="label">分类描述:</td>
					 <td> <textarea name='c_desn' rows="6" cols="48"><?php echo $this->_tpl_vars['data']['c_desn']; ?>
</textarea> </td>
					 <input type='hidden' name='id' value='<?php echo $this->_tpl_vars['data']['id']; ?>
'>

		</tr>
</table>
      <div class="button-div" style='margin-right:100px;margin-top:20px'>
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
      </div>

<!--表格结束 -->
</body>