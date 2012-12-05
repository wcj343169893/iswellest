<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php

//把这些代码保存为一个php文件

$mysqli = new mysqli('192.168.10.205:5434','postgres','postgres','kenko_local');

$sql = 'SHOW CREATE TABLE `你的数据表名`';
$result = $mysqli->query($sql);
$row = $result->fetch_array();
echo $row['Create Table'];

?>
</body>
</html>
