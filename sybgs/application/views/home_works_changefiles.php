<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body>
<?php
ignore_user_abort();//即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(600);//执行时间为无限制，php默认的执行时间是30秒，通过set_time_limit(0)可以让程序无限制的执行下去
$flashpager = "D:\\program\\FlashPaper2.2\\FlashPrinter.exe";
$fpath = dirname(dirname(dirname(__FILE__))).'\\uploads';
$cmd = $flashpager." ".$fpath."\\".$name.".".$type." -o ".$fpath."\\".$name.".swf";
exec($cmd);
@unlink($fpath."\\".$name.".".$type);
echo $cmd;
?>
</body>
</html>
