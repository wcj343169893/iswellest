function form_submit(){
	if(document.login.username.value==""){
				alert('用户名不允许为空');
	}else if(document.login.password.value==""){
				alert('密码不允许为空');
	}
	else{
			document.getElementById("login").submit();
	}
	
}
function form_reset(){
	document.getElementById("login").reset();
}
function show(){
	if(window.event.keyCode==13){
			document.getElementById("login").submit();
	}
}
