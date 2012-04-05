<?php /* Smarty version 2.6.18, created on 2011-07-11 08:43:39
         compiled from index/index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云商城</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/index.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/timeCountDown.js"></script>

</head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
<div class="w960 mt_10">
	<div class="col_left"> 
		<!--幻灯 start-->
		<div id="slide_show">
			<ul id="slide_main">
				<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/1.jpg" width="714" height="230" alt="" /></a></li>
				<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/2.jpg" width="714" height="230" alt="" /></a></li>
				<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/3.jpg" width="714" height="230" alt="" /></a></li>
			</ul>
			<ol id="slide_sub">
				<li class="active">1</li>
				<li>2</li>
				<li>3</li>
			</ol>
		</div>
		<!--幻灯 end--> 
	</div>
	<div class="col_right"> 
		<!--快报 start-->
		<dl class="bulletin_0">
			<dt><a href="<?php echo $this->_tpl_vars['url']; ?>
/listnews" class="fr">更多快报</a><strong class="f14 c502">商城快报</strong></dt>
			<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['c']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<dd><a href="<?php echo $this->_tpl_vars['url']; ?>
/content"><?php echo $this->_tpl_vars['c'][$this->_sections['ls']['index']]['title']; ?>
</a></dd>
			<?php endfor; endif; ?>
		</dl>
		<!--快报 end-->
		<p class="index_ad_0"> <a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/weibo.jpg" width="227" height="79" alt="" class="block" /></a> </p>
	</div>
</div>
<div class="w960 mt_10">
	<div class="col_left"> 
		<!--热门分类 start-->
		<div class="index_sort">
			<h3 class="index_tit_0"> <span class="fl">热门分类</span> </h3>
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
			<dl>
				<dt><font color='white'><?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['c_name']; ?>
</font></dt>
					<!--在便利这个根分类下的 子分类 -->
					<?php unset($this->_sections['a']);
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['cat'][$this->_sections['ls']['index']]['subcat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
						<dd><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cname/<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['subcat'][$this->_sections['a']['index']]['c_name']; ?>
"><?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['subcat'][$this->_sections['a']['index']]['c_name']; ?>
</a></dd>
					<?php endfor; endif; ?>
			</dl>
			<?php endfor; endif; ?>
		</div>
		<!--热门分类 end--> 
	</div>
	<div class="col_right"> 
		<!--今日团购 start-->
		<div class="index_group">
			<h3 class="index_tit_1">今日团购</h3>
			<a href="<?php echo $this->_tpl_vars['app']; ?>
/group_buy/index"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/tuan/980_G_1307928694774.jpg" width="150" height="150" alt="" /></a>
			<p class="p_0"><a href="#" class="cb00">仅售45元！3支coppertone水宝宝防晒乳液</a></p>
			<p class="p_0 c666">已团100000人（最低人数为1）</p>
	<div class="index_group_time"> <span class="span_0">离结束仅剩</span> <span class="span_1"> <span id="hour"></span>时 <span id="mini"></span>分 <span id="sec"></span>秒</span> </div>

		</div>
		<!--今日团购 end--> 
	</div>
</div>
<div class="w960 mt_10">
	<div class="col_left"> 
		<!--今日特价 start-->
		<div class="index_special">
			<h3 class="index_tit_0"> <span class="fl">今日特价</span> <a href="#" class="fr">全部商品&gt;&gt;</a> </h3>
			<div class="index_special_list">
				<div class="index_special_big"> <a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/lware/mobile.jpg" width="212" height="411" alt="" /></a> </div>
				<ul>
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
					<li> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
"><img  src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_pic']; ?>
" width="150" height="150" alt="" /></a>
					  <p class="pro_name"><a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
						<p class="cb00">心云价：￥<strong class="f14"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_price']; ?>
</strong></p>
					</li>
					<?php endfor; endif; ?>
				</ul>
			</div>
		</div>
		<!--今日特价 end--> 
		<!--手机配件 start-->
		<div class="index_special mt_10">
			<h3 class="index_tit_0"> <span class="fl">手机配件</span> <span class="fr"> <a href="搜索.html">波导</a> <a href="搜索.html">三星</a> <a href="搜索.html">波导</a> <a href="搜索.html">三星</a> <a href="搜索.html">波导</a> <a href="搜索.html">三星</a> <a href="搜索.html">全部商品&gt;&gt;</a> </span> </h3>
			<div class="index_special_list">
				<div class="index_special_big"> <a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/lware/ipod.jpg" width="212" height="411" alt="" /></a> </div>
				<ul>
				<?php unset($this->_sections['pj']);
$this->_sections['pj']['loop'] = is_array($_loop=$this->_tpl_vars['pj']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pj']['name'] = 'pj';
$this->_sections['pj']['show'] = true;
$this->_sections['pj']['max'] = $this->_sections['pj']['loop'];
$this->_sections['pj']['step'] = 1;
$this->_sections['pj']['start'] = $this->_sections['pj']['step'] > 0 ? 0 : $this->_sections['pj']['loop']-1;
if ($this->_sections['pj']['show']) {
    $this->_sections['pj']['total'] = $this->_sections['pj']['loop'];
    if ($this->_sections['pj']['total'] == 0)
        $this->_sections['pj']['show'] = false;
} else
    $this->_sections['pj']['total'] = 0;
if ($this->_sections['pj']['show']):

            for ($this->_sections['pj']['index'] = $this->_sections['pj']['start'], $this->_sections['pj']['iteration'] = 1;
                 $this->_sections['pj']['iteration'] <= $this->_sections['pj']['total'];
                 $this->_sections['pj']['index'] += $this->_sections['pj']['step'], $this->_sections['pj']['iteration']++):
$this->_sections['pj']['rownum'] = $this->_sections['pj']['iteration'];
$this->_sections['pj']['index_prev'] = $this->_sections['pj']['index'] - $this->_sections['pj']['step'];
$this->_sections['pj']['index_next'] = $this->_sections['pj']['index'] + $this->_sections['pj']['step'];
$this->_sections['pj']['first']      = ($this->_sections['pj']['iteration'] == 1);
$this->_sections['pj']['last']       = ($this->_sections['pj']['iteration'] == $this->_sections['pj']['total']);
?>
					<li> <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['pj'][$this->_sections['pj']['index']]['id']; ?>
"><img  src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['pj'][$this->_sections['pj']['index']]['w_pic']; ?>
" width="150" height="150" alt="" /></a>
						<p class="pro_name"><a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['pj'][$this->_sections['pj']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['pj'][$this->_sections['pj']['index']]['w_name']; ?>
</a></p>
						<p class="cb00">心云价：<strong class="f14">￥<?php echo $this->_tpl_vars['pj'][$this->_sections['pj']['index']]['w_price']; ?>
</strong></p>
				  </li>
				<?php endfor; endif; ?>
				  </li>
				</ul>
			</div>
		</div>
		<!--手机配件 end--> 
	</div>
	<div class="col_right"> 
		<!--右侧广告 宽度233 高度不限 start-->
		<?php unset($this->_sections['r']);
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['r']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
		<p class="index_ad_1 mt_10"><a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['r'][$this->_sections['r']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/<?php echo $this->_tpl_vars['r'][$this->_sections['r']['index']]['ad_pic']; ?>
" width="233" height="143" alt="" /></a></p>
		<?php endfor; endif; ?>
		<!--右侧广告 end--> 
	</div>
</div>
<!--专题推荐 start-->
<div class="w960 mt_10">
	<h3 class="index_tit_0"><span class="fl">专题推荐</span></h3>
	<!--推荐的图片，在一行显示的。宽度与外边距加在一起=960即可，ml_10是10px外边距-->
	<ul class="index_recomm">
		<li><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_01.jpg" width="478" height="126" alt="" /></a></li>
		<li class="ml_10"><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_02.jpg" width="468" height="126" alt="" /></a></li>
		<li><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_03.jpg" width="232" height="126" alt="" /></a></li>
		<li class="ml_10"><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_04.jpg" width="232" height="126" alt="" /></a></li>
		<li class="ml_10"><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_05.gif" width="232" height="126" alt="" /></a></li>
		<li class="ml_10"><a href="单品.html"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/rware/ad_footer_06.jpg" width="226" height="126" alt="" /></a></li>
	</ul>
</div>
<!--专题推荐 end--> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<!-- JS控制团购时间倒数-->
	         <script >
				 var d = Date.UTC(2012, 0,7, 16, 19);
				 var obj = {
					 sec:  document.getElementById("sec"),
					 mini: document.getElementById("mini"),
					 hour: document.getElementById("hour"),
					 day: document.getElementById("day1")
				}
				fnTimeCountDown(d, obj);
		</script >

</body>
</html>