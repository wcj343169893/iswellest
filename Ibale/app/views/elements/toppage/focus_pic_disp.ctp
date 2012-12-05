<?php if (!empty($this->data[$this->name]['focus_pic'])):?>
    <div class="focusImg" style="height:300px;overflow:hidden;">
    <?php $index = 0;?>
    <?php foreach($this->data[$this->name]['focus_pic'] as $key => $value):?>
        <?php if ($index == 0):?>
            <?php $display = 'display;'?>
        <?php else:?>
            <?php $display = 'none'?>
        <?php endif;?>
        <a href="<?php echo $value['url']?>" target="_blank" title="<?php echo $value['comment'];?>"><img id="focusPic<?php echo $key;?>" src="<?php echo $value['path'];?>" alt="<?php echo $value['comment'];?>" style="display:<?php echo $display;?>;"/></a>
    <?php $index++;?>
    <?php endforeach;?>
    </div>
    <div class="focusBtn">
<?php $index = 0;?>
<?php foreach($this->data[$this->name]['focus_pic'] as $key => $value):?>
    <?php if ($index == 0):?>
        <span id="focusBtn<?php echo $key;?>" class="floatL focus_btn_img focus_btn_img_hover" onmouseover="javaScript:showFocusPic(<?php echo $key;?>);" onclick="javaScript:showFocusPic(<?php echo $key;?>);"></span>
    <?php else:?>
        <span id="focusBtn<?php echo $key;?>" class="floatL focus_btn_img" onmouseover="javaScript:showFocusPic(<?php echo $key;?>);"  onclick="javaScript:showFocusPic(<?php echo $key;?>);"></span>
    <?php endif;?>
    <?php $index++;?>
<?php endforeach;?>
    </div>
<?php endif;?>
<script type="text/javascript">
var focusPics  = [
<?php if (!empty($this->data[$this->name]['focus_pic'])):?>
<?php $index = 0;?>
<?php foreach($this->data[$this->name]['focus_pic'] as $key => $value):?>
"<?php echo $key;?>"
<?php if ($index < count($this->data[$this->name]['focus_pic'])-1):?>,<?php endif;?>
<?php $index++;?>
<?php endforeach;?>
<?php endif;?>
];
if (focusPics.length > 1) {
    setInterval("autoDispFocusImg()",5000);
}
</script>