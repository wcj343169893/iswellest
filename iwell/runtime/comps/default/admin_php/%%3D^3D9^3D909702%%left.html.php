<?php /* Smarty version 2.6.18, created on 2012-04-03 12:30:20
         compiled from index/left.html */ ?>
﻿<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.accordion.js"></script>
<script language="javascript">
	jQuery().ready(function(){
		jQuery('#navigation').accordion({
			header: '.head',
			navigation1: true, 
			event: 'click',
			fillSpace: true,
			animated: 'bounceslide'
		});
	});
</script>
<style type="text/css">
<!--
body {
	margin:0px;
	padding:0px;
	font-size: 12px;
}
#navigation {
	margin:0px;
	padding:0px;
	width:147px;
}
#navigation a.head {
	cursor:pointer;
	background:url(<?php echo $this->_tpl_vars['res']; ?>
/images/main_34.gif) no-repeat scroll;
	display:block;
	font-weight:bold;
	margin:0px;
	padding:5px 0 5px;
	text-align:center;
	font-size:12px;
	text-decoration:none;
}
#navigation ul {
	border-width:0px;
	margin:0px;
	padding:0px;
	text-indent:0px;
}
#navigation li {
	list-style:none; display:inline;
}
#navigation li li a {
	display:block;
	font-size:12px;
	text-decoration: none;
	text-align:center;
	padding:3px;
}
#navigation li li a:hover {
	background:url(<?php echo $this->_tpl_vars['res']; ?>
/images/tab_bg.gif) repeat-x;
		border:solid 1px #adb9c2;
}
a:link{color:#335B64;font-family:Arial;font-size:14px;text-decoration:none;}

a:visited{color:#335B64;font-family:Arial;font-size:14px;text-decoration:none;}
a:hover{color:#06C;font-family:Arial;font-size:14px;text-decoration:none;} 
-->
</style>
</head>
<body>
<div  style="height:100%;">
  <ul id="navigation">
    <li> <a class="head">商品管理</a>
      <ul>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/ware/index" target="rightFrame">商品列表</a></li>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/ware/add" target="rightFrame">添加商品</a></li>
		 <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/ware/recover" target="rightFrame">商品回收站</a></li>
		 <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/cat/index" target="rightFrame">分类列表</a></li>
		 <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/brand/index" target="rightFrame">品牌列表</a></li>
		 <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/comment/index" target="rightFrame">用户评论</a></li>
      </ul>
    </li>
	    <li> <a class="head">用户管理</a>
      <ul>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/index" target="rightFrame">用户列表</a></li>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/add" target="rightFrame">添加用户</a></li>
		 <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/quanxian" target="rightFrame">权限管理</a></li>
      </ul>
    </li>
    <li> <a class="head">订单管理</a>
      <ul>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/order/index" target="rightFrame">订单列表</a></li>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/order/select" target="rightFrame">订单查询</a></li>
      </ul>
    </li>
    <li> <a class="head">商城快报管理</a>
      <ul>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/content/add" target="rightFrame">查看/添加快报</a></li>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/content/index" target="rightFrame">查看/删除快报</a></li>
      </ul>
    </li>
    <li> <a class="head">友情链接管理</a>
      <ul>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/link/addlink" target="rightFrame">添加友情链接</a></li>
        <li><a href="<?php echo $this->_tpl_vars['app']; ?>
/link/listlink" target="rightFrame">查看/修改友情链接</a></li>
      </ul>
    </li>
    <li> <a class="head">团购管理</a>
      <ul>
        <li><a href="" target="rightFrame">品牌列表</a></li>
        <li><a href="" target="rightFrame">添加品牌</a></li>
      </ul>
    </li>
    <li> <a class="head">版本信息</a>
      <ul>
        <li><a href="http://Www.865171.cn" target="_blank">by Jessica(865171.cn)</a></li>
      </ul>
    </li>
  </ul>
</div>
</body>
</html>