<?php /* Smarty version 2.6.18, created on 2012-04-20 10:05:18
         compiled from index/ware.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $this->_tpl_vars['data']['goods_name']; ?>
--<?php echo $this->_tpl_vars['lan']['site_title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/goods.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/reg.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/comment.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public']; ?>
/css/sales.min.css" media="all" type="text/css"/>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/goods.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cart.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cookie.js"></script>
<style>
.input_0 {background:none;border:1px solid #ccc;height:20px;line-height:20px;width:160px;}
</style>
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
		<!--产品图 start-->
		<div class="goods_info_left">
			<div class="clearFix">
				<div id="goods_img">
					<a href="#"><img src="/<?php echo $this->_tpl_vars['data']['goods_img']; ?>
" width="350" height="350" alt="" /></a>
				</div>
				<div id="goods_img_slide">
					<p id="goods_img_up"><a href="javascript:void(0)">向上</a></p>
					<ul>
					<?php unset($this->_sections['g']);
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['gallerys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
						<li class="active"><a href="javascript:void(0)"><img src="/<?php echo $this->_tpl_vars['gallerys'][$this->_sections['g']['index']]['thumb_url']; ?>
" width="50" height="50" alt="/<?php echo $this->_tpl_vars['gallerys'][$this->_sections['g']['index']]['img_url']; ?>
" /></a></li>
						<?php endfor; endif; ?>
					</ul>
					<p id="goods_img_down"><a href="javascript:void(0)">向上</a></p>
				</div>
			</div>
			<div class="goods_share">
				<!-- 分享 -->
			    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
			        <a class="bds_qzone"></a>
			        <a class="bds_tsina"></a>
			        <a class="bds_renren"></a>
			        <a class="bds_tieba"></a>
			        <a class="bds_tqq"></a>
			        <a class="bds_douban"></a>
			        <span class="bds_more">更多</span>
					<a class="shareCount"></a>
			    </div>
			</div>
		</div>
		<!--产品图 end-->
		<!--产品信息 start-->
		<div class="goods_info_right">
			<dl class="goods_info">
				<input type='hidden' id='w_id' name='w_id' value="<?php echo $this->_tpl_vars['data']['id']; ?>
">
				<dt><a href="#"><strong class="f14"><?php echo $this->_tpl_vars['data']['goods_name']; ?>
</strong></a></dt>
				<dd>商品编号：<?php echo $this->_tpl_vars['data']['goods_sn']; ?>
</dd>
				<dd>品　　牌：<?php echo $this->_tpl_vars['data']['c_name']; ?>
</dd>
				<dd>普 泰 价：<strong class="f14 cb00" >￥<span id='price'><?php echo $this->_tpl_vars['data']['market_price']; ?>
</span></strong> <a href="#" class="c110">降价通知</a></dd>
			</dl>
			<dl class="goods_gifts">
				<dt>赠品：</dt>
				<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['gift']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<dd><a href="javascript:void(0)"><?php echo $this->_tpl_vars['gift'][$this->_sections['ls']['index']]['g_name']; ?>
</a> <span class="cb00">X<?php echo $this->_tpl_vars['gift'][$this->_sections['ls']['index']]['g_num']; ?>
</span></dd>
				<?php endfor; endif; ?>
			</dl>
			<div class="goods_others">
				<dl id="goods_color">
					<dt>
						<span class="block">选择颜色：</span>
						<span class="block">已选择：“<span id="goods_color_info" style="color:#ff00ea;">粉色</span>”</span>
					</dt>
					<dd class="active"><a href="javascript:void(0)"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data']['w_pic']; ?>
" width="50" height="50" alt="粉色|#ff00ea" /></a></dd>
					<!--
					<dd><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="黑色|#000000" /></a></dd>
					-->
				</dl>
				<dl>
					<dt>我 要 买：</dt>
					<dd><a href="javascript:void(0)" id="goods_amount_reduce">减少</a><input type="text" id="goods_amount" maxlength="3" value="1" name='goods_quantity' /><a href="javascript:void(0)" id="goods_amount_plus">增加</a></dd>
					<dd>库存：<span>有货</span>/<span class="cf00">缺货</span>/<span class="cffb">预定</span></dd>
				</dl>
				<dl>
					<dt>商品总价：</dt>
					<dd><strong class="f14 cb00">￥<span id='sumprice'><?php echo $this->_tpl_vars['data']['w_price']; ?>
</span></strong></dd>
				</dl>
				<p class="clearFix"><a href="javascript:show()" id="goods_add_cart" >&nbsp;</a></p>
				<!-- 购物车用 -->
				<input type="hidden" name="goods_id" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
				<input type="hidden" name="Images_url" value="<?php echo $this->_tpl_vars['data']['w_pic']; ?>
" />
				<input type="hidden" name="goods_name" value="<?php echo $this->_tpl_vars['data']['w_name']; ?>
" />
				<input type="hidden" name="market_price" value="<?php echo $this->_tpl_vars['data']['w_price']; ?>
" />
			</div>
		</div>
		<!--产品信息 end-->
		<div class="clear"></div>
	</div>
	<div class="mt_6 frame_main">
		<div class="goods_left">
			<!--商品相关信息 start-->
			<ul id="goods_info_main">
				<li class="active">商品介绍<span></span></li>
				<li>商品属性<span></span></li>
				<li>包装清单<span></span></li>
				<li>售后服务<span></span></li>
			</ul>
			<div id="goods_info_sub">
				<div class="goods_info_sub_tabs"><?php echo $this->_tpl_vars['data']['goods_desc']; ?>
</div>
				<div class="goods_info_sub_tabs none"><?php echo $this->_tpl_vars['inc'][$this->_sections['i']['index']]['content']; ?>
</div>
			</div>
			<!--商品相关信息 end-->
			<!--商品评价 start-->
			<div id="goods_evaluation">
			<div id="disqus_thread"></div>
			<script type="text/javascript">
				var disqus_shortname = 'iswellest'; 
				var disqus_developer = 1;
				var disqus_title = 'iswellest';
				(function() {
					var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
					dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
					(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);

					var s = document.createElement('script'); s.async = true;
						s.type = 'text/javascript';
						s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
						(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
				})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			</div>
				
		</div>
		<div class="goods_right">
			<!--销售排行 start-->
			<h2 class="sell_ranking_tit">销售排行</h2>
			<div id="sell_ranking">
				<ul id="sell_tab_main">
					<li class="active"><a href="javascript:void(0)">同类别</a></li>
					<li><a href="javascript:void(0)">同品牌</a></li>
					<li><a href="javascript:void(0)">同价位</a></li>
				</ul>
				<div id="sell_tab_sub"> 
					<!--同类别-->
					<ol>
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
						<li>
							<p class="p_0"><strong class="strong_0"><?php echo $this->_sections['ls']['iteration']; ?>
</strong> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['id']; ?>
"><img width="50" height="50" class="fl" alt="" src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['w_pic']; ?>
"/></a></p>
							<p> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
							<p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['w_price']; ?>
.00</strong></p>
						</li>
						<?php endfor; endif; ?>
					</ol>
					<!--同品牌-->
					<ol class="none">
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
						<li>
							<p class="p_0"><strong class="strong_0"><?php echo $this->_sections['ls']['iteration']; ?>
</strong> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['id']; ?>
"><img width="50" height="50" class="fl" alt="" src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['w_pic']; ?>
"/></a></p>
							<p> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
							<p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['w_price']; ?>
.00</strong></p>
						</li>
						<?php endfor; endif; ?>

					</ol>
					<!--同价位-->
					<ol class="none">
						<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['price']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<li>
							<p class="p_0"><strong class="strong_0"><?php echo $this->_sections['ls']['iteration']; ?>
</strong> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['id']; ?>
"><img width="50" height="50" class="fl" alt="" src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['w_pic']; ?>
"/></a></p>
							<p> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
							<p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['w_price']; ?>
.00</strong></p>
						</li>
						<?php endfor; endif; ?>
					</ol>
				</div>
			</div>
			<!--销售排行 end-->
			<!--最近浏览过页面 start-->
			<div class="mt_6">
				<h2 class="recent_view_tit">最近浏览过页面</h2>
				<ul class="recent_view">
				<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['lately']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<li>
						<p class="p_0"><a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['id']; ?>
"><img width="50" height="50" alt="" src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['w_pic']; ?>
"/></a></p>
						<p><a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
						<p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['w_price']; ?>
.00</strong></p>
					</li>
				<?php endfor; endif; ?>
				</ul>
			</div>
			<!--最近浏览过页面 end-->
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
				<div class="clear"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
	lastScrollY=0;
	function heartBeat(){
	var diffY;
	if (document.documentElement && document.documentElement.scrollTop)
	diffY = document.documentElement.scrollTop;
	else if (document.body)
	diffY = document.body.scrollTop
	else
	{/*Netscape stuff*/}
	percent=.1*(diffY-lastScrollY);
	if(percent>0)percent=Math.ceil(percent);
	else percent=Math.floor(percent);
	document.getElementById("full").style.top=parseInt(document.getElementById("full").style.top)+percent+"px";
	lastScrollY=lastScrollY+percent;
	if(diffY == 0){document.getElementById("full").style.display = "none"}
	else{document.getElementById("full").style.display = "block"}
	}
	suspendcode="<div id=\"full\" class='full1' style='display:none; POSITION:absolute; left:95%; top:400px; z-index:100;'><a href='javascript:top()'  target='_self'><img src='../../../../public/images/top.gif'/></a></div>"
	document.write(suspendcode);
	window.setInterval("heartBeat()",1);
	function top(){
		//	scrollTo(0,0)
		document.body.scrollTop = 0 ;
		document.documentElement.scrollTop = 0;
	}
	function show(){
		//商品ID
		var goods_id = document.getElementsByName("goods_id")[0].value;
		//商品图片
		var goods_img=document.getElementsByName("Images_url")[0].value;
		//商品名称
		var goods_name = document.getElementsByName("goods_name")[0].value;
		//商品价格
		var market_price = document.getElementsByName("market_price")[0].value;
		//商品数目
		var goods_quantity = document.getElementById("goods_amount").value;	
		//将数组myCart存入cookie
		common.intoCart(goods_id,goods_name,market_price,goods_img,goods_quantity);		
}
</script>
<script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();
</script>
</body>
</html>