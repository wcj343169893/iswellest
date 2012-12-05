<div class="ad" id="focusPic<?php echo $key;?>">
    <p class="title">
        图<label id="focusPicNo"><?php echo $appNumber->alphToChinese($index);?></label>
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delFocusPic(this);">[删除]</a>
    </p>
    <p>
        图片：
        <?php echo $appForm->hidden("{$pageSettingType}.focus_pic.{$key}.path", array('id'=>'focusPicPath'.$key));?>
        <?php echo $appForm->file("{$pageSettingType}.focus_pic.{$key}.file", array('name'=>'filename', 'size'=>'8', 'onchange'=>"javaScript:ajaxUploadImg(this, '".UPLOAD_PIC_ROOT.DS.splitWordsWithUnderLine($pageSettingType)."/focus/', '1000', '244', 'pFocusPic{$key}', 'focusPicPath{$key}');"));?>
        <?php echo $appForm->error("{$pageSettingType}.focus_pic.{$key}.path", '图片');?>
    </p>
    <p class="f_11 gray">jpg,png,gif,尺寸1000×244,大小400K内</p>
    <p class="img" id="pFocusPic<?php echo $key;?>">
    <?php $url = '/image/admin/img_6.gif';?>
    <?php if (!empty($this->data[$pageSettingType]['focus_pic'][$key]['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['focus_pic'][$key]['path'])):?>
    <?php $url = $this->data[$pageSettingType]['focus_pic'][$key]['path'];?>
    <?php endif;?>
        <img src="<?php echo $url;?>" width="180" height="26" />
    </p>
    <p>
        链接：
        <?php echo $appForm->text("{$pageSettingType}.focus_pic.{$key}.url", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.focus_pic.{$key}.url", '链接');?>
    </p>
    <p>
        说明：
        <?php echo $appForm->text("{$pageSettingType}.focus_pic.{$key}.comment", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.focus_pic.{$key}.comment", '说明');?>
    </p>
</div>
