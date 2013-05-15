<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?php echo base_url() ;?>"/>
<title>实验报告书提交网站</title>
<link href="resource/home/style2.css" rel="stylesheet" type="text/css">
<link href="resource/home/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resource/home/js/jquery-1.6.2.min.js"></script>
</head>
<body>
<div class="so_main">
  <?php 
  $data = array('onSubmit' => 'return checkSubmit();');
  echo form_open('home/addUsersSave',$data) ?>
    <div class="page_tit"><?php echo $title;?></div>
	<div class="form2">	
      <dl class="lineD">
        <dt>用户名：</dt>
        <dd>
          <input name="name" id="name" type="text" value="" onChange="checkUserName()">
          <p>用户进行登录的帐号，请使用真实姓名，添加后不可修改</p>
		  <div id="msg" style="display:none"></div>
		</dd>
      </dl>
      <dl class="lineD">
        <dt>电话：</dt>
        <dd>
          <input name="tel" id="tel" type="text" value="">
          <p>常用电话</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>电子邮箱：</dt>
        <dd>
          <input name="email" id="email" type="text" value="">
          <p>常用电子邮箱</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>密码：</dt>
        <dd>
          <input name="paw" id="paw" type="password">
          <p>用户进行登录的密码</p>
        </dd>
		<dt>确认密码：</dt>
        <dd>
          <input name="paw2" id="paw2" type="password" onChange="checkpaw()">
          <p>用户进行登录的密码</p>
        </dd>
      </dl>
	  <dl class="lineD">
        <dt>评分权限：</dt>
        <dd>
          <label><input name="qx1" id="qx1" type="checkbox" value="1">科技理念类</label>&nbsp;&nbsp;&nbsp;<label><input name="qx2" id="qx2" type="checkbox" value="1">科技实物类</label>
          <p>该老师对科技理念类实验报告书的评分权限</p>
      </dd>
      </dl>
      <div class="page_btm">
        <input id="zlsub" type="submit" class="btn_b" value="确定" />
      </div>
    </div>
	<?php echo form_close() ?>
</div>
<script language=javascript>
function checkUserName() {
	var names = $('#name').val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/checkUser'); ?>",
		data: {name:names},
		success: function(data){
			$("#msg").html(data); // 把返回的数据添加到页面上
		}
	});
}
function checkSubmit(){
	var name = document.getElementById("name").value;
	if(name == ""){
		alert("请输入用户名！");
		document.getElementById("name").focus();
		return false;
	}
	var paw = document.getElementById("paw").value;
	if(paw == ""){
		alert("请输入密码！");
		document.getElementById("paw").focus();
		return false;
	}
	var paw2 = document.getElementById("paw2").value;
	if(paw2 == ""){
		alert("请再次输入密码！");
		document.getElementById("paw2").focus();
		return false;
	}
	if(!document.getElementById("qx1").checked){
		if(!document.getElementById("qx2").checked){
			alert("您没有赋予改老师用户任何权限！");
			return false;
		}
	}
	return true;
}
function checkpaw(){
	var paw = document.getElementById("paw").value;
	var paw2 = document.getElementById("paw2").value;
	if(paw != paw2){
		alert("两次密码不一致~！请重新输入");
		document.getElementById('paw2').value = '';
		document.getElementById("paw2").focus();
		return false;
	}
	return true;
}
</script>
</body>
</html>
