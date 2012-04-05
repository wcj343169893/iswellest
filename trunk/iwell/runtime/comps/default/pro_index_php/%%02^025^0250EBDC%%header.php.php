<?php /* Smarty version 2.6.18, created on 2011-06-28 15:20:42
         compiled from public/header.php */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>普泰</title>
<link href="css/header.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/header.js"></script>
</head>

<body>
<div id="header">
	<!--头部mini导航条 start-->
	<div id="min_header">
		<div class="w960">
			<p class="min_logo">
				<a href="#" title="通用技术集团旗下购物网站"><img src="images/logo_mini.png" width="65" height="35" alt="" class="block" /></a>
				<span class="span_0">通用技术集团旗下购物网站</span>
			</p>
			<div class="mini_header_right">
				<p class="fl">
					<span class="fl">您好，欢迎来到商城！</span>
					<a href="login.php" class="c040 min_button"><span class="span_1">请登录</span></a>
					<span class="fl">新用户？</span>
					<a href="注册.html" class="cde5 min_button"><span class="span_1">[免费注册]</span></a>
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
	<div class="w960 header_ad"><a href="#"><img src="images/ad.gif" width="960" alt="" class="block" /></a></div>
	<!--头部广告位 end-->
	<!--头部搜索栏 start-->
	<div class="header_func">
		<a href="#" class="header_logo"><img src="images/logo.png" width="209" height="45" alt="" class="block"/></a>
		<!--搜索 start-->
		<div class="header_search">
			<!--搜索框 start-->
			<div class="search">
				<!--input 的默认value需要title相同-->
				<form action='level.php' method='post'>
				<p id="search_input"><input type="text" value="佳能CP500" title="佳能CP500" name='name'/></p>
				<input type='submit' value='搜 索' name='sub' class='but'>
				</form>
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
		<a href="#"><img src="images/qua.png" width="213" height="43" alt="" class="fr"/></a>
	</div>
	<!--头部搜索栏 end-->
	<!--主导航 start-->
	<div id="nav">
		<!--激活栏目 li class='active' 字数不限，自适应-->
		<ul>
			<li class="active"><a href="#">首 页</a><b class="icon">icon</b></li>
			<li><a href="#">团购</a><b class="icon">icon</b></li>
			<li><a href="#">员工专区</a><b class="icon">icon</b></li>
			<li><a href="#">企业专区</a><b class="icon">icon</b></li>
			<li><a href="#">字数自适应</a><b class="icon">icon</b></li>
			<li><a href="#">自适应</a><b class="icon">icon</b></li>
		</ul>
		<a href="#"><img src="images/400.png" width="217" alt="" class="fr mr_20" /></a>
	</div>
	<!--主导航 end-->
	<!--商品导航 start-->
	<div id="nav_goods">
		<div class="w960">
			<!--商品导航列表 start-->
			<ul class="header_goods_list" id="nav_goods_main">
				<li><a href="#">手机配件</a>|</li>
				<li><a href="#">电脑/办公</a>|</li>
				<li><a href="#">数码/配件</a>|</li>
				<li><a href="#">时尚影音</a>|</li>
				<li><a href="#">日用商品</a></li>
			</ul>
			<!--商品导航列表 end-->
			<div class="header_cart">
			<?php echo '<?php'; ?>
 
					session_start();
					if(empty($_SESSION['num']) &&  empty($_SESSION['count'])){
							$num=0;
							$count=0;
					}else{
							$num=$_SESSION['num'];
							$count=$_SESSION['count'];
					}
			<?php echo '?>'; ?>

				<p class="p_0"><span class="cf00"><a href='shopcar.php'>购物车</a></span>中有 <span class="cf00"><?php echo '<?php'; ?>
 echo $num;<?php echo '?>'; ?>
</span> 件商品 合计 <span class="cf00"><?php echo '<?php'; ?>
 echo $count; <?php echo '?>'; ?>
</span> 元 <a href="check.php" class="a_0">去结算</a></p>
			</div>
		</div>
		<!--商品子列表 start-->
		<div id="nav_goods_sub">
			<div class="goods_pop">
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
			<div class="goods_pop">
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
			<div class="goods_pop">
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
			<div class="goods_pop">
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
			<div class="goods_pop">
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
				</ol>
			</div>
		</div>
		<!--商品子列表 end-->
	</div>
	<!--商品导航 end-->
	<!--
</div>
	<div class="w960">
		<p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p><p>1</p>
	</div>
<!--底部 start-->
<!--
<div class="w960 mt_10">
		<div id="service" class="clearFix">
			<dl class="dl_0">
				<dt><a href="#">购物指南</a></dt>
				<dd><a href="#">注册流程</a></dd>
				<dd><a href="#">订购流程</a></dd>
			</dl>
			<dl class="dl_1">
				<dt><a href="#">配送服务</a></dt>
				<dd><a href="#">配送服务</a></dd>
				<dd><a href="#">配送时间</a></dd>
				<dd><a href="#">配送方式</a></dd>
				<dd><a href="#">运费说明</a></dd>
			</dl>
			<dl class="dl_2">
				<dt><a href="#">支付说明</a></dt>
				<dd><a href="#">支付方式</a></dd>
			</dl>
			<dl class="dl_3">
				<dt><a href="#">售后服务</a></dt>
				<dd><a href="#">如何退换货</a></dd>
				<dd><a href="#">在线客服</a></dd>
				<dd><a href="#">顾客留言板</a></dd>
			</dl>
			<dl class="dl_4">
				<dt><a href="#">会员中心</a></dt>
				<dd><a href="#">找回密码</a></dd>
				<dd><a href="#">会员权益</a></dd>
				<dd><a href="#">优 惠 券</a></dd>
			</dl>
			<a href="#"><img src="images/service.png" alt="" class="fr" /></a>
		</div>
	</div>
<div id="footer">
		<dl id="links">
			<dt>友情链接：</dt>
			<dd><a href="#">中国邮电器材集团</a>|</dd>
			<dd><a href="#">中国通用技术集团</a>|</dd>
			<dd><a href="#">信息产业部</a>|</dd>
			<dd><a href="#">普泰通信</a>|</dd>
			<dd><a href="#">英特达</a>|</dd>
			<dd><a href="#">国资委</a>|</dd>
			<dd><a href="#">中国足彩网</a></dd>
		</dl>
		<ul class="footer_nav">
			<li><a href="#">关于我们</a>|</li>
			<li><a href="#">普泰承诺</a>|</li>
			<li><a href="#">联系我们</a>|</li>
			<li><a href="#">人才招聘</a>|</li>
			<li><a href="#">友情链接</a>|</li>
			<li><a href="#">网站联盟</a></li>
		</ul>
		<p class="mt_10">普泰商城 版权所有 京ICP备11006562号  Copyright©2006-2011 ptacmall.com</p>
		<ul class="footer_links">
			<li><a href="#"><img src="images/link_0.png" alt="" /></a></li>
			<li><a href="#"><img src="images/link_1.png" alt="" /></a></li>
			<li><a href="#"><img src="images/link_2.png" alt="" /></a></li>
		</ul>
	</div>
	-->
<!--底部 end-->
</body>
</html>