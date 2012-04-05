<?php /* Smarty version 2.6.18, created on 2011-07-11 21:29:21
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cart.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/operate_Cookie.js"></script>
<script type="text/javascript">

//页面加载时执行
window.onload = function() {
	//更新购物车
	getCartInfo();
 }; 
//取得购物车信息
function getCartInfo(){
	
	var str="";
	
	var amount=0;
		
	//从Cookie中取出商品信息列表,并将其转化为数组
	var arr = common.convertArray();
	
	//如果数组是否为空
	if(arr != "" && arr != null && arr != "null")
	{	
		var s=null;
		//将商品信息从数组中循环取出
		for(i=0;i<arr.length;i++)
		{	
			//计算商品总额
			amount+=arr[i][2]*arr[i][4];
			 s+=arr[i][4]++;
		}
	}else{
		s=0;
	}
	
	//重置总金额
	document.getElementById("amount").innerText = amount;
	document.getElementById("sum").innerHTML= s;
}
</script>
</head>
<body>
<!--庆祝建党90周年 -->
<div id="index_hd">
<div class="border_natday_border">
<div class="body_natday">
<!-- 结束 -->
<div id="header">

	<!--头部mini导航条 start-->
	<div id="min_header">
		<div class="w960">
			<p class="min_logo">
				<a href="javascript:" name="home" title="购物网站"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/logo_mini.png" width="65" height="35" alt="" class="block" /></a>
				<span class="span_0">通用技术集团旗下购物网站</span>
			</p>
			<div class="mini_header_right">
				<p class="fl">
								<?php if ($_SESSION['reg_username'] == ''): ?>
									<a href="<?php echo $this->_tpl_vars['app']; ?>
/user/login" class="c040 min_button"><span class="span_1">请登录</span></a>
									<span class="fl">新用户？</span>
									<a href="<?php echo $this->_tpl_vars['app']; ?>
/user/reg" class="cde5 min_button"><span class="span_1">[免费注册]</span></a>
								<?php else: ?>
								<span class='fl'>您好，<a href="user.php"><font color="red" ><?php echo $_SESSION['reg_username']; ?>
</font></a>,欢迎来到普泰商城！</span><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/logout" target="_self">[退出]</a>									
								<?php endif; ?>
				</p>
				<ul>
					<li><a href="#">我的心云</a>|</li>
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
			<form action="<?php echo $this->_tpl_vars['app']; ?>
/search/ware" method="post">
			<div class="search">
				<!--input 的默认value需要与后面的js数据相同-->
				<p id="search_input"><input type="text" value="诺基亚" onfocus="search_focus(this,'诺基亚')" onblur="search_blur(this,'诺基亚')" name='content'/></p>
				&nbsp;
					<input type='submit' name='sub' value="搜索">
					</form>
			</div>
			<!--搜索框 end-->
			<dl>
				<dt>热门搜索：</dt>
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
			<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/group_buy/index">心云团购</a><b class="icon">icon</b></li>
			<li><a href="#">员工专区</a><b class="icon">icon</b></li>
			<li><a href="#">企业专区</a><b class="icon">icon</b></li>
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
				<li><a href="#" >手机配件</a>|</li>
				<li><a href="#" >电脑/办公</a>|</li>
				<li><a href="#" >数码/配件</a>|</li>
				<li><a href="#" >时尚影音</a>|</li>
				<li><a href="#" >日用商品</a></li>
			</ul>
			<!--商品导航列表 end-->
			<div class="header_cart">
				<p class="p_0"><span class="cf00">购物车</span>中有 <span class="cf00" id='sum'>0</span> 件商品 合计 <span class="cf00" id='amount'>0</span> 元 <a href="<?php echo $this->_tpl_vars['app']; ?>
/car/mycar" class="a_0">去结算</a></p>
			</div>
		</div>
	</div>
	<!--商品导航 end-->