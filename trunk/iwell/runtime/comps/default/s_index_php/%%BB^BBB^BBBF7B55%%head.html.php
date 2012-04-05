<?php /* Smarty version 2.6.18, created on 2011-07-01 15:25:17
         compiled from public/head.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云商城</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/header.js"></script>

</head>
<body>
<div id="index_hd">
<div class="border_natday_border">
<div class="body_natday">
<div id="header">
	<!--头部mini导航条 start-->
	<div id="min_header">
		<div class="w960">
			<p class="min_logo">
				<a href="#" title="通用技术集团旗下购物网站"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/logo_mini.png" width="65" height="35" alt="" class="block" /></a>
				<span class="span_0">通用技术集团旗下购物网站</span>
			</p>
			<div class="mini_header_right">
				<p class="fl">
					<span class="fl">您好，欢迎来到普泰商城！</span>
					<a href="#" class="c040 min_button"><span class="span_1">请登录</span></a>
					<span class="fl">新用户？</span>
					<a href="#" class="cde5 min_button"><span class="span_1">[免费注册]</span></a>
				</p>
				<ul>
					<li><a href="#">我的普泰</a>|</li>
					<li><a href="#">我的订单</a>|</li>
					<li><a href="#">帮助中心</a>|</li>
					<li><a href="#">在线客服</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--头部mini导航条 end-->
	<!--头部广告位 start  宽度960，高度不限-->
	<div class="w960 header_ad"  style="padding-top:44px"><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ad.gif" width="960" alt="" class="block" /></a></div>
	<!--头部广告位 end-->
	<!--头部搜索栏 start-->
	<div class="header_func">
		<a href="#" class="header_logo"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/logo.png" width="209" height="45" alt="" class="block"/></a>
		<!--搜索 start-->
		<div class="header_search">
			<!--搜索框 start-->
			<div class="search">
				<!--input 的默认value需要与后面的js数据相同-->
				<p id="search_input"><input type="text" value="佳能CP500" onfocus="search_focus(this,'佳能CP500')" onblur="search_blur(this,'佳能CP500')"/></p>
				<a href="#">搜 索</a>
			</div>
			<!--搜索框 end-->
			<dl>
				<dt>热门搜索：</dt>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
				<dd><a href="#">诺基亚</a></dd>
			</dl>
		</div>
		<!--搜索 end-->
		<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/qua.png" width="213" height="43" alt="" class="fr"/></a>
	</div>
	<!--头部搜索栏 end-->
	<!--主导航 start-->
	<div id="nav">
		<!--激活栏目 li class='active' 字数不限，自适应-->
		<ul>
			<li class="active"><a href="#">首 页</a><b class="icon">icon</b></li>
			<li><a href="#">普泰团购</a><b class="icon">icon</b></li>
			<li><a href="#">员工专区</a><b class="icon">icon</b></li>
			<li><a href="#">企业专区</a><b class="icon">icon</b></li>
			<li><a href="#">字数自适应</a><b class="icon">icon</b></li>
			<li><a href="#">自适应</a><b class="icon">icon</b></li>
		</ul>
		<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/400.png" width="217" alt="" class="fr mr_20" /></a>
	</div>
	<!--主导航 end-->
	<!--商品导航 start-->
	<div id="nav_goods" onmouseout="mouseleave(event,this,function(){hide_pop('5')})">
		<div class="w960">
			<!--商品导航列表 start-->
			<ul class="header_goods_list">
				<li><a href="#" onmouseover="show_goods_list(0,5)">手机配件</a>|</li>
				<li><a href="#" onmouseover="show_goods_list(1,5)">电脑/办公</a>|</li>
				<li><a href="#" onmouseover="show_goods_list(2,5)">数码/配件</a>|</li>
				<li><a href="#" onmouseover="show_goods_list(3,5)">时尚影音</a>|</li>
				<li><a href="#" onmouseover="show_goods_list(4,5)">日用商品</a></li>
			</ul>
			<!--商品导航列表 end-->
			<div class="header_cart">
				<p class="p_0"><span class="cf00">购物车</span>中有 <span class="cf00">0</span> 件商品 合计 <span class="cf00">0</span> 元 <a href="#" class="a_0">去结算</a></p>
			</div>
		</div>
		<!--商品子列表 start-->
		<div id="header_goods">
			<div class="goods_pop" id="goods_pop_0">
				<div class="goods_pop_left">
					<h3 class="h3"><a href="#">网络</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
				</div>
				<ol class="goods_pop_right">
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
				</ol>
			</div>
			<div class="goods_pop" id="goods_pop_1">
				<div class="goods_pop_left">
					<h3 class="h3"><a href="#">网络123</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络123</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络123</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络123</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络123</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
				</div>
				<ol class="goods_pop_right">
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
				</ol>
			</div>
			<div class="goods_pop" id="goods_pop_2">
				<div class="goods_pop_left">
					<h3 class="h3"><a href="#">网络2222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络2222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络2222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络2222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络2222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
				</div>
				<ol class="goods_pop_right">
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
				</ol>
			</div>
			<div class="goods_pop" id="goods_pop_3">
				<div class="goods_pop_left">
					<h3 class="h3"><a href="#">网络23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
				</div>
				<ol class="goods_pop_right">
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
				</ol>
			</div>
			<div class="goods_pop" id="goods_pop_4">
				<div class="goods_pop_left">
					<h3 class="h3"><a href="#">网络44啊啊23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络44啊啊23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络44啊啊23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络44啊啊23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
					<h3 class="h3"><a href="#">网络44啊啊23452222</a></h3>
					<ul>
						<li><a href="#">GSM手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">CDMA手机</a>|</li>
						<li><a href="#">联通3G</a>|</li>
						<li><a href="#">电信3G</a>|</li>
						<li><a href="#">双卡手机</a>|</li>
						<li><a href="#">双卡手机</a></li>						
					</ul>
				</div>
				<ol class="goods_pop_right">
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
					<li><a href="#"><img src="images/demo/1.png" width="69" height="27" alt="" /></a></li>
				</ol>
			</div>
		</div>
		<!--商品子列表 end-->
	</div>
	<!--商品导航 end-->