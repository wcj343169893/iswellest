var quantity=1;
$(document).ready(function(){
	$('.addtocart').on('click', function(event) {
		var p_id=$(this).attr("id");
		$.ajax({
			type: "POST",
			url: Shop.basePath + "shop/itemupdate",
			data: {
				id: p_id,
				quantity: $("#ProductQuantity_"+p_id).val(),
			},
			dataType: "json",
			success: function(data) {
				$("#shop_cart_count").html(data.Order.order_item_count);
				$('#msg').html('<div class="alert alert-success" id="flash_msg">Product Added to Shopping Cart</div>');
				$('#flash_msg').delay(2000).fadeOut('slow');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('big problems !!!'+textStatus+" . "+errorThrown);
			}
		});
		return false;
	});
	//初始化查询购物车信息
	$.get(Shop.basePath + "shop/carts", function(data){
		if(data){
			$("#shop_cart_count").html(data.Order.order_item_count);
		}
	});
	$(".p_q_minus").on('click',function(){
		//后面一个元素的值减一
		var $qunti=$(this).next();
		var nub=$qunti.val();
		if(nub>1){
			$qunti.val(nub-1);
		}
	});
	$(".p_q_add").on('click',function(){
		//后面一个元素的值加一
		var $qunti=$(this).prev();
		var nub=$qunti.val();
		$qunti.val(parseInt(nub)+1);
	});
	$(".product_quantitys").keyup(function(){
		//判断输入的数字是否小于0
		var value=$(this).val();
	    var reg = /^\d+$/;
	    if(value.match( reg ) && value>0){
	    	return true;
	    }
	    $(this).val("1");
	    return false;
	});
	$('.btn').bind("selectstart",function(){return false;});//禁止粘贴
});
