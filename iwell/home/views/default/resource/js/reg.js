

$j(function(){
	//正则表达式集合
	reGular=
	{
		pInt:/^[1-9]\d*$/,										//正整数
		username:/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[\w])*$/,	//用户名
		email:/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/,	//email
		password:/^[A-Za-z0-9]+$/								//密码
	};
	$j("#user_reg_submit").click(function(){
		if ($j("#reg_username").val().length==0){
			alert ("请输入用户名");
			$j("#reg_username")[0].focus();
		}
		else if (!reGular.username.test($j("#reg_username").val())) {
			alert ("用户名只能是10位以的字母+数字+英文");
			$j("#reg_username")[0].focus();
		}
		else if ($j("#reg_username").val().length>10){
			alert ("用户名只能是10位以的字母+数字+英文");
			$j("#reg_username")[0].focus();
		}
		else if (!reGular.email.test($j("#reg_email").val())){
			alert ("请输入正确的Email地址");
			$j("#reg_email")[0].focus();
		}
		/*
			这里判断密码强度
			密码值 $j("#reg_password").val()
			$j("#reg_password").keyup的时候取值判断
			$j("#password_strength").attr("class",这里赋值)
			password_strength_0 弱
			password_strength_1 中
			password_strength_2 强
		*/
		else if (!reGular.password.test($j("#reg_password").val())){
			alert ("密码为6-16位 字母或者数字");
			$j("#reg_password")[0].focus();
		}
		else if ($j("#reg_password").val().length<6){
			alert ("密码为6-16位 字母或者数字");
			$j("#reg_password")[0].focus();
		}
		else if ($j("#reg_password").val().length>16){
			alert ("密码为6-16位 字母或者数字");
			$j("#reg_password")[0].focus();
		}
		else if ($j("#reg_password").val()!=$j("#reg_confirm").val()){
			alert ("两次输入密码不一致");
			$j("#reg_confirm")[0].focus();
		}
		else {
			$j("#user_reg_form")[0].submit();
		}
	});
	
	$j("#user_login_type").children("li").click(function(){
		$j(this).addClass("active").siblings().removeClass("active");
		var _eq=$j(this).index();
		$j("div.user_login_form:eq("+_eq+")").show().siblings().hide();
	})
});
