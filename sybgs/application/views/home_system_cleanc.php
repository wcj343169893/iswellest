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
</head>
<body>
<div class="so_main">
    <div class="page_tit">清空实验报告书评分数据</div>
	<div class="form2">	
      <dl class="lineD">
        <dt></dt>
        <dd style="font-size:16px; line-height:30px; color:#FF0000">该功能用于每次实验报告书评分完毕后，下一次录入实验报告书评分前使用~！<br />
		清空实验报告书的评分数据时，对应的实验报告书数据被清空~！<br />
		所有数据一旦清空便无法恢复，请谨慎使用~！</dd>
		<div id="msg" style="display:none"></div>
      </dl>
      <div class="page_btm">
        <input id="score" type="hidden" name="score" value="score" />
		<input id="zlsub" type="submit" class="btn_b" value="清空数据" onClick="cleanData()" />
      </div>
    </div>
</div>
<script language=javascript>
function cleanData() {
	if(!confirm('清空后无法恢复,确定要清空吗?'))return;
	var scores = $('#score').val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/clean'); ?>",
		data: {table:scores},
		success: function(data){
			$("#msg").html(data); // 把返回的数据添加到页面上
		}
	});
}
</script>
</body>
</html>