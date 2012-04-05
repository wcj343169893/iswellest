
//首页幻灯slide_show
$j(function(){
	if ($j("#slide_show").length>0){
		slide_show();
	};
});

//首页幻灯slide_show
function slide_show(){
	slide_show_flag=true;
	var slide_main=$j("#slide_main");
	var slide_sub=$j("#slide_sub");
	slide_show_auto();
	/*鼠标滑过数字*/
	slide_sub.children("li").mouseover(function(){
		slide_show_flag=false;
		slide_main.children("li:animated").stop(false,true);
		slide_show_start($j(this).index());
	});
	/*鼠标移出*/
	$j("#slide_show").mouseleave(function(){
		slide_show_flag=true;
	});
	/*自动*/
	function slide_show_auto(){
		if (slide_show_flag) {
			var _eq=slide_sub.children("li.active").index();
			var _max=slide_sub.children("li").length-1;
			_eq==_max?_eq=0:_eq=_eq+1;
			slide_show_start(_eq);
		};
		setTimeout(slide_show_auto,5000);
	};
	/*基础切换*/
	function slide_show_start(_eq){
		slide_main.children("li:eq("+_eq+")").fadeIn().siblings().fadeOut();
		slide_sub.children("li:eq("+_eq+")").addClass("active").siblings().removeClass("active");
	};
};