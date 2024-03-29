
$j(function(){
	//正则表达式集合
	reGular=
	{
		pInt:/^[1-9]\d*$/            //正整数
	};
	//产品数量 
	if ($j(".cart_goods_amount").length>0){
		 cart_goods_amount();
	};
	
	//结算信息 配送地址 
	if ($j(".cart_address_show").length>0){
		 cart_address_show();
	};
	
	//结算信息 发票 
	if ($j("#cart_invoice_show").length>0){
		 cart_invoice_show();
	};
	
	//结算信息 运输 
	if ($j("#cart_payment_show").length>0){
		 cart_payment_show();
	};
	
	//结算信息 卡 
	if ($j("#cart_info_money").length>0){
		 cart_info_money();
	};
});

//单品页 产品数量
function cart_goods_amount(){
	var cart_amount=$j(".cart_amount");
	var cart_amount_reduce=$j(".cart_amount_reduce");
	var cart_amount_plus=$j(".cart_amount_plus");
	cart_amount.blur(function(){
		var _this=$j(this);
		var amount=parseInt(_this.val());
		if (!reGular.pInt.test(amount)) {
			alert ("商品数量，请输入正整数！");
			_this.focus();
		}
	});
	cart_amount_reduce.click(function(){
		var _this=$j(this);
		var cart_amount=_this.parent("div.cart_goods_amount").find("input.cart_amount");
		var amount=parseInt(cart_amount.val());
		if (isNaN(amount)){
			amount=1;
			cart_amount.val(amount)
		}
		else if (amount>1) {
			cart_amount.val(amount-=1)
		}
		else {
			return false;
		};
	});
	cart_amount_plus.click(function(){
		var _this=$j(this);
		var cart_amount=_this.parent("div.cart_goods_amount").find("input.cart_amount");
		var amount=parseInt(cart_amount.val());
		if (isNaN(amount)){
			amount=0
		};
		cart_amount.val(amount+1)
	});
};

//结算信息 发票 
function cart_invoice_show(){
	var cart_invoice_show=$j("#cart_invoice_show");
	var cart_invoice_edit=$j("#cart_invoice_edit");
	var cart_invoice_info=$j("#cart_invoice_info");
	var cart_invoice_submit=$j("#cart_invoice_submit");
	var cart_invoice_close=$j("#cart_invoice_close");
	cart_invoice_show.click(function(){
		if (cart_invoice_edit.is(":visible")) {
			cart_invoice_edit.hide();
			cart_invoice_info.show();
		}
		else {
			cart_invoice_edit.show();
			cart_invoice_info.hide();
		}
	});
	cart_invoice_submit.click(function(){
		cart_invoice_edit.hide();
		cart_invoice_info.show();
	});
	cart_invoice_close.click(function(){
		cart_invoice_edit.hide();
		cart_invoice_info.show();
	});
};

//结算信息 卡 
function cart_info_money() {
	var show_cart_info_money=$j("#show_cart_info_money");
	var cart_info_money=$j("#cart_info_money");
	show_cart_info_money.click(function(){
		if (cart_info_money.is(":visible")) {
			show_cart_info_money.find("em").html("+");
			cart_info_money.hide();
		}
		else {
			show_cart_info_money.find("em").html("-");
			cart_info_money.show();
		}
	});
};

//结算信息 运输 
function cart_payment_show(){
	var cart_payment_show=$j("#cart_payment_show");
	var cart_payment_edit=$j("#cart_payment_edit");
	var cart_payment_info=$j("#cart_payment_info");
	var cart_payment_submit=$j("#cart_payment_submit");
	var cart_payment_close=$j("#cart_payment_close");
	cart_payment_show.click(function(){
		if (cart_payment_edit.is(":visible")) {
			cart_payment_edit.hide();
			cart_payment_info.show();
		}
		else {
			cart_payment_edit.show();
			cart_payment_info.hide();
		}
	});
	cart_payment_submit.click(function(){
		cart_payment_edit.hide();
		cart_payment_info.show();
	});
	cart_payment_close.click(function(){
		cart_payment_edit.hide();
		cart_payment_info.show();
	});
};

//结算信息 配送地址 
function cart_address_show(){
	var cart_address_show=$j(".cart_address_show");
	var cart_address_edit=$j("#cart_address_edit");
	var cart_address_info=$j("#cart_address_info");
	var cart_address_submit=$j("#cart_address_submit");
	var cart_address_close=$j("#cart_address_close");
	cart_address_show.click(function(){
		if (cart_address_edit.is(":visible")) {
			cart_address_edit.hide();
			cart_address_info.show();
		}
		else {
			cart_address_edit.show();
			cart_address_info.hide();
		}
	});
	cart_address_submit.click(function(){
		cart_address_edit.hide();
		cart_address_info.show();
	});
	cart_address_close.click(function(){
		cart_address_edit.hide();
		cart_address_info.show();
	});
};