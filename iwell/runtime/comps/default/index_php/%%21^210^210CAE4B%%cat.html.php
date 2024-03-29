<?php /* Smarty version 2.6.18, created on 2012-04-15 21:15:51
         compiled from search/cat.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $this->_tpl_vars['lan']['site_title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/goods_list.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public']; ?>
/css/sales.min.css" media="all" type="text/css"/>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/goods_list.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/common.js"></script>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="fabWrapper" class="wrapperMesh">
<div id="contentWrapper">
  <div class="fabBorderSpace"></div>
  <div class="frame_main">
	<div class="goods_list_left"> 
		<!--全部商品分类 start-->
		<div id="all_sort">
			<h2 class="h2_0">分类筛选</h2>
			<dl class="active">
				<dt><a href="#">手机/配件</a><b class="icon">icon</b></dt>
				<dd><a href="搜索.html">GSM手机</a></dd>
				<dd><a href="搜索.html">CDMA手机</a></dd>
				<dd><a href="#">移动3G手机</a></dd>
				<dd><a href="#">联通3G手机</a></dd>
				<dd><a href="#">电信3G手机</a></dd>
				<dd><a href="#">双卡手机</a></dd>
				<dd><a href="#">双模手机</a></dd>
				<dd><a href="#">手机电池</a></dd>
				<dd><a href="#">手机充电器</a></dd>
			</dl>
		</div>
		<!--全部商品分类 end-->
		<div class="search_hot_sale" id="sell_tab_sub">
			<h2 class="h2_0">热销商品</h2>
			<ol>
						<li>
							<p class="p_0"><strong class="strong_0">1</strong><a href="#"><img width="50" height="50" src="images/goods_list/1.jpg" alt="" class="fl"></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
					</ol>
		</div>
	</div>
	<div class="goods_list_right"> 
		<!--搜索结果 start-->
		<p class="search_result_info"><?php echo $this->_tpl_vars['cat']['c_name']; ?>
 搜索结果（<?php echo $this->_tpl_vars['num']; ?>
）</p>
		<!--搜索结果 start--> 
		<!--商品排序 start-->
		<ul class="goods_sort">
			<li class="<?php if ($this->_tpl_vars['order'] == 'sale_begin'): ?>active<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['p']; ?>
/order/sale_begin/sort/<?php if ($this->_tpl_vars['order'] == 'sale_begin'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>asc<?php else: ?>desc<?php endif; ?><?php endif; ?>">按上架时间排序<?php if ($this->_tpl_vars['order'] == 'sale_begin'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>↓<?php else: ?>↑<?php endif; ?><?php endif; ?></a></li>
			<li class="<?php if ($this->_tpl_vars['order'] == 'w_price'): ?>active<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['p']; ?>
/order/w_price/sort/<?php if ($this->_tpl_vars['order'] == 'w_price'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>asc<?php else: ?>desc<?php endif; ?><?php endif; ?>">按价格排序<?php if ($this->_tpl_vars['order'] == 'w_price'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>↓<?php else: ?>↑<?php endif; ?><?php endif; ?></a></li>
			<li class="<?php if ($this->_tpl_vars['order'] == 'edit_time'): ?>active<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['p']; ?>
/order/edit_time/sort/<?php if ($this->_tpl_vars['order'] == 'edit_time'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>asc<?php else: ?>desc<?php endif; ?><?php endif; ?>">按更新时间排序<?php if ($this->_tpl_vars['order'] == 'edit_time'): ?><?php if ($this->_tpl_vars['sort'] == 'desc'): ?>↓<?php else: ?>↑<?php endif; ?><?php endif; ?></a></li>
		</ul>
		<!--商品排序 end--> 
		<!--商品列表 start-->
		<ul id="all_goods_list">
		<!-- 便利搜索的结果集-->
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
			<li> <a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_pic']; ?>
" width="100" height="100" alt="" /></a>
			  <p class="pro_name"><a href="#"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
				<p class="f14 cb00"><strong>价格：￥<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_price']; ?>
.00元</strong></p>
				<p class="mt_10"><a href="#" class="a_0">收藏</a><a href="单品.html" class="a_0">购买</a><a href="#" class="a_0">比较</a></p>
			</li>
		<?php endfor; endif; ?>
		</ul>
		<ul class="goods_flip mt_10">
			<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/1/order/<?php echo $this->_tpl_vars['order']; ?>
/sort/<?php echo $this->_tpl_vars['sort']; ?>
">第一页</a></li>
			<?php if ($this->_tpl_vars['p'] > 1): ?>
				<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['p']-1; ?>
/order/<?php echo $this->_tpl_vars['order']; ?>
/sort/<?php echo $this->_tpl_vars['sort']; ?>
">上一页</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['p'] < $this->_tpl_vars['total_page']): ?>
				<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['p']+1; ?>
/order/<?php echo $this->_tpl_vars['order']; ?>
/sort/<?php echo $this->_tpl_vars['sort']; ?>
">下一页</a></li>
			<?php endif; ?>
			<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['cid']; ?>
/p/<?php echo $this->_tpl_vars['total_page']; ?>
/order/<?php echo $this->_tpl_vars['order']; ?>
/sort/<?php echo $this->_tpl_vars['sort']; ?>
">最后一页</a></li>
			<li><label for="goods_pages">跳到 </label><input type="text" id="goods_pages"/>页 <input value="Go" size="2" type="button" maxlength="2"/></li>
		</ul>
		<!--商品列表 end--> 
	</div>
	<div class="clear"></div>
	</div>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>