<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<?php echo anchor('home','Home')?> <span class="divider">/</span>
		</li>
		<li><?php echo $title;?></li>
	</ul>
</div>
  <?php 
  	if($uid != 0):
  	echo form_open('home/modme') ?>
	<div class="form-horizontal">
	<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#tab_userinfo">基本信息</a></li>
			<li><a href="#tab_password">密码</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	<div class="tab-pane active" id="tab_userinfo">
		<div class="control-group">
	      	<label class="control-label" for="email">用户名：</label>
	      	<div class="controls">
	      	 	<input name="name" class="input-xlarge focused" id="name" type="text" value="<?php echo $user->name?>" disabled="disabled">
		  		<input name="uid" type="hidden" value="<?php echo $user->uid?>">
	          <span class="help-inline">用户进行登录的帐号</span></div>
		</div>
		<div class="control-group">
	      	<label class="control-label" for="email">电话：</label>
	      	<div class="controls">
	      	 	<input name="tel"  class="input-xlarge" id="tel" type="text" value="<?php echo $user->tel?>">
          		<span class="help-inline">2-10位个中英文、数字、下划线和中划线组成</span>
		</div></div>
		<div class="control-group">
	      	<label class="control-label" for="email">电子邮箱：</label>
	      	<div class="controls">
	      	 	<input name="email" class="input-xlarge" id="email" type="text" value="<?php echo $user->email?>">
          		<span class="help-inline">常用电子邮箱,用于找回密码</span>
          		</div>
		</div>
		 <div class="form-actions">
			<button type="submit" class="btn btn-primary">确定</button>
	  	</div>
	<?php
		echo form_close();
		endif;
	 ?>
	 <div class="clearfix"></div>
	 </div>
	 <div class="tab-pane" id="tab_password">
	<?php echo form_open('yd_home/admin_modsave') ?>
	<div class="form-horizontal" style="border:none">
      <?php if($uid == 'admin'):?>
      	<div class="control-group">
	      	<label class="control-label" for="email">超级管理员：</label>
	      	<div class="controls">
	      	<input name="email" class="input-xlarge focused" id="email" type="text" disabled="disabled" value="<?php echo $name?>">
	        <span class="help-inline">您是超级管理员，仅限于修改自己的密码</span>
		</div>
		</div>
	  <?php endif;?>
      	<div class="control-group">
	      	<label class="control-label" for="paw">密码：</label>
	      	<div class="controls">
	      		<input name="paw" id="paw" type="password" class="input-xlarge">
		  		<input name="uid" type="hidden" value="<?php echo $uid?>"><span class="help-inline">登录密码</span>
	      	</div>
		</div>
      	<div class="control-group">
	      	<label class="control-label" for="paw2">确认密码：</label>
	      	<div class="controls"><input name="paw2" id="paw2" type="password" class="input-xlarge"><span class="help-inline">请输入确定密码</span>
	      	</div>
		</div>
	  <div class="form-actions">
			<button type="submit" class="btn btn-primary">确定</button>
	  </div>
    </div>
	<?php echo form_close() ?>
	</div>
</div>
		<div class="clearfix"></div>
<?php include('home_footer.php'); ?>