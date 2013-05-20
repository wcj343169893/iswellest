<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<?php echo anchor('home','Home')?> <span class="divider">/</span>
		</li>
		<li>清空实验报告书数据</li>
	</ul>
</div>
<div class="form-horizontal">
	<div class="form2">	
      <dl class="lineD">
        <dt></dt>
        <dd style="font-size:16px; line-height:30px; color:#FF0000">该功能用于每次实验报告书评分完毕后，下一次录入实验报告书评分前使用~！<br />
		清空实验报告书数据的时候，对应的评分数据也将被清空~！<br />
		所有数据一旦清空便无法恢复，请谨慎使用~！</dd>
		<div id="msg" style="display:none"></div>
      </dl>
      <div class="page_btm">
        <input id="works" type="hidden" name="works" value="works" />
		<input id="zlsub" type="submit" class="btn btn-small btn-danger" value="清空数据" onClick="cleanData()" />
      </div>
    </div>
</div>
<script language=javascript>
function cleanData() {
	if(!confirm('清空后无法恢复,确定要清空吗?'))return;
	var works = $('#works').val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/clean'); ?>",
		data: {table:works},
		success: function(data){
			$("#msg").html(data); // 把返回的数据添加到页面上
		}
	});
}
</script>
<?php include('home_footer.php'); ?>