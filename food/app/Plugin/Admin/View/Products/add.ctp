<div id="box">
	<h3 id="adduser">Add Product</h3>
    <form id="form" action="<?php echo $webroot?>admin/products/save" method="post">
      <fieldset id="personal">
        <legend>Basic Information</legend>
        <label for="name">Name : </label> 
        <input name="name" id="name" type="text" tabindex="1"/>
        <br />
        <label for="price">Price : </label>
        <input name="price" id="price" type="text"  tabindex="3"/>
        <br />
        <label for="price">Category : </label>
        <select name="cateID">
        	<?php foreach($category as $k=>$v){?>
        	<option value="<?php echo $k?>"><?php echo $v?></option>
        	<?php }?>
        </select>
        <br />
        <label for="active">Active : </label>
        <input name="active" type="radio" value="1" tabindex="4" checked/>Active
        <input name="active" type="radio" value="0" tabindex="4" />DisActive
        <br />
        <label for="slug">Slug : </label>
        <input name="slug" id="slug" type="text"  tabindex="3"/>
        <br />
        <div class="photos">
	        <input name="photo" id="photo" type="hidden"  tabindex="5"/>
	        <img alt="" src="" id="icon_img" class="hidden" width="100px">
	        <div class="clear"></div>
	        <input id="icon_file" type="button" tabindex="5" value="Upload"/>
	        <div class="clear"></div>
        </div>
      </fieldset>
      <fieldset id="address">
        <legend>Introduction</legend>
        <br />
        <label for="excerpt">Excerpt : </label>
        <input name="excerpt" id="excerpt" type="text" tabindex="2"/>
        <br />
        <label for="description">Description : </label> 
        <textarea rows="10" cols="20" name="description" id="description"></textarea>
        <br />
      </fieldset>
      <div align="center">
      <input id="button1" type="submit" value="Submit" /> 
      <input id="button2" type="reset" />
      </div>
    </form>
</div>
<script type="text/javascript"><?php $timestamp = time();?>
var timestamp='<?php echo $timestamp;?>';
var token='<?php echo md5('unique_salt' . $timestamp);?>';
$(function() {
	//上传图标
	$('#icon_file').uploadify({
		'formData'     : {
			'timestamp' : timestamp,
			'token'     : token
		},
		'fileSizeLimit' : '5000KB',
		'swf'      : <?php echo $webroot?>'swf/uploadify.swf',
		'uploader' : <?php echo $webroot?>'admin/products/uploadify?type=icon', 
		'fileTypeExts'  : '*.png;*.jpg;*.gif',
		'onUploadSuccess' : function(file, data, response) {
			data= jQuery.parseJSON(data);
			if(response){
				if(data.error>0){
				alert(data.message);
				}else{
				$("#icon_img").attr("src",data.fileFullPath).show(500);
				$("input[name='photo']").val(data.filePath);
				}
			}else{alert(data.message);}
        }
	});
});
</script> 