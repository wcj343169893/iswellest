<?php /* Smarty version 2.6.18, created on 2011-07-10 13:53:43
         compiled from order/orderinfo.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>普泰</title>
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
<script type='text/javascript'  src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery-1.4.2.js"></script>
<script type='text/javascript'  src="<?php echo $this->_tpl_vars['public']; ?>
/js/selectarea.js"></script>
<script>
window.onload = function() {
	//更新购物车
	getCartInfo();
 }; 
//取得购物车信息
function getCartInfo(){
	
	var str="";
	
	var amount=0;
	
	var _div = document.getElementById("goods_info");
	
	//从Cookie中取出商品信息列表,并将其转化为数组
	var arr = common.convertArray();
	
	//如果数组是否为空
	if(arr != "" && arr != null && arr != "null")
	{	
		var s=null;
		var a='';
		//将商品信息从数组中循环取出
		for(i=0;i<arr.length;i++)
		{
				//将商品的ID与商品组合成一个字符串
				att=arr[i][0]+'&'+arr[i][4]+'|';
				//alert(arr);
				str+='<tr><td><a href="#" class="c110">'+arr[i][1]+'</a></td><td><strong class="f14 cf00">￥'+arr[i][2]+'.00</strong></td><td>'+arr[i][4]+'</td><td><strong class="f14 cf00">￥'+arr[i][2]*arr[i][4]+'.00</strong></td></tr>';
			//计算商品总额
			amount+=arr[i][2]*arr[i][4];
			 s+=arr[i][4]++;
						 a+=att;
		}
	}else{
		s=0;
	}
	
	//重置总金额
	document.getElementById("amount").innerText = amount;
	$('#goods_info').append(str);
	var dv = document.getElementById("cart_address_info");
	var file = document.createElement("input");
	file.type="hidden";
	file.name='info';
	file.value=a;
	var price=document.createElement("input");
	price.type='hidden'
	price.name='price';
	price.value=amount;
	dv.appendChild(file);
	dv.appendChild(price);
}
</script>
</head>

<body>
<form action="<?php echo $this->_tpl_vars['app']; ?>
/pay/index" id='form' method='post'>
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="<?php echo $this->_tpl_vars['app']; ?>
/index/index">首页</a> &gt; <a href="#">用户中心</a> &gt; <span>我的购物车</span></p>
	<div class="w960 mt_10 shop_cart_nav">
		<!--
			当前栏目 a class='active'
		-->
		<ul>
			<li class="li_0"><a href="#">我的购物车</a></li>
			<li class="li_1"><a href="#" class="active">填写核对信息单</a></li>
			<li class="li_2"><a href="#">成功提交订单</a></li>
		</ul>
	</div>
	<!--收货人信息 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>收货人信息</strong></h2>
		<div class="cart_veri_info_list none" id="cart_address_edit">
			<h3><strong class="f14">收货人信息</strong> <a href="#" class="c110" id="cart_address_close">[关闭]</a></h3>
			<table class="shop_cart_table_0">
				<thead>
					<tr>
						<th colspan="4">收货人信息：</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="left">配送区域：</td>
						<td colspan="3" align="left">
				<select name="city1" id="city1" onChange="changepro('city2','city1');">
              <option value="" selected>请选择省</option>
              <option value='北京市'>北京市</option>
              <option value='天津市'>天津市</option>
              <option value='河北省'>河北省</option>
              <option value='山西省'>山西省</option>
              <option value='内蒙古区'>内蒙古区</option>
              <option value='辽宁省'>辽宁省</option>
              <option value='吉林省'>吉林省</option>
              <option value='黑龙江省'>黑龙江省</option>
              <option value='上海市'>上海市</option>
              <option value='江苏省'>江苏省</option>
              <option value='浙江省'>浙江省</option>
              <option value='安徽省'>安徽省</option>
              <option value='福建省'>福建省</option>
              <option value='江西省'>江西省</option>
              <option value='山东省'>山东省</option>
              <option value='河南省'>河南省</option>
              <option value='湖北省'>湖北省</option>
              <option value='湖南省'>湖南省</option>
              <option value='广东省'>广东省</option>
              <option value='广西区'>广西区</option>
              <option value='海南省'>海南省</option>
              <option value='重庆市'>重庆市</option>
              <option value='四川省'>四川省</option>
              <option value='贵州省'>贵州省</option>
              <option value='云南省'>云南省</option>
              <option value='西藏区'>西藏区</option>
              <option value='陕西省'>陕西省</option>
              <option value='甘肃省'>甘肃省</option>
              <option value='青海省'>青海省</option>
              <option value='宁夏区'>宁夏区</option>
              <option value='新疆区'>新疆区</option>
              <option value='台湾省'>台湾省</option>
              <option value='香港特区'>香港特区</option>
              <option value='澳门特区'>澳门特区</option>
			 </select>
							<select name="city2" id="city2" onChange="changecity('city3','city2');">
						    <option value="">请选择市</option>
						    </select>
							<select name="city3" id="city3">
					      <option value="">请选择区</option>
						  </select>
						</td>
					</tr>
					<tr>
						<td align="left">收货人姓名：</td>
						<td align="left"><input type="text" value="" id='consignee' name='consignee'/> <span class="cf00">必填</span></td>
						<td align="left">电子邮件地址：</td>
						<td align="left"><input type="text" value="" name='email'/> <span class="cf00">必填</span></td>
					</tr>
					<tr>
						<td align="left">详细地址：</td>
						<td align="left"><input type="text" value="" id='address' name='address'/> <span class="cf00">必填</span></td>
						<td align="left">邮政编码：</td>
						<td align="left"><input type="text" value="" name='postal'/></td>
					</tr>
					<tr>
						<td align="left">电话号码：</td>
						<td align="left"><input type="text" value="" name='dh'/></td>
						<td align="left">手机号码：</td>
						<td align="left"><input type="text" value=""/ id="phone" name='phone'> <span class="cf00">必填</span></td>
					</tr>
					<tr>
						<td align="left">最佳送货时间：</td>
						<td colspan="3" align="left">
							<select name='sendtime'><option value='工作日'>工作日</option></select> <span class="cf00">必填</span>
						</td>
					</tr>
					<tr>
						<td colspan="4"><input type="button" value="配送至这个地址" id="cart_address_submit" /></td>

					</tr>
				</tbody>
			</table>
		</div>
		<div class="cart_veri_info_list" id="cart_address_info">
			<table class="w_100">
				<tbody>
					<tr valign="middle">
						<td>收货人地址：</td>
						<td><input type="radio" /></td>
						<td>姓名:</td><td id='tdname'></td>
						<td>地址:</td><td id='tdaddress'></td>
						<td>手机:</td><td id='tdphone'></td>
						<td width="70%" align="right"><input type="button" value="修改" class="cart_address_show"/></td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
	<!--收货人信息 end-->
	<!--支付及配送方式 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>支付及配送方式</strong> <a href="javascript:void(0)" class="c110" id="cart_payment_show">修改</a></h2>
		<div class="cart_veri_info_list none" id="cart_payment_edit">
			<h3><strong class="f14">支付及配送方式</strong>  <a href="javascript:void(0)" id="cart_payment_close" class="c110">[关闭]</a></h3>
			<table>
				<tbody>
					<tr>
						<td colspan="2"><strong class="f14">支付方式</strong></td>
					</tr>
					<tr valign="top">
						<td><input type="radio" /> 在线支付</td>
						<td>
							<p class="c999">支持以下银行在线支付：</p>
							<p class="mt_5">
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
							</p>
							<p class="mt_5">
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
							</p>
							<p class="mt_5">
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
								<a href="#"><img src="images/ccb.gif" width="136" height="38" alt="" /></a>
							</p>
							<p class="mt_5">支持以下支付平台</p>
							<p class="mt_5"><a href="#"><img src="images/yeepay.jpg" width="136" height="38" alt="" /></a></p>
						</td>
					</tr>
					<tr>
						<td><input type="radio" /> 银行转账</td>
						<td class="c999">转账后1-5个工作日内到账</td>
					</tr>
					<tr>
						<td><input type="radio" /> 邮局汇款</td>
						<td class="c999">通过快钱平台收款，汇款后1-3个工作日内到账</td>
					</tr>
					<tr>
						<td><input type="radio" /> 货到付款</td>
						<td class="c999">签收货物时，将货款交给物流人员来完成交易</td>
					</tr>
					<tr>
						<td><input type="radio" /> 银行转账</td>
						<td class="c999">转账后1-5个工作日内到账</td>
					</tr>
				</tbody>
			</table>
			<div class="mt_10">
			<table class="shop_cart_table_0">
				<thead>
					<tr>
						<th>配送方式</th>
						<th>运费</th>
						<th>货物在途时间</th>
						<th>备注</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="radio" /> 鸿运物流</td>
						<td>0.00元 <span class="cf00">（免运费）</span></td>
						<td>1-5天</td>
						<td class="c999">一般选用价格较低廉的快递公司，或邮局快包、中铁快运等</td>
					</tr>
				</tbody>
			</table>
			</div>
			<p class="mt_10"><input type="button" value="保存支付方式及配送方式" id="cart_payment_submit"/></p>
		</div>
		<div class="cart_veri_info_list" id="cart_payment_info">
			<table>
				<tbody>
					<tr>
						<td>支付方式：在线支付</td>
					</tr>
					<tr>
						<td>配送方式：物流鸿讯</td>
					</tr>
					<tr>
						<td>运　　费：0.00元</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--支付及配送方式 end-->
	<!--发票信息 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>发票信息</strong> <a href="javascript:void(0)" class="c110" id="cart_invoice_show">修改</a></h2>
		<div id="cart_invoice_edit" class="cart_veri_info_list none">
			<h3><strong class="f14">发票信息</strong>  <a href="javascript:void(0)" id="cart_invoice_close" class="c110">[关闭]</a></h3>
			<table>
				<tbody>
					<tr>
						<td>发票类型：普通发票</td>
					</tr>
					<tr>
						<td>发票抬头：<input type="radio" />个人 <input type="radio" />单位</td>
					</tr>
					<tr>
						<td>发票内容：<input type="radio" />明细 <input type="radio" />电脑配件</td>
					</tr>
					<tr>
						<td><input type="button" value="确认修改" id="cart_invoice_submit"/></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="cart_veri_info_list" id="cart_invoice_info">
			<table>
				<tbody>
					<tr>
						<td>发票类型：普通发票</td>
					</tr>
					<tr>
						<td>发票抬头：个人</td>
					</tr>
					<tr>
						<td>发票内容：明细元</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--发票信息 end-->
	<!--订单备注 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>订单备注</strong></h2>
		<div class="cart_veri_info_list">
			<table class="w_100">
				<tbody>
					<tr>
						<td><textarea rows="5" class="w_100"></textarea></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--订单备注 end-->
	<!--商品信息 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>商品信息</strong> </h2>
		<div class="w960 mt_10">
			<table class="cart_veri_info_table_0">
				<thead>
					<tr>
						<th>商品名称</th>
						<th>普泰价</th>
						<th>购买数量</th>
						<th>小计</th>
					</tr>
				</thead>
				<tbody id='goods_info'>
				<!--金额信息 -->
				</tbody>
			</table>
		</div>
	</div>
	<!--商品信息 end-->
	<!--结算信息 start-->
	<div class="w960 mt_10">
		<h2 class="cart_veri_info_tit"><strong>结算信息</strong></h2>
		<div class="cart_veri_info_list">
			<p>商品金额：332960.00元 + 运费：0.00元 - 优惠券：0.00元 - 礼品卡：0.00元 - 余额：0.00元</p>
			<p class="mt_10 clearFix">
				<a href="javascript:void(0)" class="c110 fl" id="show_cart_info_money">（<em>+</em>）使用余额、优惠卷、礼品卡来抵消部分金额</a>
				<span class="fr f14">应付总额：<strong class="cf00" >￥<span id='amount'></span>.00</strong></span>
			</p>
			<div id="cart_info_money" class="none">
				<p class="mt_10">　使用余额：<input type="text" /> <span class="c999">您目前账户余额为：<span class="cf00">￥123.00</span></span></p>
				<p class="mt_10">使用优惠卷：<select><option>50元优惠卷</option></select></p>
				<p>　　　　　　有优惠卷但还没有绑定？<a href="#" class="c110">点此进行优惠卷绑定，了解普泰商城优惠卷规则</a></p>
				<p class="mt_10">使用礼品卡：有礼品卡但没有激活？<a href="#" class="c110">点此进行激活</a></p>
				<p class="mt_10">使用联心卡：</p>
				<div class="mt_10">
					<table class="shop_cart_table_0">
						<thead>
							<tr>
								<th>卡号</th>
								<th>面值</th>
								<th>类型</th>
								<th>余额</th>
								<th>有效期</th>
								<th>是否本次使用</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1111111</td>
								<td>￥50.00</td>
								<td>联心卡</td>
								<td>￥50.00</td>
								<td>2011/04/15 - 2012/04/15</td>
								<td><input type="checkbox" checked="checked" /></td>
							</tr>
							<tr>
								<td>1111111</td>
								<td>￥50.00</td>
								<td>联心卡</td>
								<td>￥50.00</td>
								<td>2011/04/15 - 2012/04/15</td>
								<td><input type="checkbox" checked="checked" /></td>
							</tr>
							<tr>
								<td>1111111</td>
								<td>￥50.00</td>
								<td>联心卡</td>
								<td>￥50.00</td>
								<td>2011/04/15 - 2012/04/15</td>
								<td><input type="checkbox" checked="checked" /></td>
							</tr>
						</tbody>
					</table>
				</div>
				<p class="mt_10 c999">提示：普泰商城礼品卡可多张一起使用，也可与余额、优惠卷混合使用。<a href="#" class="c110">什么是礼品卡？</a></p>
				<p class="mt_10">有联心卡但没有绑定？<a href="#" class="c110">点此进行绑定</a></p>
				<p class="mt_10 clearFix"><span class="fr">共使用了<span class="cf00">500元</span>余额、<span class="cf00">1</span>张优惠卷、<span class="cf00">1</span>联心卡，总共可以优惠<span class="cf00">300.00</span>元</span></p>
			</div>
			<p class="mt_10 clearFix"><input type="submit" value="确 定" class="fr"/></p>
			</form>
		</div>
	</div>
	<!--结算信息 end-->
</div>
</body>
</html>