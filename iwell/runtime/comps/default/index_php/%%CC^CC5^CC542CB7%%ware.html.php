<?php /* Smarty version 2.6.18, created on 2012-04-14 11:30:41
         compiled from index/ware.html */ ?>
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
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data']['w_pic']; ?>
" width="350" height="350" alt="" /></a>
				</div>
				<div id="goods_img_slide">
					<p id="goods_img_up"><a href="javascript:void(0)">向上</a></p>
					<!--
						小图片 50x50 直接写在 img的src
						大图片 350x350 写在小图片的alt标签中
					-->
					<ul>
					<?php unset($this->_sections['a']);
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['att']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<li class="active"><a href="javascript:void(0)"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/thumb/<?php echo $this->_tpl_vars['att'][$this->_sections['a']['index']]['t_pic']; ?>
" width="50" height="50" alt="<?php echo $this->_tpl_vars['public']; ?>
/images/big/<?php echo $this->_tpl_vars['att'][$this->_sections['a']['index']]['b_pic']; ?>
" /></a></li>
						<?php endfor; endif; ?>
					</ul>
					<p id="goods_img_down"><a href="javascript:void(0)">向上</a></p>
				</div>
			</div>
			<div class="goods_share">
				<a href="#">进入商品相册</a>
				<dl>
					<dt>分享到：</dt>
					<dd><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/goods/share_douban.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/goods/share_renren.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/goods/share_qq_t.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/goods/share_qq_k.png" width="16" height="16" alt="" /></a></dd>
					<dd><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/goods/share_sina.png" width="16" height="16" alt="" /></a></dd>
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
				<input type='hidden' id='w_id' name='w_id' value="<?php echo $this->_tpl_vars['data']['id']; ?>
">
				<dt><a href="#"><strong class="f14"><?php echo $this->_tpl_vars['data']['w_name']; ?>
</strong></a></dt>
				<dd>商品编号：<?php echo $this->_tpl_vars['data']['id']; ?>
</dd>
				<dd>品　　牌：<?php echo $this->_tpl_vars['data']['c_name']; ?>
</dd>
				<dd>普 泰 价：<strong class="f14 cb00" >￥<span id='price'><?php echo $this->_tpl_vars['data']['w_price']; ?>
</span></strong> <a href="#" class="c110">降价通知</a></dd>
				<dd><span class="fl">商品评价：</span><b class="goods_stars goods_stars_5">goods_stars_5</b><a class="fl" href="#goods_evaluation">(已有 <?php echo $this->_tpl_vars['comment_count']; ?>
人评价)</a></dd>
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
				<!--
					点击产品图，切换文字以及颜色
					产品颜色文字，以及色值，写入dd下的img的alt标签，格式为：文字|色值
				-->
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
				<p class="clearFix"><a href="javascript:show()" id="goods_add_cart" >加入购物车</a><a href="#" id="goods_add_favo">收藏此商品</a></p>
				<!-- 购物车用 -->
				<input type="hidden" name="goods_id" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
				<input type="hidden" name="Images_url" value="<?php echo $this->_tpl_vars['data']['w_pic']; ?>
" />
				<input type="hidden" name="goods_name" value="<?php echo $this->_tpl_vars['data']['w_name']; ?>
" />
				<input type="hidden" name="market_price" value="<?php echo $this->_tpl_vars['data']['w_price']; ?>
" />
				<script>
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
			</div>
		</div>
		<!--产品信息 end-->
		<div class="clear"></div>
	</div>
	<div class="mt_6 frame_main">
		<div class="goods_left">
			<!--商品相关信息 start-->
			<ul id="goods_info_main">
				<li class="active"><a href="javascript:void(0)">商品介绍</a></li>
				<li><a href="javascript:void(0">商品属性</a></li>
				<li><a href="javascript:void(0">包装清单</a></li>
				<li><a href="javascript:void(0">售后服务</a></li>
			</ul>
			<div id="goods_info_sub">
				<?php unset($this->_sections['i']);
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['inc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<div class="goods_info_sub_tabs <?php if ($this->_sections['i']['index'] > 0): ?>none<?php endif; ?>"><?php echo $this->_tpl_vars['inc'][$this->_sections['i']['index']]['content']; ?>
</div>
				<?php endfor; endif; ?>
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
						<span class="block">我曾在心云买过此商品</span>
						<a href="javascript:comment()">我要评价</a>
<div class="logins login_quick" id="unLogin" style="display:none;position:absolute; z-index:999999999;top:0;background:#FFFFFF;">
     <div class="logins_name"><span><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/logins_close.png" width="13" height="13"   onclick="unLoginClears(this)"/></span></div>
     <ul id="user_login_type">

			</ul>
			<div id="user_login_type_list">
				<div class="user_login_form">
					<form id="formlogins"  action="javascript:loginAjax()" method="post" onsubmit="submitComment(this)" name="commentForm" id="commentForm">
					<table align="center">
						<tr>
							<td>用户名:<input type='text' name='username' class='input_0'></td>
							</tr>
							 <tr><td>密	码: <input type='password' name='password' class='input_0'><td></tr>
							 <tr><td><input type='submit' value="登陆" id="user_reg_submit" style="border:0"></td><td><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/res">注册</a></td></tr>
					</table>
					<input id="comment" type="hidden" name="comment" value="1" />
					</form>
				</div>
  </div> 
</div>
						<script>
									function unLoginClears(thisis)
									{
											document.getElementById("unLogin").style.display = "none";
											document.body.removeChild(document.getElementById("comment_div"));
									}
									function getScrollTop()
									{
										var scrollTop=0;
										if(document.documentElement&&document.documentElement.scrollTop)
										{
											scrollTop=document.documentElement.scrollTop;
										}
										else if(document.body)
										{
											scrollTop=document.body.scrollTop;
										}
										return scrollTop;
									}
									function comment(){
											var bodys = document.createElement("DIV");
											bodys.style.position = "absolute";
											bodys.style.zIndex = "999999998";
											bodys.id = "comment_div";
											bodys.style.top = "0";
											bodys.style.width = (document.body.offsetWidth) + "px";
											bodys.style.height = (document.body.offsetHeight) + "px";
											document.body.appendChild(bodys);
											var d=document.getElementById('unLogin');
											d.style.display = "block";
											d.style.top= (parseFloat(getScrollTop())+150)+"px";
											d.style.left = parseInt((parseInt(document.body.offsetWidth)-450)/2) + "px";
									}	
						</script>
					</li>
				</ul>
			</div>
			<!--商品评价 end-->
			<!--商品留言 start-->
			<div class="goods_message">
				<div class="goods_mess_usr">
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/user.jpg" width="50" height="50" alt="" /></a>
					<a href="#" class="a_0">用户名</a>
					<span class="mt_6 c999 block">购买日期</span>
					<span class="c999">2011/03/17</span>
				</div>
				<div class="goods_mess_detail">
					<div class="goods_mess_tit">
						<span class="fl">姐姐说生日礼物，你值得拥有</span>
						<b class="goods_stars goods_stars_5">goods_stars_5</b>
						<span class="fr">2010/04/05 13:30:00</span>
					</div>
					<div class="goods_mess_text">
						<p class="goods_mess_text_left">&nbsp;</p>
						<a href="#" class="a_0">回 复</a>
					</div>
					<div class="goods_mess_reply">
					<?php unset($this->_sections['c']);
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['comment']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
						<dl>
							<dt><?php echo $this->_sections['i']['index']+1; ?>
.<a href="#"><?php echo $this->_tpl_vars['comment'][$this->_sections['c']['index']]['reg_username']; ?>
</a> 回复说：</dt>
							<dd><?php echo $this->_tpl_vars['comment'][$this->_sections['c']['index']]['com_conntent']; ?>
</dd>
						</dl>
					<?php endfor; endif; ?>
					</div>
				</div>
				<div class="clear"></div>
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
							<p>商品介绍商品介绍商品介绍</p><p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['brand'][$this->_sections['ls']['index']]['w_price']; ?>
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
							<p>商品介绍商品介绍商品介绍</p><p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['cat'][$this->_sections['ls']['index']]['w_price']; ?>
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
							<p>商品介绍商品介绍商品介绍</p><p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['price'][$this->_sections['ls']['index']]['w_price']; ?>
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
						<p>商品介绍商品介绍商品介绍</p><p><strong class="f14 cf00">￥<?php echo $this->_tpl_vars['lately'][$this->_sections['ls']['index']]['w_price']; ?>
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
</script>
</body>
</html>