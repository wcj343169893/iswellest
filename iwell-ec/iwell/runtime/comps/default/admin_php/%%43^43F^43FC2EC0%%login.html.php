<?php /* Smarty version 2.6.18, created on 2012-04-08 19:02:38
         compiled from user/login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理工作平台</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['res']; ?>
/css/style.css"/>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/js.js"></script>
</head>
<body onkeydown="show()" onload="login.username.focus()">
<div id="top"> </div>
<form id="login" name="login" action="<?php echo $this->_tpl_vars['url']; ?>
/isLogin" method="post">
  <div id="center">
    <div id="center_left"></div>
    <div id="center_middle">
      <div class="user" style='margin-top:15px'>
        <label>用户名：
        <input type="text" name="username" id="user" value="admin"/>
        </label>
      </div>
      <div class="user" style="margin-top:15px">
        <label>密　码：
        <input type="password" name="password" id="pwd" value="admin"/>
        </label>
      </div>

    </div>
    <div id="center_middle_right"></div>
    <div id="center_submit">
      <div class="button"> <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/dl.gif" width="57" height="20" onclick="form_submit()" > </div>
      <div class="button"> <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/cz.gif" width="57" height="20" onclick="form_reset()"> </div>
    </div>
    <div id="center_right"></div>
  </div>
</form>
<div id="footer"></div>
</body>
</html>