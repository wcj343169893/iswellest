<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>北京林业大学</title>
<base href="<?php echo base_url() ;?>"/>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
<body>
<div align="center">
<div style="text-align:center; color:#333333; font-size:15px; padding:50px 0 220px;">
<table width="100%" border="0">
	<tr>
	  <td align="center" valign="middle">
	 <iframe width="150" scrolling="No" height="20" frameborder="0" vspace="0" hspace="0" marginheight="0" marginwidth="0" allowtransparency="true" src="http://m.weather.com.cn/m/pn6/weather.htm "></iframe>
	  </td>
	</tr>
	<tr>
	  <td align="center" valign="middle"><h4><?php $this->load->helper('date');$datestring = "%Y年%m月 %d日 %h:%i %a";$time = time();
echo mdate($datestring, $time);?>
</h4></td>
	</tr>
	<tr>
	  <td align="center" valign="middle"><h4>亲爱的用户 <span class="STYLE1"><?php echo $name ?></span>&nbsp;&nbsp;[IP:<?php echo $_SERVER['REMOTE_ADDR']
;?>]&nbsp;你好~!</h4></td>
	</tr>
	<tr>
	  <td align="center" valign="middle"></td>
	</tr>
</table>
</div>
<table width="680" border="0">
  <tr align="center">
    <td>
	<div style="text-align:center; color:#666666; font-size:12px;">
	内存消耗:<?php echo $this->benchmark->memory_usage();?><br />
	页面执行时间:<?php echo $this->benchmark->elapsed_time();?>秒<br /><br />
	<?php echo $_SERVER['HTTP_USER_AGENT']?>
	</div>
	</td>
  </tr>
</table>
</body>
</html>