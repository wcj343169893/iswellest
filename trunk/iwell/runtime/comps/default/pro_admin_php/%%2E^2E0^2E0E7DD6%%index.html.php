<?php /* Smarty version 2.6.18, created on 2011-07-09 00:04:46
         compiled from user/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'user/index.html', 87, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 12px;
}
.STYLE6 {color: #000000; font-size: 12; }
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {
	color: #344b50;
	font-size: 12px;
}
.STYLE21 {
	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {
	font-size: 12px;
	color: #295568;
}
-->
</style>
</head>
<h1>
<span class="action-span"><a href="<?php echo $this->_tpl_vars['url']; ?>
/add">添加用户</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 用户列表</span>
<div style="clear:both"></div>
</h1>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  
        
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
          <input type="checkbox" name="checkbox" id="checkbox" />
        </div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户编号</span></div></td>
        <td width="15%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户名称</span></div></td>
		<td width="17%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户电话</span></div></td>
        <td width="14%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户职位</span></div></td>
        <td width="16%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户身份</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">注册时间</span></div></td>
        <td width="14%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
      </tr>

	  <?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <tr>
        <td height="20" bgcolor="#FFFFFF"><div align="center">
          <input type="checkbox" name="checkbox2" id="checkbox2" />
        </div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['username']; ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['phone']; ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['post']; ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">

			<?php if ($this->_tpl_vars['data'][$this->_sections['ls']['index']]['allow_1'] == '1'): ?>
				管理员
			<?php elseif ($this->_tpl_vars['data'][$this->_sections['ls']['index']]['allow_1'] == '2'): ?>
				操作员
			<?php else: ?>
				数据统计员
			<?php endif; ?>
		</div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['utime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y年 %m月 %d日 ") : smarty_modifier_date_format($_tmp, "%Y年 %m月 %d日 ")); ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21"><a onclick="return confirm('你确定要删除用户<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['username']; ?>
?')"href="<?php echo $this->_tpl_vars['url']; ?>
/delete/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
">删除</a> | <a href="<?php echo $this->_tpl_vars['url']; ?>
/mod/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
">修改</a></div></td>
      </tr>
	  <?php endfor; endif; ?>
    </table></td>
  </tr>
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%"><div align="left"><span class="STYLE22"></span></div></td>

          <tr>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>