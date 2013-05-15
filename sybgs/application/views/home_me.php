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
<script type="text/javascript" src="resource/home/js/jwc.js"></script>
</head>
<body>
<div class="so_main">
  <?php 
  	if($uid != 0):
  	echo form_open('home/modme') ?>
    <div class="page_tit"><?php echo $title;?></div>
	<div class="form2">	
      <dl class="lineD">
        <dt>用户名：</dt>
        <dd>
          <input name="name" id="name" type="text" value="<?php echo $user->name?>">
		  <input name="uid" type="hidden" value="<?php echo $user->uid?>">
          <p>用户进行登录的帐号</p>
		</dd>
      </dl>
      <dl class="lineD">
        <dt>电话：</dt>
        <dd>
          <input name="tel" id="tel" type="text" value="<?php echo $user->tel?>">
          <p>2-10位个中英文、数字、下划线和中划线组成</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>电子邮箱：</dt>
        <dd>
          <input name="email" id="email" type="text" value="<?php echo $user->email?>">
          <p>常用电子邮箱,用于找回密码</p>
      </dd>
      </dl>
      <div class="page_btm">
        <input id="zlsub" type="submit" class="btn_b" value="确定" />
      </div>
    </div>
	<?php
		echo form_close();
		endif;
	 ?>
	<div class="page_tit"><?php echo $title;?></div>
	<?php echo form_open('yd_home/admin_modsave') ?>
	<div class="form2" style="border:none">
      <?php if($uid == 'admin'):?>
	  <dl class="lineD">
        <dt>超级管理员：</dt>
        <dd>
          <input name="email" id="email" type="text" disabled="disabled" value="<?php echo $name?>">
          <p>您是超级管理员，仅限于修改自己的密码</p>
      </dd>
      </dl>
	  <?php endif;?>
	  
	  <dl class="lineD">
        <dt>密码：</dt>
        <dd>
          <input name="paw" id="paw" type="password">
		  <input name="uid" type="hidden" value="<?php echo $uid?>">
          <p>进行登录的密码</p>
        </dd>
		<dt>确认密码：</dt>
        <dd>
          <input name="paw2" id="paw2" type="password">
          <p>进行登录的密码</p>
        </dd>
      </dl>
      <div class="page_btm">
        <input id="pawsub" type="submit" class="btn_b" value="确定" />
      </div>
    </div>
	<?php echo form_close() ?>
</div>
<div style="text-align:center; color:#666666; font-size:12px;">
执行时间:<?php echo $this->benchmark->elapsed_time();?>秒
</div>
</body>
</html>
