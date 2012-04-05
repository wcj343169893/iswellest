<?php /* Smarty version 2.6.18, created on 2011-07-04 09:59:48
         compiled from ware/add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加商品 </title>
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
/index">商品信息</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 添加商品</span>
<div style="clear:both"></div>
</h1>
<!--表格开始 -->
<form action="<?php echo $this->_tpl_vars['url']; ?>
/insert" method='post'>
<table width="100%" id="general-table">
		<tr>
				        <td class="label">商品名称:</td>
						<td> <input type='text' name='username' maxlength="50" value='' size='27' /> <font color="red">*</font> </td>
		</tr>
		<tr>
						<td class="label">商品货号:</td>
						<td> <input type='password' name='password' maxlength="20" value='' size='27' /> <font color="red">*</font> <br>
							如果您不输入商品货号，系统将自动生成一个唯一的货号。
						</td>
					
		</tr>
				<tr>
						<td class="label">商品分类</td>
						<td>
							<select name='cat'>
							<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['cat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
									<option value="<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['c_name']; ?>
"><?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['c_name']; ?>
</option>
							<?php endfor; endif; ?>
							</select>
						</td>
						 </td>
		</tr>
		<tr>
						<td class="label">商品品牌:</td>
						<td> <select name='brand'>
							<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['brand']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
									<option value="<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['b_name']; ?>
"><?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['b_name']; ?>
</option>
							<?php endfor; endif; ?>
								</select>
						<font color="red">*</font> </td>
		</tr>
		<tr>
					 <td class="label">进货价格:</td>
					 <td> <input type='text' name='buyprice' maxlength="20" value='' size='27' /> <font color="red">*</font> </td>

		</tr>
		<tr>
					 <td class="label">售价:</td>
					 <td> <input type='text' name='price' maxlength="20" value='' size='27' /> <font color="red">*</font> </td>
		</tr>
		<tr>
					 <td class="label">积分:</td>
					 <td> <input type='text' name='price' maxlength="20" value='' size='27' /> <font color="red">*</font><br> 
					 购买该商品时最多可以使用多少钱的积分
					 </td>
		</tr>
		<tr>
					 <td class="label">上传商品图片:</td>
					 <td> <input type='file' name='pic' maxlength="50" value='' size='27' /> <font color="red">*</font><br> 
					 </td>
		</tr>
						<tr>
						<td class="label"></td>
						<td><input type='checkbox' name='small' checked="true">自动生成缩略图</td>
						
		</tr>
</table>

      <div class="button-div" style='margin-right:100px;margin-top:20px'>
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
      </div>
</form>
<!--表格结束 -->
</body>