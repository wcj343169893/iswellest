<?php /* Smarty version 2.6.18, created on 2012-04-08 21:59:58
         compiled from ware/index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/common.js"></script>
<title>无标题文档</title>
</head>
<h1>
<span class="action-span">
	<a href="<?php echo $this->_tpl_vars['url']; ?>
/add">删除商品</a>
</span>
<span class="action-span">
	<a href="<?php echo $this->_tpl_vars['url']; ?>
/add">推荐商品</a>
</span>
<span class="action-span">
	<a href="<?php echo $this->_tpl_vars['url']; ?>
/add">添加商品</a>
</span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
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
          <input type="checkbox" name="checkbox" id="checkall" />
        </div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">编号</span></div></td>
        <td width="30%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品名称</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">价格</span></div></td>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">库存</span></div></td>
        <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">热销</span></div></td>
	    <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">精品</span></div></td>
		<td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">新品</span></div></td>
		<td width="13%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">上架时间</span></div></td>
		<td width="13%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">下架时间</span></div></td>
		<td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">上架</span></div></td>
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
          <input type="checkbox" name="<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
" class="checks" />
        </div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><b><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_name']; ?>
</b></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_price']; ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_num']; ?>
</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/yes.gif"></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/yes.gif"></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/yes.gif"></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['sale_begin']; ?>
</div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['sale_end']; ?>
</div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">
		<?php if ($this->_tpl_vars['data'][$this->_sections['ls']['index']]['is_up'] == 1): ?>
		<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/yes.gif">
		<?php else: ?>
		<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/no.gif">
		<?php endif; ?>
		</div></td>
        
		<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21">
		<!-- 查看商品 直接切入到三级页 --><a href="<?php echo $this->_tpl_vars['root']; ?>
/index.php/index/ware/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icon_view.gif" alt="查看"></a> 
		<!-- 编辑商品信息--><a href="<?php echo $this->_tpl_vars['url']; ?>
/mod/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icon_edit.gif" alt="编辑"></a>
		<!-- 将商品放入回收站--><a href="<?php echo $this->_tpl_vars['url']; ?>
/cover/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
" onclick="return confirm('确定要将商品放入到回收站吗？');"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icon_trash.gif" alt="回收站"></a>
		</div></td>
      </tr>
	  <?php endfor; endif; ?>
    </table></td>
  </tr>
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <br>
      <tr>
        <td width="33%"><div align="right"><span class="STYLE22" style="font-size:16px"><?php echo $this->_tpl_vars['fpage']; ?>
</span></div></td>

          <tr>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>