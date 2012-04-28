//首页幻灯slide_show
$(function() {
	if ($("#slide_show").length > 0) {
		slide_show();
	}
	;
});

// 首页幻灯slide_show
function slide_show() {
	slide_show_flag = true;
	var slide_main = $("#slide_main");
	var slide_sub = $("#slide_sub");
	slide_show_auto();
	/* 鼠标滑过数字 */
	slide_sub.children("li").mouseover(function() {
		slide_show_flag = false;
		slide_main.children("li:animated").stop(false, true);
		slide_show_start($(this).index());
	});
	/* 鼠标移出 */
	$("#slide_show").mouseleave(function() {
		slide_show_flag = true;
	});
	/* 自动 */
	function slide_show_auto() {
		if (slide_show_flag) {
			var _eq = slide_sub.children("li.active").index();
			var _max = slide_sub.children("li").length - 1;
			_eq == _max ? _eq = 0 : _eq = _eq + 1;
			slide_show_start(_eq);
		}
		;
		setTimeout(slide_show_auto, 5000);
	}
	;
	/* 基础切换 */
	function slide_show_start(_eq) {
		slide_main.children("li:eq(" + _eq + ")").fadeIn().siblings().fadeOut();
		slide_sub.children("li:eq(" + _eq + ")").addClass("active").siblings()
				.removeClass("active");
	}
	;
};
jQuery(document).ready(function() {
//	jQuery("#fabUserName").bind("click", function() {
//		if (jQuery(this).next().css("display") == "none") {
//			jQuery(this).parent().addClass("selected");
//			jQuery(this).next().show();
////			jQuery(document).bind("click", function() {
////				if (jQuery("#fabUserName").next().css("display") == "block") {
////					jQuery("#fabUserName").parent().removeClass("selected");
////					jQuery("#fabUserName").next().hide();
////				}
////			});
//		}else{
//			jQuery(this).parent().removeClass("selected");
//			jQuery(this).next().hide();
//			jQuery(document).unbind("click");
//		}
//	});
	jQuery(".cat_parent").hover(
			  function () {
				  jQuery(this).children(".cat_child").removeClass("hide");
			  },
			  function () {
				  jQuery(this).children(".cat_child").addClass("hide");
			  }
			);
});
