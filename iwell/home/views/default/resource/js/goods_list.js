

$j(function(){
	//全部商品分类
	if ($j("#all_sort").length>0){
		all_sort();
	};
	//销售排行
	if ($j("#sell_ranking").length>0){
		sell_ranking();
	};
	//商品列表
	if ($j("#all_goods_list").length>0){
		all_goods_list();
	};
});

//全部商品分类
function all_sort(){
	var all_sort=$j("#all_sort");
	all_sort.find("b.icon").click(function(){
		var dl=$j(this).parents("dl");
		if (dl.attr("class")=="active") {
			dl.removeClass("active");
		}
		else {
			dl.addClass("active");
		}
	});
};

//销售排行
function sell_ranking() {
	var sell_tab_main=$j("#sell_tab_main");
	var sell_tab_sub=$j("#sell_tab_sub");
	sell_tab_main.children("li").click(function(){
		var _eq=$j(this).index();
		$j(this).addClass("active").siblings().removeClass("active");
		sell_tab_sub.children("ol:eq("+_eq+")").show().siblings().hide();
	});
};

//商品列表
function all_goods_list() {
	var all_goods_list=$j("#all_goods_list");
	all_goods_list.children("li").hover(
		function(){$j(this).addClass("active")},
		function(){$j(this).removeClass("active")}
	)
};
