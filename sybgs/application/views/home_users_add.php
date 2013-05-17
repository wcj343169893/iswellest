<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li><?php echo anchor('home','Home')?> <span class="divider">/</span></li>
		<li><?php echo anchor('/home/userslist/'.$role,$role_name.'列表')?> <span class="divider">/</span></li>
		<li><?php echo $title?></li>
	</ul>
</div>
<div class="form-horizontal">
  <?php 
  $data = array('onSubmit' => 'return checkSubmit();');
  echo form_open('home/addUsersSave',$data) ?>
  <input type="hidden" name="role" value="<?php echo $role?>">
  	<div class="control-group">
      	<label class="control-label" for="email">用户名：</label>
      	<div class="controls">
          <input name="name" class="input-xlarge focused" id="name" type="text" value="" onChange="checkUserName()" autofocus="autofocus">
          <span class="help-inline">用户进行登录的帐号，请使用真实姓名，添加后不可修改</span>
        </div>
	</div>
  	<div class="control-group">
      	<label class="control-label" for="tel">电话：</label>
      	<div class="controls">
          <input name="tel" class="input-xlarge" id="tel" type="text" value="">
          <span class="help-inline">常用电话</span>
        </div>
	</div>
  	<div class="control-group">
      	<label class="control-label" for="email">电子邮箱：</label>
      	<div class="controls">
          <input name="email" class="input-xlarge" id="email" type="text" value="">
          <span class="help-inline">常用电子邮箱</span>
        </div>
	</div>
  	<div class="control-group">
      	<label class="control-label" for="paw">密码：</label>
      	<div class="controls">
          <input name="paw" class="input-xlarge" id="paw" type="text" value="">
          <span class="help-inline">用户登录密码</span>
        </div>
	</div>
  	<div class="control-group">
      	<label class="control-label" for="paw2">确认密码：</label>
      	<div class="controls">
          <input name="paw2" class="input-xlarge" id="paw2" type="text" value="" onChange="checkpaw()">
          <span class="help-inline">确认密码密码</span>
        </div>
	</div>
	<?php if(empty($role)){?>
  	<div class="control-group">
      	<label class="control-label" for="paw2">评分权限：</label>
      	<div class="controls">
      		<label class="checkbox inline">
				<input type="checkbox" id="qx1" value="1" name="qx1"> 科技理念类
			  </label>
			  <label class="checkbox inline">
				<input type="checkbox" id="qx2" value="1" name="qx2"> 科技实物类
			  </label>
      		<span class="help-inline">该老师对科技理念类实验报告书的评分权限</span>
        </div>
	</div>
	<?php }?>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">确定</button>
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
<?php include('home_footer.php'); ?>