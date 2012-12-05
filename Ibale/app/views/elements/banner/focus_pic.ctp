<div class="ad" id="focusPic<?php echo $key;?>">
    <p class="title">
        图<label id="focusPicNo"><?php echo $appNumber->alphToChinese($index);?></label>
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delFocusPic(this, 'focusPicBlock<?php echo $pageSettingType;?>');">[删除]</a>
    </p>
    <p>
        图片：
        <?php echo $appForm->hidden("{$pageSettingType}.focus_pic.{$key}.path", array('id'=>"focusPicPath{$pageSettingType}{$key}"));?>
        <?php echo $appForm->file("{$pageSettingType}.focus_pic.{$key}.file", array('name'=>'filename', 'size'=>'8', 'onchange'=>"ajaxUploadImg(this, '".UPLOAD_PIC_ROOT.DS.splitWordsWithUnderLine($pageSettingType)."/banner/{$key}/', '200', '80', 'pFocusPic{$pageSettingType}{$key}', 'focusPicPath{$pageSettingType}{$key}');"));?>
        <?php echo $appForm->error("Banner.{$pageSettingType}.focus_pic.{$key}.path", '图片');?>
    </p>
    <p class="f_11 gray">jpg,png,gif,尺寸200×80,大小400K内</p>
    <p class="img" id="pFocusPic<?php echo $pageSettingType.$key;?>">
    <?php $url = '/image/admin/img_13.gif';?>
    <?php if (!empty($this->data[$pageSettingType]['focus_pic'][$key]['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['focus_pic'][$key]['path'])):?>
    <?php $url = $this->data[$pageSettingType]['focus_pic'][$key]['path'];?>
    <?php endif;?>
        <img src="<?php echo $url;?>" width="200" height="80" />
    </p>
    <p>
        链接：
        <?php echo $appForm->text("{$pageSettingType}.focus_pic.{$key}.url", array('class'=>'input_175'));?>
        <?php echo $appForm->error("Banner.{$pageSettingType}.focus_pic.{$key}.url", '链接');?>
    </p>
    <p>
        说明：
        <?php echo $appForm->text("{$pageSettingType}.focus_pic.{$key}.comment", array('class'=>'input_175'));?>
        <?php echo $appForm->error("Banner.{$pageSettingType}.focus_pic.{$key}.comment", '说明');?>
    </p>
</div>
