<?php $id = $this->data[$this->name]['id'];?>
<div class="ad" id="leftAd<?php echo $key;?>">
    <p class="title">
        图<label id="leftAdNo"><?php echo $appNumber->alphToChinese($index);?></label>
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delLeftAd(this);">[删除]</a>
    </p>
    <p>
        图片：
        <?php echo $appForm->hidden("{$pageSettingType}.left_ad.{$key}.path", array('id'=>'leftAdPath'.$key));?>
        <?php echo $appForm->file("{$pageSettingType}.left_ad.{$key}.file", array('name'=>'filename', 'size'=>'8', 'onchange'=>"javaScript:ajaxUploadImg(this, '".UPLOAD_PIC_ROOT.DS.splitWordsWithUnderLine($pageSettingType)."/{$id}/left_ad/', '210', '165', 'pLeftAd{$key}', 'leftAdPath{$key}');"));?>
        <?php echo $appForm->error("{$pageSettingType}.left_ad.{$key}.path", '图片');?>
    </p>
    <p class="f_11 gray">jpg,png,gif,尺寸210×165,大小400K内</p>
    <p class="img" id="pLeftAd<?php echo $key;?>">
    <?php $url = '/image/admin/img_6.gif';?>
    <?php if (!empty($this->data[$pageSettingType]['left_ad'][$key]['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['left_ad'][$key]['path'])):?>
    <?php $url = $this->data[$pageSettingType]['left_ad'][$key]['path'];?>
    <?php endif;?>
        <img src="<?php echo $url;?>" width="180" height="26" />
    </p>
    <p>
        链接：
        <?php echo $appForm->text("{$pageSettingType}.left_ad.{$key}.url", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.left_ad.{$key}.url", '链接');?>
    </p>
    <p>
        说明：
        <?php echo $appForm->text("{$pageSettingType}.left_ad.{$key}.comment", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.left_ad.{$key}.comment", '说明');?>
    </p>
</div>
