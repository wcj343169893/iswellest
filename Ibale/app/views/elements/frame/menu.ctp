<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>爱芭乐</title>
<link type="text/css" rel="stylesheet" href="/css/admin/global.css" />
<link type="text/css" rel="stylesheet" href="/css/admin/menu.css" />
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
function dispMenu(childMenuId) {
    if ($("#"+childMenuId).css("display") == 'none') {
        $("#"+childMenuId).show();
    } else {
        $("#"+childMenuId).hide();
    }
}
</script>
</head>
<body>
<?php foreach($menuList as $key => $value):?>
<div id="menuList" onClick="javaScript:dispMenu('child_<?php echo $key;?>')" ><?php echo $value['name'];?></div>
<div id="child_<?php echo $key;?>" class="child">
<ul>
<?php foreach($value['list'] as $k => $v):?>
    <li><a href="<?php echo $v['url'];?>" target="main-frame"><?php echo $v['name'];?></a></li>
<?php endforeach;?>
</ul>
</div>
<?php endforeach;?>
</body>
</html>
