<?php /* Smarty version 2.6.18, created on 2011-07-11 22:46:19
         compiled from pay/index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/cart.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/cart.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cart.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cookie.js"></script>	
</head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
<script>
window.onload = function() {
	//更新购物车
	cookie.Del("cartList");
 }; 
</script>
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="<?php echo $this->_tpl_vars['app']; ?>
">首页</a> &gt; <a href="#">用户中心</a> &gt; <span>订单提交成功</span></p>
	<div class="w960 mt_10">
		<div class="order_success">
			<h2 class="order_success_tit"><span class="span_0">订单提交成功，请尽快付款！</span></h2>
			<div class="order_success_info">
				<p class="f14">订单号：<strong class="cf00"><?php echo $this->_tpl_vars['order_id']; ?>
</strong> 应付金额：<strong class="cf00">￥<?php echo $this->_tpl_vars['price']; ?>
.00</strong> 支付方式：<strong>在线支付</strong> 配送方式：<strong>鸿运物流</strong></p>
				<p class="mt_10 clearFix">
					<a href="帮助中心.html" class="fl c110">邮局汇款说明</a><a href="帮助中心.html" class="fl c110 ml_10">银行转账说明</a>
				</p>
				<!--银行图片开始-->
				<p class="mt_5">
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
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/bank/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['p_pic']; ?>
" width="136" height="38" alt="" /></a>
					<?php endfor; endif; ?>
				</p>
				<br>
				<p class="mt_5">
					<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/bank/<?php echo $this->_tpl_vars['data1'][$this->_sections['ls']['index']]['p_pic']; ?>
" width="136" height="38" alt="" /></a>
					<?php endfor; endif; ?>
				</p>
				<br>
					<p class="mt_5">
					<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/bank/<?php echo $this->_tpl_vars['data2'][$this->_sections['ls']['index']]['p_pic']; ?>
" width="136" height="38" alt="" /></a>
					<?php endfor; endif; ?>
				</p>
				<p class="mt_5">支持以下支付平台</p>
				<?php echo $this->_tpl_vars['banks']; ?>

				<p class="mt_10 f14">您可以<a href="<?php echo $this->_tpl_vars['app']; ?>
"> 返回首页</a> 或去 <a href="#" class="c110">用户中心</a></p>
				<p class="mt_10">如有疑问请进入<a href="帮助中心.html"> 帮助中心</a> 或 <a href="#" class="c110">联系在线客服</a></p>
			</div>
		</div>
	</div>
	<!--优势保障 start-->
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
	<!--优势保障 end-->
</div>
</body>
</html>