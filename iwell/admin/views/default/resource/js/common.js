function Dd(i) {return document.getElementById(i);}
function Ds(i) {Dd(i).style.display = '';}
function Dh(i) {Dd(i).style.display = 'none';}
function Df(i) {Dd(i).focus();}

/**
 * <li class="tab_2" id="mall_t_1" onmouseover="Tb(1, 2, 'mall', 'tab');">XXX</li>
 * <div id="mall_c_1" style="">
 * */
function Tab(d, t, p, c) {
	for ( var i = 1; i <= t; i++) {
		if (d == i) {
			Dd(p + '_t_' + i).className = c + '_2';
			Ds(p + '_c_' + i);
		} else {
			Dd(p + '_t_' + i).className = c + '_1';
			Dh(p + '_c_' + i);
		}
	}
}
/**
 * 增加全选事件
 * */
function checkall(){
	// 增加全选按钮事件
	$("#checkall").bind("click", function() {
		var isChecked = $(this).attr("checked") ? true : false;
		$(".checks").attr("checked", isChecked);
	});
	// 多个按钮绑定事件
	$(".checks").bind("click", function() {
		var iCheck = true;
		$(".checks").each(function(index, domEle) {
			if (!$(domEle).attr("checked")) {
				iCheck = false;
				return;
			}
		});
		$("#checkall").attr("checked", iCheck);
	});
}
//页面初始化加载
$(document).ready(function(){
	if($("#checkall").length>0){
		checkall();
	}
});