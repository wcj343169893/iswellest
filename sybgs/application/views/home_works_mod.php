<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li><?php echo anchor('home','Home')?> <span class="divider">/</span></li>
		<li><?php echo anchor('/home/workslist/'.$caid,'实验报告列表')?> <span class="divider">/</span></li>
		<li><?php echo $title?></li>
	</ul>
</div>
<div class="form-horizontal">
  <?php 
  $data = array('onSubmit' => 'return checkSubmit();');
  echo form_open('home/modWorksSave',$data) ?>
  	<div class="control-group">
      	<label class="control-label" for="caid">所属类别：</label>
      	<div class="controls">
           <?php 
		$caids=array('0'=>'==请选择==','1'=>'科技理念类','2'=>'科技实物类');
		$ids = 'id=caid';
		echo form_dropdown('caid',$caids,$caid,$ids) ?>
          <span class="help-inline">该实验报告书所属的分类</span>
        </div>
	</div>
	
	<div class="control-group">
      	<label class="control-label" for="wname">实验报告书名称：</label>
      	<div class="controls">
          <input name="wname" class="input-xlarge focused" id="wname" type="text" value="<?php echo $works->wname ;?>"  autofocus="autofocus">
          <span class="help-inline">实验报告书名称</span>
        </div>
	</div>
	
	<div class="control-group">
      	<label class="control-label" for="wauthor">作者：</label>
      	<div class="controls">
          <input name="wauthor" class="input-xlarge" id="name" type="text" value="<?php echo $works->wauthor ;?>">
          <span class="help-inline">实验报告书的作者姓名</span>
        </div>
	</div>
	<div class="control-group">
      	<label class="control-label" for="file_upload">上传文件：</label>
      	<div class="controls">
          <input name="file_upload" class="input-xlarge" id="file_work_upload" type="file" value="">
          <span class="help-inline">上传作品文件.支持的格式有:doc,docx,xls,xlsx,ppt,pptx等。</span>
        </div>
	</div>
	<div class="control-group" style="display: none;" id="result_group">
		<label class="control-label" for="file_upload">已上传：</label>
		<div class="controls">
          <div class='comment' id="resText">
          		<?php if(!empty($wfiles)){?>
          		<?php foreach($wfiles as $k=>$v){?>
          		<p class='para'>文件名:<?php echo $v?> <a href='javascript:void(0);' class='delete_upload_file btn btn-info'>删除</a>
          		<input name='wfile[]' type='hidden' value="<?php echo $v?>"/></p>
          		<?php }}?>
          </div>
        </div>
	</div>
	<div class="control-group">
      	<label class="control-label" for="wbz">实验报告书说明：</label>
      	<div class="controls">
          <textarea id="wbz" class="input-xlarge" name="wbz" style="width:400px;height:100px;"><?php echo $works->wbz ;?></textarea>
          <span class="help-inline">对该实验报告书的描述说明</span>
        </div>
	</div>
	<div class="form-actions">
		<input name="wid" value="<?php echo $works->wid;?>" type="hidden">
		<button type="submit" class="btn btn-primary">确定</button>
  	</div>
	<?php echo form_close() ?>
</div>
<script type="text/javascript">
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
<script type="text/javascript">
$(function() {
$('#file_work_upload').uploadify({
  'swf'      : '<?php echo base_url() ;?>theme/misc/uploadify.swf',
  'uploader' : '<?php echo base_url() ;?>theme/misc/uploadify.php',
  'multi'       : true,
  'fileTypeExts' : '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx',
  'onUploadSuccess'  : function(file, data, response) {
	  var txtHtml = "<p class='para'>文件名:"+file.name+" 文件大小:"+file.size+" <a href='javascript:void(0);' class='delete_upload_file btn btn-info'>删除</a><input name='wfile[]' type='hidden' value='"+data+"'/></p>";
	  $("#resText").append(txtHtml); 
	  $("#result_group").show(500);
	}
	});
	$(".delete_upload_file").live("click",function(){
			$(this).parent().remove();
			if($(".para").length==0){
				 $("#result_group").hide(500);
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
<?php include('home_footer.php'); ?>