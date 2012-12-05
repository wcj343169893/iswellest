<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/admin/common.js"></script>
<script type="text/javascript" src="/js/ajaxupload.js"></script>

<div id="pic" style="border:solid 1px;width:120px;height:180px;"></div>
<form action="scripts/ajaxUploadImg.php" method="post" name="standard_use" id="standard_use" >
<?php echo $appForm->hidden('imgPath', array('id'=>'imgPath'));?>
<?php echo $appForm->file('image1', array('name'=>'filename', 'onchange'=>"javaScript:ajaxUploadImg(this, 'img/products/', '220', '280', 'pic', 'imgPath');"));?>
<?php echo $appForm->end();?>

<?php echo $appForm->create('Image', array('id'=>'uploadImg', 'type'=>'post', 'enctype'=>'multipart/form-data', 'action'=>'ajax_upload_img/'));?>
<input type="hidden" name="savePath" id="savePath" />
<input type="hidden" name="widthNew" id="widthNew" />
<input type="hidden" name="heightNew" id="heightNew" />
<?php echo $appForm->end();?>

