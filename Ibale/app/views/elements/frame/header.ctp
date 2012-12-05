<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>爱芭乐</title>
<link type="text/css" rel="stylesheet" href="/css/admin/global.css" />
<link type="text/css" rel="stylesheet" href="/css/admin/menu.css" />
</head>

<body class="headerBody">
<div class="headWrapper">
	<div class="logo"><a href="<?php HTTPS_HOME_PAGE_URL;?>/admin/operator_log/index/id:<?php echo $appSession->read('Auth.Admin.id');?>" target="main-frame"><img src="/image/admin/logo.jpg" width="135" height="55" title="爱芭乐" /></a></div>
	<div class="person">您好，<a href="javaScript:void(0);"><?php echo $appHtml->html($appSession->read('Auth.Admin.login_id'));?></a> 欢迎使用本系统! <a href="/admin/logout" target="_parent"><b>[ 退出 ]</b></a> </div>
</div>
</body>
</html>
