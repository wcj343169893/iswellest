<?php /* Smarty version 2.6.18, created on 2011-07-11 12:05:41
         compiled from order/order_info.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'order/order_info.html', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4"  valign='center'><b>基本信息</b></th>
  </tr>
  <tr>
    <td width="20%" align='right'><b>订单号:</b></td>
    <td width="30%"><?php echo $this->_tpl_vars['data']['order_id']; ?>
</td>
    <td width="20%" align='right'><b>订单状态:</b></td>
    <td width="30%">
		<?php if ($this->_tpl_vars['data']['ok'] == 0): ?>
					未确认
			<?php else: ?>
					已确认
			<?php endif; ?>
			、
			<?php if ($this->_tpl_vars['data']['pay'] == 0): ?>
					未付款
			<?php else: ?>
					已付款
			<?php endif; ?>
			、
			<?php if ($this->_tpl_vars['data']['consignment'] == 0): ?>
					未发货
			<?php elseif ($this->_tpl_vars['data']['consignment'] == 1): ?>
					已发货
			<?php else: ?>
					收货确认
			<?php endif; ?>
	</td>
  </tr>
  <tr>
   <td width="20%" align='right'><b>购货人</b></td>
    <td><?php echo $this->_tpl_vars['data']['consignee']; ?>
</td>
    <td width="20%" align='right'><b>下单时间</b></td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['order_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %T") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %T")); ?>
</td>
  </tr>
  <tr>
    <td width="20%" align='right'><b>支付方式:</b></td>
    <td>网银支付</td>
    <td width="20%" align='right'><b>付款时间:</b></td>
    <td>未付款</td>
  </tr>
  <tr>
    <td width="20%" align='right'><b>配送方式:</b></td>
    <td>圆通快递</td>
    <td width="20%" align='right'><b>发货时间:</b></td>
    <td>未发货</td>
  </tr>
  <tr>
    <td width="20%" align='right'><b>发货单号:</b></td>
    <td>未发货</td>
    <td width="20%" align='right'><b>订单来源:</b></td>
    <td>本站</td>
  </tr>

<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4"  valign='center'><b>收货人信息</b></th>
  </tr>
  <tr>
    <td width="20%" align='right'><b>收货人:</b></td>
    <td width="30%"><?php echo $this->_tpl_vars['data']['consignee']; ?>
</td>
    <td width="20%" align='right'><b>电子邮件:</b></td>
    <td width="30%"><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
  </tr>
  <tr>
   <td width="20%" align='right'><b>地址</b></td>
    <td><?php echo $this->_tpl_vars['data']['city1']; ?>
 <?php echo $this->_tpl_vars['data']['city2']; ?>
 <?php echo $this->_tpl_vars['data']['city3']; ?>
 <?php echo $this->_tpl_vars['data']['address']; ?>
</td>
    <td width="20%" align='right'><b>邮编</b></td>
    <td><?php echo $this->_tpl_vars['data']['postal']; ?>
</td>
  </tr>
  <tr>
    <td width="20%" align='right'><b>电话:</b></td>
    <td><?php echo $this->_tpl_vars['data']['dh']; ?>
</td>
    <td width="20%" align='right'><b>手机:</b></td>
    <td><?php echo $this->_tpl_vars['data']['phone']; ?>
</td>
  </tr>
  <tr>
    <td width="20%" align='right'><b>标志性建筑:</b></td>
    <td>否</td>
    <td width="20%" align='right'><b>最佳送货时间:</b></td>
    <td><?php echo $this->_tpl_vars['data']['sendtime']; ?>
</td>
  </tr>
</table>
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="7"  valign='center'><b>商品信息</b></th>
  </tr>
    <tr>
    <td width="30%" align='center'><b>商品名称 [ 品牌 ]</b></td>
    <td width="15%" align='center'><b>货号</b></td>
    <td width="15%" align='center'><b>价格</b></td>
    <td width="10%" align='center'><b>数量</b></td>
	<td width="10%" align='center'><b>属性</b></td>
	<td width="10%" align='center'><b>库存</b></td>
	<td width="10%" align='center'><b>小计</b></td>
  </tr>
  <?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width="30%" align='center'><?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['w_name']; ?>
</td>
    <td width="15%" align='center'><?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['w_code']; ?>
</td>
    <td width="15%" align='center'><?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['w_price']; ?>
</td>
    <td width="10%" align='center'><?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['num']; ?>
</td>
	<td width="10%" align='center'></td>
	<td width="10%" align='center'><?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['w_num']; ?>
</td>
	<td width="10%" align='center'>￥<?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['num']*$this->_tpl_vars['data2'][$this->_sections['ls']['index']]['w_price']; ?>
.00</td>
  </tr>
  <?php endfor; endif; ?>
  <tr><td colspan='5'></td><td align='right'>合计</td><td>￥<?php echo $this->_tpl_vars['data']['price']; ?>
.00</td></tr>
  <tr>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="6">操作信息</th>
  </tr>
  <tr>
 <form action="<?php echo $this->_tpl_vars['url']; ?>
/submit" method='post'>
    <td><div align="right"><strong>操作备注：</strong></div></td>
  <td colspan="5"><textarea name="action_note" cols="80" rows="3"></textarea></td>
    </tr>
  <tr>
    <td><div align="right"></div>
      <div align="right"><strong>当前可执行操作：</strong> </div></td>
    <td colspan="5">

					<?php if ($this->_tpl_vars['data']['ok'] == 0): ?>
					<input name="pay" type="submit" value="确认" class="button" />
					<?php endif; ?>
					<?php if ($this->_tpl_vars['data']['consignment'] == 0 && $this->_tpl_vars['data']['pay'] == 0): ?>
                    <input name="unship" type="submit" value="发货" class="button" onclick="return confirm('该订单还未付款,确认要发货吗?'); " />
					<?php endif; ?>
					<?php if ($this->_tpl_vars['data']['consignment'] == 0 && $this->_tpl_vars['data']['pay'] == 1): ?>
					                    <input name="unship" type="submit" value="发货" class="button" />
					<?php endif; ?>
                    <input name="return" type="submit" value="取消" class="button" />
					<input name="after_service" type="submit" value="无效" class="button" /> 
					<input name="after_service" type="submit" value="售后" class="button" /> 
					<input name="order_id" type="hidden" value="<?php echo $this->_tpl_vars['data']['id']; ?>
"></td>
    </tr>
  <tr>
    <th>操作者：</th>
    <th>操作时间</th>
    <th>订单状态</th>
    <th>付款状态</th>
    <th>发货状态</th>
    <th>备注</th>
  </tr>
  <?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data3']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td align='center'><?php echo $this->_tpl_vars['data3'][$this->_sections['ls']['index']]['operater']; ?>
</td>
   <td align='center'><?php echo ((is_array($_tmp=$this->_tpl_vars['data3'][$this->_sections['ls']['index']]['operate_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %T") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %T")); ?>
</td>
	<td align='center'>		
		<?php if ($this->_tpl_vars['data3'][$this->_sections['ls']['index']]['ok'] == 0): ?>
					未确认
			<?php else: ?>
					已确认
			<?php endif; ?></td>
	<td align='center'>			<?php if ($this->_tpl_vars['data3'][$this->_sections['ls']['index']]['pay'] == 0): ?>
					未付款
			<?php else: ?>
					已付款
			<?php endif; ?></td>
	<td align='center'>			
			<?php if ($this->_tpl_vars['data3'][$this->_sections['ls']['index']]['consignment'] == 0): ?>
					未发货
			<?php elseif ($this->_tpl_vars['data3'][$this->_sections['ls']['index']]['consignment'] == 1): ?>
					已发货
			<?php else: ?>
					收货确认
			<?php endif; ?></td>
	 <td align='center'><?php echo $this->_tpl_vars['data3'][$this->_sections['ls']['index']]['desn']; ?>
</td>
	 </tr>
  <?php endfor; endif; ?>
  </table>
</div>
</body>