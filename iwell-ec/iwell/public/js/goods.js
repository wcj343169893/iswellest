

$j(function(){
	//正则表达式集合
	reGular=
	{
		pInt:/^[1-9]\d*$/            //正整数
	};
	//单品页 产品图效果
	if ($j("#goods_img_slide").length>0){
		goods_img_slide();
	};
	
	//单品页 点击切换 颜色 
	if ($j("#goods_color").length>0){
		goods_color();
	};
	
	//单品页 产品数量
	if ($j("#goods_amount").length>0){
		 goods_amount();
	};
	
	//销售排行
	if ($j("#sell_ranking").length>0){
		sell_ranking();
	};
	
	//推荐配件
	if ($j("#recomm_fit_slide").length>0){
		recomm_fit_slide();
	};
	
	//商品相关信息  goods_eva_details
	if ($j("#goods_info_main").length>0){
		goods_info_main();
	};
	
	//商品评价  
	if ($j("#goods_eva_details").length>0){
		goods_eva_details();
	};
});

//单品页 产品图效果
function goods_img_slide(){
	var goods_img=$j("#goods_img>a>img");
	var goods_img_up=$j("#goods_img_up>a");
	var goods_img_down=$j("#goods_img_down>a");
	var goods_img_slide_ul=$j("#goods_img_slide>ul");
	//点击小图切换
	goods_img_slide_ul.children("li").mouseover(function(){
		$j(this).addClass("active").siblings().removeClass("active");
		goods_img.attr("src",$j(this).find("img").attr("alt"));
	});
	if (goods_img_slide_ul.children("li").length>5) {
		//上滚动
		goods_img_up.click(function(){
			goods_img_slide_ul.children("li:last").css("margin-top","-70px").prependTo(goods_img_slide_ul);
			goods_img_slide_ul.children("li:eq(0)").animate({"margin-top":"0"},300);
		});
		//下滚动
		goods_img_down.click(function(){
			var goods_li=goods_img_slide_ul.children("li:eq(0)")
			goods_li.animate({"margin-top":"-70px"},300,function(){
				goods_li.appendTo(goods_img_slide_ul).removeAttr("style");
			});
		});
	};
};

//单品页 点击切换 颜色
function goods_color() {
	var goods_color_img=$j("#goods_color>dd");
	var goods_color_info=$j("#goods_color_info");
	goods_color_img.click(function(){
		$j(this).addClass("active").siblings("dd").removeClass("active")
		var goods_color_text=$j(this).find("img").attr("alt").split("|");
		goods_color_info.text(goods_color_text[0]).css("color",goods_color_text[1]);
	});
};

//单品页 商品数量
function goods_amount() {
	var goods_amount=$j("#goods_amount");
	var goods_amount_reduce=$j("#goods_amount_reduce");
	var goods_amount_plus=$j("#goods_amount_plus");
	goods_amount.blur(function(){
		var amount=parseInt(goods_amount.val());
		if (!reGular.pInt.test(amount)) {
			alert ("商品数量，请输入正整数！");
			goods_amount.focus();
		}else{
				goods_amount.val(amount);
				var sumprice=$j('#price').text();
				var res=sumprice * (amount);
				$j('#sumprice').text(res);
		}
	});
	goods_amount_reduce.click(function(){
		var amount=parseInt(goods_amount.val());
		if (isNaN(amount)){
			amount=1;
			goods_amount.val(amount)
		}
		else if (amount>1) {
			goods_amount.val(amount-=1)
		var sumprice=$j('#price').text();
		var res=sumprice * (amount);
		$j('#sumprice').text(res);
			
		}
		else {
			return false;
		};
	});
	goods_amount_plus.click(function(){
		var amount=parseInt(goods_amount.val());
		if (isNaN(amount)){
			amount=0
		};
		var sumprice=$j('#price').text();
		goods_amount.val(amount+1)
		var res=sumprice * (amount+1);
		$j('#sumprice').text(res);
	});
};

//销售排行
function sell_ranking() {
	var sell_tab_main=$j("#sell_tab_main");
	var sell_tab_sub=$j("#sell_tab_sub");
	sell_tab_main.children("li").mouseover(function(){
		var _eq=$j(this).index();
		$j(this).addClass("active").siblings().removeClass("active");
		sell_tab_sub.children("ol:eq("+_eq+")").show().siblings().hide();
	});
};

//推荐配件
function recomm_fit_slide() {
	var recomm_fit_slide_ul=$j("#recomm_fit_slide>ul");
	var recomm_fit_left=$j("#recomm_fit_left>a");
	var recomm_fit_right=$j("#recomm_fit_right>a");
	if (recomm_fit_slide_ul.children("li").length>5) {
		//上滚动
		recomm_fit_left.click(function(){
			recomm_fit_slide_ul.children("li:last").css("margin-left","-150px").prependTo(recomm_fit_slide_ul);
			recomm_fit_slide_ul.children("li:eq(0)").animate({"margin-left":"0"},300);
		});
		//下滚动
		recomm_fit_right.click(function(){
			var recomm_fit_slide_li=recomm_fit_slide_ul.children("li:eq(0)")
			recomm_fit_slide_li.animate({"margin-left":"-150px"},300,function(){
				recomm_fit_slide_li.appendTo(recomm_fit_slide_ul).removeAttr("style");
			});
		});
	};
};

//商品相关信息 
function goods_info_main() {
	var goods_info_main=$j("#goods_info_main");
	var goods_info_sub=$j("#goods_info_sub");
	goods_info_main.children("li").click(function(){
		var _eq=$j(this).index();
		$j(this).addClass("active").siblings().removeClass("active");
		goods_info_sub.children("div.goods_info_sub_tabs:eq("+_eq+")").show().siblings().hide();
	});
};

//商品评价  
function goods_eva_details() {
	var oBj=$j("#goods_eva_details").children("li.li_1");
	oBj.find("i").each(function(){
		var _this=$j(this);
		var _width=_this.text()*150+"px";
		_this.css("width",_width);
	});
};
