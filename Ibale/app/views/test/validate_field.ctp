<link type="text/css" rel="stylesheet" href="/css/admin/global.css">
		<link type="text/css" href="/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script>
<script ></script>
<?php echo $appForm->error('Test.id');?>
<?php echo $appForm->error('Test.name', 'xxx');?>
<?php echo $appForm->create('Test');?>
<?php echo $appForm->text('id');?>
<?php echo $appForm->text('name', array());?>
<?php echo $appForm->end();?>

	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script>


<p>Date: <input type="text" id="datepicker"></p>

