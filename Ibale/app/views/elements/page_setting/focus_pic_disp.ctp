<?php if (!empty($this->data[$this->name]['focus_pic'])):?>
    <div class="focusImg" style="height:200px;overflow:hidden;">
    <?php $index = 0;?>
    <?php foreach($this->data[$this->name]['focus_pic'] as $key => $value):?>
        <?php if ($index == 0):?>
            <?php $display = 'display;'?>
        <?php else:?>
            <?php $display = 'none'?>
        <?php endif;?>
        <a href="<?php echo $value['url']?>" title="<?php echo $value['comment'];?>" target="_blank"><img id="focusPic<?php echo $key;?>" src="<?php echo $value['path'];?>" style="display:<?php echo $display;?>;" alt="<?php echo $value['comment'];?>"/></a>
    <?php $index++;?>
    <?php endforeach;?>
    </div>
    <div class="focusBtn">
<?php $index = 0;?>
<?php foreach($this->data[$this->name]['focus_pic'] as $key => $value):?>
    <?php if ($index == 0):?>
        <img id="focusBtn<?php echo $key;?>" height="6" width="40" src="/image/front/focusBtn_2.jpg" style="cursor:pointer;" onmouseover="javaScript:showFocusPic(<?php echo $key;?>);" onclick="javaScript:showFocusPic(<?php echo $key;?>);">
    <?php else:?>
        <img id="focusBtn<?php echo $key;?>" height="6" width="40" src="/image/front/focusBtn_1.jpg" style="cursor:pointer;" onmouseover="javaScript:showFocusPic(<?php echo $key;?>);"  onclick="javaScript:showFocusPic(<?php echo $key;?>);">
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