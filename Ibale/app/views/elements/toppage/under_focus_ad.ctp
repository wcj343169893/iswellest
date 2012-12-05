<?php 
if (!isset($key)) {
    $key = $this->key;
}
if (!isset($pageSettingType)) {
    $pageSettingType = $this->pageSettingType;
}
?>
<div class="ad" id="underFocusAd<?php echo $key;?>">
    <p class="title">
        图<label id="focusPicNo"><?php echo $appNumber->alphToChinese($key+1);?></label>
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delUnderFocusAd(<?php echo $key;?>);">[删除]</a>
    </p>
    <p>
        图片：
        <?php echo $appForm->hidden("{$pageSettingType}.under_focus_ad.{$key}.path", array('id'=>"underFocusAdPath{$key}"));?>
        <?php echo $appForm->file("{$pageSettingType}.under_focus_ad.{$key}.file", array('name'=>'filename', 'id'=>"underFocusAdFile{$key}", 'size'=>'8', 'onchange'=>"ajaxUploadImg(this, '".UPLOAD_PIC_ROOT.DS.splitWordsWithUnderLine($pageSettingType)."/under_focus/', '220', '90', 'pUnderFocusAd{$key}', 'underFocusAdPath{$key}');"));?>
        <?php echo $appForm->error("{$pageSettingType}.under_focus_ad.{$key}.path", '图片');?>
    </p>
    <p class="f_11 gray">jpg,png,gif,尺寸220×90,大小400K内</p>
    <p class="img" id="pUnderFocusAd<?php echo $key;?>">
    <?php $url = '/image/admin/img_6.gif';?>
    <?php if (!empty($this->data[$pageSettingType]['under_focus_ad'][$key]['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['under_focus_ad'][$key]['path'])):?>
    <?php $url = $this->data[$pageSettingType]['under_focus_ad'][$key]['path'];?>
    <?php endif;?>
        <img src="<?php echo $url;?>" width="180" height="26" />
    </p>
    <p>
        链接：
        <?php echo $appForm->text("{$pageSettingType}.under_focus_ad.{$key}.url", array('id'=>"underFocusAdUrl{$key}", 'class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.under_focus_ad.{$key}.url", '链接');?>
    </p>
    <p>
        说明：
        <?php echo $appForm->text("{$pageSettingType}.under_focus_ad.{$key}.comment", array('id'=>"underFocusAdComment{$key}", 'class'=>'input_175'));?>
        <?php echo $appForm->error("{$pageSettingType}.under_focus_ad.{$key}.comment", '说明');?>
    </p>
</div>
