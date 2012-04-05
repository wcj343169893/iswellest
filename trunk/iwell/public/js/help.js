

$j(function(){
	//帮助中心 下拉
	if ($j("#help_left_menu").length>0){
		help_left_menu();
	};
});

//帮助中心 下拉
function help_left_menu(){
	var help_left_menu=$j("#help_left_menu");
	help_left_menu.find("b.icon").click(function(){
		var dl=$j(this).parents("dl");
		if (dl.attr("class")=="active") {
			dl.removeClass("active");
		}
		else {
			dl.addClass("active");
		}
	});
};
