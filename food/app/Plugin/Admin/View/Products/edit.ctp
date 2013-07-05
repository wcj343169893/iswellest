<div id="box">
	<h3 id="adduser">Edit Product</h3>
    <form id="form" action="/admin/products/save" method="post">
    <input type="hidden" name="id" value="<?php echo $data["id"]?>">
      <fieldset id="personal">
        <legend>Basic Information</legend>
        <label for="name">Name : </label> 
        <input name="name" id="name" type="text" tabindex="1" value="<?php echo $data["name"]?>"/>
        <br />
        <label for="price">Price : </label>
        <input name="price" id="price" type="text"  tabindex="3" value="<?php echo $data["price"]?>"/>
        <br />
        <label for="price">Category : </label>
        <select name="cateID">
        	<?php foreach($category as $k=>$v){?>
        	<option value="<?php echo $k?>" <?php echo $data["cateID"]==$k?"selected":""?>><?php echo $v?></option>
        	<?php }?>
        </select>
        <br />
        <label for="active">Active : </label>
        <input name="active" type="radio" value="1" tabindex="4" <?php echo $data["active"]?"checked":"" ?>/>Active
        <input name="active" type="radio" value="0" tabindex="4" <?php echo $data["active"]?"checked":"" ?>/>DisActive
        <br />
        <label for="photo">photo : </label> 
        <input name="photo" id="photo" type="hidden"  tabindex="5" value="<?php echo $data["photo"]?>"/>
        <img alt="" src="/<?php echo $data["photo"]?>" id="icon_img" class="<?php echo empty($data["photo"])?"hidden":""?>" width="200px">
        <div class="clear"></div>
        <input id="icon_file" type="button" tabindex="5" value="Upload"/>
        <div class="clear"></div>
        <br />
      </fieldset>
      <fieldset id="address">
        <legend>Other Information</legend>
        <label for="excerpt">Excerpt : </label>
        <input name="excerpt" id="excerpt" type="text" tabindex="2" value="<?php echo $data["excerpt"]?>"/>
        <br />
        <label for="description">Description : </label> 
        <textarea rows="10" cols="20" name="description" id="description"><?php echo $data["description"]?></textarea>
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
		'swf'      : '/swf/uploadify.swf',
		'uploader' : '/admin/products/uploadify?type=icon', 
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