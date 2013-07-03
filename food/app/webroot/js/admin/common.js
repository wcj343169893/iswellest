function to(url){
	window.location.href=url;
};
$(document).ready(function(){
	//增加用户事件
	$(".btn-user-add").live('click',function(){
		window.location.href="/admin/users/add";
	});
	
});