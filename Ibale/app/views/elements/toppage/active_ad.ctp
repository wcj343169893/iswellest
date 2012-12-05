<div class="ad" id="activeAd<?php echo $key;?>">
    <p class="title">
        图<label id="activeAdNo"><?php echo $appNumber->alphToChinese($index);?></label>
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delActiveAd(this);">[删除]</a>
    </p>
    <p>
        图片：
        <?php echo $appForm->hidden("{$pageSettingType}.active_ad.{$key}.path", array('id'=>'activeAdPath'.$key));?>
        <?php echo $appForm->file("{$pageSettingType}.active_ad.{$key}.file", array('name'=>'filename', 'size'=>'8', 'onchange'=>"ajaxUploadImg(this, '".UPLOAD_PIC_ROOT."/ad/', '210', '130', 'pActiveAd{$key}', 'activeAdPath{$key}');"));?>
        <?php echo $appForm->error("{$pageSettingType}.active_ad.{$key}.path", '图片');?>
    </p>
    <p class="f_11 gray">jpg,png,gif,尺寸210×130,大小400K内</p>
    <p class="img" id="pActiveAd<?php echo $key;?>">
    <?php $url = '/image/admin/img_6.gif';?>
    <?php if (!empty($this->data[$pageSettingType]['active_ad'][$key]['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['active_ad'][$key]['path'])):?>
    <?php $url = $this->data[$pageSettingType]['active_ad'][$key]['path'];?>
    <?php endif;?>
        <img src="<?php echo $url;?>" width="180" height="26" />
    </p>
    <p>
        链接：
        <?php echo $appForm->text("{$pageSettingType}.active_ad.{$key}.url", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.active_ad.{$key}.url", '链接');?>
    </p>
    <p>
        说明：
        <?php echo $appForm->text("{$pageSettingType}.active_ad.{$key}.comment", array('class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.active_ad.{$key}.comment", '说明');?>
    </p>
</div>
