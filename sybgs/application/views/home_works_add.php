<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?php echo base_url() ;?>"/>
<title>实验报告书提交网站</title>
<link href="resource/home/style2.css" rel="stylesheet" type="text/css">
<link href="resource/home/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resource/home/js/jwc.js"></script>
<script type="text/javascript" src="<?php echo base_url() ;?>resource/swfupload/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ;?>resource/swfupload/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ;?>resource/swfupload/swfobject.js"></script>
<script type="text/javascript" src="<?php echo base_url() ;?>resource/swfupload/jquery.uploadify.min.js"></script>
<script type="text/javascript">
$(function() {
$('#file_upload').uploadify({
  'uploader'    : '<?php echo base_url() ;?>resource/swfupload/uploadify.swf',
  'script'      : '<?php echo base_url() ;?>resource/swfupload/upload.php',
  'cancelImg'   : '<?php echo base_url() ;?>resource/swfupload/cancel.png',
  'multi'       : true,
  'fileTypeExts' : '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx',
  'onComplete'  : function(event, ID, fileObj, response, data) {
				  //alert('文件 ' + fileObj.name + ' 已上传');
				  var txtHtml = "<h6>"+response+"</h6><p class='para'>文件名:"+fileObj.name+"_文件大小:"+fileObj.size+"字节_上传速度:"+data.speed+"KB/s</p>";
				  $("#resText").append(txtHtml); // 把返回的数据添加到页面
				  var arr=response.split(".");
				  var fname =  arr[0];
				  var ftype = arr[1];
				  
				  if (is_office(ftype)){
				  	//response = fname + ".swf";
					//changefile(fname,ftype);
				  }
				  var strs = document.getElementById('wfile').value;
				  if (strs==""){
				  	  document.getElementById('wfile').value = response;
				  }else{
					  document.getElementById('wfile').value =strs+"||"+response;	
				  }		
				  //alert(document.getElementById('wfile').value);
				}
				});
});
function is_office(ftype){
	var office = ['doc','docx','xls','xlsx','ppt','pptx'];
	for (var i=0;i<office.length;i++){
		if (ftype == office[i]){
			return true;break;}
	}
	return false;
}
function changefile(fname,ftype) {
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/changeFiles'); ?>",
		data: {name:fname,type:ftype}
	});
}
</script>
</head>
<body>
<div class="so_main">
  <?php 
  $data = array('onSubmit' => 'return checkSubmit();');
  echo form_open('home/addWorksSave',$data) ?>
    <div class="page_tit"><?php echo $title;?></div>
	<div class="form2">	
      <dl class="lineD">
        <dt>所属类别：</dt>
        <dd>
          <?php 
		$caids=array('0'=>'==请选择==','1'=>'科技理念类','2'=>'科技实物类');
		$ids = 'id=caid';
		echo form_dropdown('caid',$caids,$caid,$ids) ?>
          <p>该实验报告书所属的分类</p>
		</dd>
      </dl>
      <dl class="lineD">
        <dt>实验报告书名称：</dt>
        <dd>
          <input name="wname" id="wname" type="text" value="">
          <p>实验报告书名称</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>作者：</dt>
        <dd>
          <input name="wauthor" id="wauthor" type="text" value="">
          <p>实验报告书的作者姓名</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>上传文件：</dt>
        <dd>
			<div id="demo">
			<input type="file" id="file_upload" name="file_upload" />
			<br />
			<a href="javascript:$('#file_upload').uploadifyUpload();">Upload</a>
			</div>
			<div  class='comment' id="resText">已上传：</div>
			<div><p>上传作品文件.支持的格式有:doc,docx,xls,xlsx,ppt,pptx等。［上传步骤：点击SELECT FILES,选择好要上传的文件，然后点击Upload］</p></div>
		</dd>
      </dl>
	  <dl class="lineD">
        <dt>实验报告书说明：</dt>
        <dd>
          <textarea id="wbz" name="wbz" style="width:400px;height:100px;"></textarea>
		  <p>对该实验报告书的描述说明</p>
      </dd>
      </dl>
      <div class="page_btm">
        <input name="wfile" type="hidden" value="" id="wfile"/>
		<input id="zlsub" type="submit" class="btn_b" value="添加" />
      </div>
    </div>
	<?php echo form_close() ?>
</div>
<script language=javascript>
function checkSubmit(){
	var caid = document.getElementById("caid").value;
	if(caid == 0){
		alert("请选择所属类别！");
		document.getElementById("caid").focus();
		return false;
	}
	var wname = document.getElementById("wname").value;
	if(wname == ""){
		alert("请输入实验报告书名称！");
		document.getElementById("wname").focus();
		return false;
	}
	var wauthor = document.getElementById("wauthor").value;
	if(wauthor == ""){
		alert("请输入作者信息！");
		document.getElementById("wauthor").focus();
		return false;
	}
	var wfile = document.getElementById("wfile").value;
	if(wfile == ""){
		alert("请上传实验报告书！");
		return false;
	}
	return true;
}
</script>
</body>
</html>
