<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url() ;?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实验报告书提交网站</title>
<link type="text/css" rel="stylesheet" href="resource/home/style.css" />
<script type="text/javascript" src="resource/home/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="resource/home/js/jwc.js"></script>
<?php if($msg)echo $msg?>
<style type="text/css">
	.middle{
		font-family:黑体;
		font-weight:normal;
		font-size:16px;
		border-color:#E3E3E3;
		border-width:1px;
		border-style:solid;
		margin:0 auto;
		width:290px;
		padding:40px;
		background-color:#EBEBEB;
	}
	.heightMy{
		margin-top:20px;
	}
	button{
		border:none;
	}
	#submit{
		font-family:黑体;
		font-weight:normal;
		font-size:16px;
	}
</style>
</head>
<body>
<div class="Header">
  <div> <img src="resource/home/images/top_logo.png" alt=""  title=""/> </div>
</div>
<center>
  <div class="middle"> <?php echo form_open('login/checkUser') ?>
    <div class="heightMy">用户名：<input type="text" name="name" id="name" value="" style="height:20px;width:180px;line-height:20px;color:#333;font-size: 16px;vertical-align:middle" /></div>
    <div class="heightMy">密　码：<input type="password" name="paw" id="paw" value="" style="height:20px;width:180px;line-height:20px;color:#333;font-size: 16px;vertical-align:middle" /></div>
    <div class="heightMy"></div>
    <div class="heightMy"></div>
    <div class="heightMy"><input type="submit" value="登录" name="submit" id="submit"></div>
    <?php echo form_close() ?> </div>
</center>
</body>
</html>
