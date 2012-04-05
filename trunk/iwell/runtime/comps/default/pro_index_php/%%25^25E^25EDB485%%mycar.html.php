<?php /* Smarty version 2.6.18, created on 2011-07-08 23:34:40
         compiled from car/mycar.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云商城</title>
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
	
	var _div = document.getElementById("goods_info");
	
	//从Cookie中取出商品信息列表,并将其转化为数组
	var arr = common.convertArray();
	
	//如果数组是否为空
	if(arr != "" && arr != null && arr != "null")
	{	
		var s=null;
		//将商品信息从数组中循环取出
		for(i=0;i<arr.length;i++)
		{
				//alert(arr);
				str+='<tr><td>'+arr[i][0]+'</td><td align="left"><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/'+arr[i][3]+'" width="50" height="50" alt=""/></a> <a href="#" class="c110">'+arr[i][1]+'</a></td><td>￥<strong class="cf00">'+arr[i][2]+'</strong></td><td><div class="cart_goods_amount"><a class="cart_amount_reduce" href="javascript:void(0)">减少</a><input type="text" value="'+arr[i][4]+'" maxlength="3" class="cart_amount"><a class="cart_amount_plus" href="javascript:void(0)">增加</a></div></td><td><input type="button" value="加入收藏夹" class="button_0" /><input type="button" value="删除" class="button_0" onclick="common.reMoveOne('+arr[i][0]+');"/></td></tr>';
			
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
	$('#goods_info').append(str);
}
</script>
</head>

<body>

<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="<?php echo $this->_tpl_vars['app']; ?>
/index/index">首页</a> &gt; <a href="#">用户中心</a> &gt; <span>我的购物车</span></p>
	<div class="w960 mt_10 shop_cart_nav">
		<!--
			当前栏目 a class='active'
		-->
		<ul>
			<li class="li_0"><a  class="active">我的购物车</a></li>
			<li class="li_1"><a >填写核对信息单</a></li>
			<li class="li_2"><a >成功提交订单</a></li>
		</ul>
		<p class="fr">您目前可以享受购物满 <strong class="cf00">499</strong> 元 免运费的优惠</p>
	</div>
	<!--购物车列表 start-->
	<div class="w960 mt_10">
		<table class="shop_cart_table_0">
			<thead>
				<tr>
					<th>商品编号</th>
					<th>商品名称</th>
					<th>商品单价</th>
					<th>购买数量</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody  id='goods_info'>
			</tbody>
		</table>
	</div>
	<!--购物车列表 end-->
	<div class="w960 mt_10">
		<p class="fl">商品总数量：<strong class="cf00" id='sum'></strong> 商品金额总计:<strong class="cf00" id='amount'></strong> <a href="javascript:common.reMoveAll() " class="c110">清空购物车</a></p>
		<p class="fr"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/index" class="cart_button_0">继续购物</a><a href="<?php echo $this->_tpl_vars['app']; ?>
/order/orderinfo" class="cart_button_1">去结算</a></p>
	</div>
	<!--其他用户购买 start-->
	<div class="w960 mt_10">
		<h2><strong class="f14">购买该商品的用户还购买了</strong></h2>
		<div class="cart_others_buy">
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
				<li>
					<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_pic']; ?>
" width="150" height="150" alt="" class="block" /></a>
					<p class="mt_5 pro_name"><a href="#"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_name']; ?>
</a></p>
					<p class="cf00">心云价：<strong class="f14">￥<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_price']; ?>
.00</strong></p>
					<p><a href="我的购物车.html" class="a_0">加入购物车</a></p>
					<p><a href="#" class="a_0">加入收藏夹</a></p>
				</li>
				<?php endfor; endif; ?>
			</ul>
		</div>
	</div>
	<!--其他用户购买 end-->
	<!--优势保障 start-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>