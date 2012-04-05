<?php /* Smarty version 2.6.18, created on 2011-07-01 10:23:40
         compiled from index/ware.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>普泰</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/goods.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/goods.js"></script>
</head>

<body>
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="#">首页</a> &gt; <a href="#">电脑/办公</a> &gt; <a href="#">平板电脑</a> &gt; <span>苹果（Apple）iPad MB292CH/A 9.7英寸平板电脑 （16G ）</span></p>
	<div class="w960 mt_10">
		<!--产品图 start-->
		<div class="goods_info_left">
			<div class="clearFix">
				<div id="goods_img">
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/<?php echo $this->_tpl_vars['data']['w_pic']; ?>
" width="350" height="350" alt="" /></a>
				</div>
				<div id="goods_img_slide">
					<p id="goods_img_up"><a href="javascript:void(0)">向上</a></p>
					<!--
						实际应用，大图与小图最好分开。demo中是使用的一张图。
						小图片 50x50 直接写在 img的src
						大图片 350x350 写在小图片的alt标签中
					-->
					<ul>
						<li class="active"><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="images/goods/1.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/2.jpg" width="50" height="50" alt="images/goods/2.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/3.jpg" width="50" height="50" alt="images/goods/3.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/4.jpg" width="50" height="50" alt="images/goods/4.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="images/goods/1.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/2.jpg" width="50" height="50" alt="images/goods/2.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/3.jpg" width="50" height="50" alt="images/goods/3.jpg" /></a></li>
						<li><a href="javascript:void(0)"><img src="images/goods/4.jpg" width="50" height="50" alt="images/goods/4.jpg" /></a></li>
					</ul>
					<p id="goods_img_down"><a href="javascript:void(0)">向上</a></p>
				</div>
			</div>
			<div class="goods_share">
				<a href="#">进入商品相册</a>
				<dl>
					<dt>分享到：</dt>
					<dd><a href="#"><img src="images/goods/share_douban.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="images/goods/share_renren.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="images/goods/share_qq_t.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="images/goods/share_qq_k.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="images/goods/share_sina.png" width="16" height="16" alt="" /></a></dd>
				</dl>
				<a href="#">进入软件频道</a>
			</div>
		</div>
		<!--产品图 end-->
		<!--产品信息 start-->
		<div class="goods_info_right">
			<!--
				商品评价
				goods_stars_1 = 1星
				goods_stars_2 = 2星
				goods_stars_3 = 3星
				goods_stars_4 = 4星
				goods_stars_5 = 5星
			-->
			<dl class="goods_info">
				<dt><a href="#"><strong class="f14"><?php echo $this->_tpl_vars['data']['w_name']; ?>
</strong></a></dt>
				<dd>商品编号：<?php echo $this->_tpl_vars['data']['id']; ?>
</dd>
				<dd>品　　牌：诺基亚</dd>
				<dd>普 泰 价：<strong class="f14 cb00">￥<?php echo $this->_tpl_vars['data']['w_price']; ?>
</strong> <a href="#" class="c110">降价通知</a></dd>
				<dd><span class="fl">商品评价：</span><b class="goods_stars goods_stars_5">goods_stars_5</b><a class="fl" href="#">(已有 122 人评价)</a></dd>
			</dl>
			<dl class="goods_gifts">
				<dt>赠品：</dt>
				<dd><a href="#">诺基亚（NOKIA）BL-5K原装手机电池</a> <span class="cb00">X1</span></dd>
				<dd><a href="#">诺基亚（NOKIA）BL-5K原装手机电池</a> <span class="cb00">X1</span></dd>
				<dd><a href="#">诺基亚（NOKIA）BL-5K原装手机电池</a> <span class="cb00">X1</span></dd>
			</dl>
			<div class="goods_others">
				<!--
					点击产品图，切换文字以及颜色
					产品颜色文字，以及色值，写入dd下的img的alt标签，格式为：文字|色值
				-->
				<dl id="goods_color">
					<dt>
						<span class="block">选择颜色：</span>
						<span class="block">已选择：“<span id="goods_color_info" style="color:#ff00ea;">粉色</span>”</span>
					</dt>
					<dd class="active"><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="粉色|#ff00ea" /></a></dd>
					<dd><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="黑色|#000000" /></a></dd>
					<dd><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="红色|#f00f00" /></a></dd>
					<dd><a href="javascript:void(0)"><img src="images/goods/1.jpg" width="50" height="50" alt="黄色|#ff0ff0" /></a></dd>
				</dl>
				<dl>
					<dt>我 要 买：</dt>
					<dd><a href="javascript:void(0)" id="goods_amount_reduce">减少</a><input type="text" id="goods_amount" maxlength="3" value="1"/><a href="javascript:void(0)" id="goods_amount_plus">增加</a></dd>
					<dd>库存：<span>有货</span>/<span class="cf00">缺货</span>/<span class="cffb">预定</span></dd>
				</dl>
				<dl>
					<dt>商品总价：</dt>
					<dd><strong class="f14 cb00">￥780.00元</strong></dd>
				</dl>
				<p class="clearFix"><a href="我的购物车.html" id="goods_add_cart">加入购物车</a><a href="#" id="goods_add_favo">收藏此商品</a></p>
			</div>
		</div>
		<!--产品信息 end-->
	</div>
	<div class="w960 mt_10">
		<div class="goods_left">
			<!--推荐配件 start-->
			<div class="recomm_fit">
				<h2 class="recomm_fit_tit">推荐配件</h2>
				<div class="clearFix mt_10">
					<p id="recomm_fit_left"><a href="javascript:void(0)">向左</a></p>
					<div id="recomm_fit_slide">
						<ul>
							<li>
								<a href="#"><img src="images/goods/1.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/2.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/3.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/4.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/1.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/2.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/3.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
							<li>
								<a href="#"><img src="images/goods/4.jpg" width="100" height="100" alt="" class="block"/></a>
								<p class="p_0"><a href="#">配件名称配件名称配件名称</a></p>
								<p class="p_0"><strong class="cf00">￥200.00</strong></p>
							</li>
						</ul>
					</div>
					<p id="recomm_fit_right"><a href="javascript:void(0)">向右</a></p>
				</div>
			</div>
			<!--推荐配件 end-->
			<!--商品相关信息 start-->
			<ul id="goods_info_main">
				<li class="active"><a href="javascript:void(0)">商品介绍</a></li>
				<li><a href="javascript:void(0">商品属性</a></li>
				<li><a href="javascript:void(0">包装清单</a></li>
				<li><a href="javascript:void(0">售后服务</a></li>
			</ul>
			<div id="goods_info_sub">
				<div class="goods_info_sub_tabs">
					这里格式是后台编辑器生成的？
					商品介绍商品介绍商品介绍商品介绍商品介绍商品介绍
				</div>
				<div class="goods_info_sub_tabs none">
					这里格式是后台编辑器生成的？
					商品属性商品属性商品属性商品属性商品属性
				</div>
				<div class="goods_info_sub_tabs none">
					这里格式是后台编辑器生成的？
					包装清单包装清单包装清单包装清单包装清单包装清单
				</div>
				<div class="goods_info_sub_tabs none">
					这里格式是后台编辑器生成的？
					售后服务售后服务售后服务售后服务售后服务
				</div>
			</div>
			<!--商品相关信息 end-->
			<!--商品评价 start-->
			<div id="goods_evaluation">
				<ul class="goods_eva_info">
					<li><a href="#">全部评价（222）</a></li>
					<li><a href="#">好评（220）</a></li>
					<li><a href="#">中评（1）</a></li>
					<li><a href="#">差评（1）</a></li>
				</ul>
				<!--
					宽度显示
					ul id="goods_eva_details" 下的
					li class="li_1"
					中的<i></i>标签中写 0.00-1.00
				-->
				<ul id="goods_eva_details">
					<li class="li_0">
						<strong class="block f32">97%</strong>
						<span>好评度</span>
					</li>
					<li class="li_1">
						<p class="p_0"><span class="fl">好评</span><b class="icon"><i>0.97</i></b><span class="fl">97%</span></p>
						<p class="p_0"><span class="fl">中评</span><b class="icon"><i>0.02</i></b><span class="fl">2%</span></p>
						<p class="p_0"><span class="fl">差评</span><b class="icon"><i>0.01</i></b><span class="fl">1%</span></p>
					</li>
					<li class="li_2">
						<span class="block cf00">前5位发表评论的用户即可获得1元优惠卷。</span>
						<a href="#">查看优惠卷规则</a>
					</li>
					<li class="li_3">
						<span class="block">我曾在普泰买过此商品</span>
						<a href="#">我要评价</a>
					</li>
				</ul>
			</div>
			<!--商品评价 end-->
			<!--商品留言 start-->
			<div class="goods_message">
				<div class="goods_mess_usr">
					<a href="#"><img src="images/goods/5.jpg" width="50" height="50" alt="" /></a>
					<a href="#" class="a_0">用户名</a>
					<span class="mt_10 c999 block">购买日期</span>
					<span class="c999">2011/03/17</span>
				</div>
				<div class="goods_mess_detail">
					<div class="goods_mess_tit">
						<span class="fl">姐姐说生日礼物，你值得拥有</span>
						<b class="goods_stars goods_stars_5">goods_stars_5</b>
						<span class="fr">2010/04/05 13:30:00</span>
					</div>
					<div class="goods_mess_text">
						<p class="goods_mess_text_left">
						留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容留言内容
						</p>
						<a href="#" class="a_0">回 复</a>
					</div>
					<div class="goods_mess_reply">
						<dl>
							<dt>1.<a href="#">用户名</a> 回复说：</dt>
							<dd>回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容</dd>
						</dl>
						<dl>
							<dt>2.<a href="#">用户名</a> 回复说：</dt>
							<dd>回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容回复内容</dd>
						</dl>
					</div>
				</div>
			</div>
			<!--商品留言 end-->
			<ul class="goods_mess_flip">
				<li>共 12 页</li>
				<li><a href="#">第一页</a></li>
				<li><a href="#">上一页</a></li>
				<li><a href="#">下一页</a></li>
				<li><a href="#">最末页</a></li>
			</ul>
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
						<li>
							<p class="p_0"><strong class="strong_0">1</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">2</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">3</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">4</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">5</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">6</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">7</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">8</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">9</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">10</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述商品描述商品描述商品描述商品描述商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
					</ol>
					<!--同品牌-->
					<ol class="none">
						<li>
							<p class="p_0"><strong class="strong_0">1</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">2</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">3</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">4</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">5</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">6</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">7</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">8</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">9</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">10</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述123商品描述123商品描述123商品描述123商品描述123商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
					</ol>
					<!--同价位-->
					<ol class="none">
						<li>
							<p class="p_0"><strong class="strong_0">1</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">2</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">3</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">4</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">5</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">6</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">7</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">8</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">9</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
						<li>
							<p class="p_0"><strong class="strong_0">10</strong><a href="#"><img width="50" height="50" class="fl" alt="" src="images/goods_list/1.jpg"/></a></p>
							<p><a href="#">商品名称</a></p>
							<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
						</li>
					</ol>
				</div>
			</div>
			<!--销售排行 end-->
			<!--最近浏览过页面 start-->
			<div class="mt_10">
				<h2 class="recent_view_tit">最近浏览过页面</h2>
				<ul class="recent_view">
					<li>
						<p class="p_0"><a href="#"><img width="50" height="50" alt="" src="images/goods_list/1.jpg"/></a></p>
						<p><a href="#">商品名称</a></p>
						<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
					</li>
					<li>
						<p class="p_0"><a href="#"><img width="50" height="50" alt="" src="images/goods_list/1.jpg"/></a></p>
						<p><a href="#">商品名称</a></p>
						<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
					</li>
					<li>
						<p class="p_0"><a href="#"><img width="50" height="50" alt="" src="images/goods_list/1.jpg"/></a></p>
						<p><a href="#">商品名称</a></p>
						<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
					</li>
					<li>
						<p class="p_0"><a href="#"><img width="50" height="50" alt="" src="images/goods_list/1.jpg"/></a></p>
						<p><a href="#">商品名称</a></p>
						<p>商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品描述ABCD商品<strong class="f14 cf00">￥1234.00</strong></p>
					</li>
				</ul>
			</div>
			<!--最近浏览过页面 end-->
		</div>
	</div>
</div>
</body>
</html>