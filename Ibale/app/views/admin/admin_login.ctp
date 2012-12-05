<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>芭乐网</title>
<link type="text/css" rel="stylesheet" href="/css/admin/global.css" />
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){$("#AdminLoginId").focus();});
</script>
</head>
<body class="loginBody">
    <div class="login">
        <div class="loginInput">
            <div class="loginForm">
                <h3>欢迎登录芭乐网站后台管理系统</h3>
                <?php echo $appForm->create('Admin', array('maxLength'=>'20', 'url'=>'/admin/login'));?>
                <p>
                    <label>用户名:</label>
                    <?php echo $appForm->text('login_id', array('maxLength'=>'16', 'class'=>'input'));?>
                </p>
                <p>
                    <label>密&nbsp;&nbsp;&nbsp;&nbsp;码:</label>
                    <?php echo $appForm->password('password', array('class'=>'input'));?>
                </p>
                    <?php echo $appForm->error('Admin.password', '密码');?>
                    <?php echo $appForm->error('Admin.login_id', '用户名');?>
                    <?php if ( $appSession->check('Message.auth')):?>
                        <?php echo $appSession->flash('auth');?>
                    <?php endif;?>
                <input type="submit" name="button" id="button" value="Login" class="btnWidth" />
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="/">返回首页</a>
                <?php echo $appForm->end();?>
            </div>
        </div>
    </div>
</body>
</html>
