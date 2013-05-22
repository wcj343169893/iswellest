<?php
$no_visible_elements=true;
include('home_header.php'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>
					<img src="resource/home/images/top_logo.png" alt=""  title=""/>
					</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<?php if($msg){echo $msg;}else{?>
					<div class="alert alert-info">
						请输入用户名和密码
					</div>
					<?php }?>
					<?php echo form_open('login/checkUser','class="form-horizontal" method="post"') ?>
						<fieldset>
							<div class="input-prepend" title="用户名" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="name" id="name" type="text" value="admin" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="密码" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="paw" id="paw" type="password" value="admin" />
							</div>
							<div class="clearfix"></div>
							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" name="remember"/>记住密码</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">登录</button>
							</p>
						</fieldset>
					<?php echo form_close() ?>
				</div><!--/span-->
			</div><!--/row-->
<?php include('home_footer.php'); ?>

