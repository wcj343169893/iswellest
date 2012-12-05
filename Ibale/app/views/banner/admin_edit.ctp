<script type="text/javascript" src="/js/ajaxupload.js"></script>
<?php include_once WWW_ROOT.'/js/admin/pageSetting.js';?>
<div class="mainWrapper">
    <h2>商品一览页广告位管理</h2>
    <!-- 商品一览页广告位管理 -->
    <?php echo $appForm->create('Banner', array('id'=>'BannerForm', 'url'=>'/admin/banner/edit_comp'));?>
    <?php echo $appForm->hidden('Banner.type');?>
    <?php echo $appForm->hidden('mode', array('value'=>'update'));?>
    <div id="focusPicBlockBannerProduct" class="topContent clearfix">
        <h4>
            左侧广告栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addFocusPic('BannerProduct', 'focusPicBlockBannerProduct');">[添加]</a>
        </h4>
<?php $this->set('pageSettingType', 'BannerProduct');?>
<?php echo $appForm->hidden('BannerProduct.id');?>
<?php if (!isset($this->data['BannerProduct']['focus_pic']) && empty($this->data['Banner']['mode'])):?>
    <?php $this->data['BannerProduct']['focus_pic'] = array(array(),array());?>
<?php endif;?>
<?php if (!empty($this->data['BannerProduct']['focus_pic'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['BannerProduct']['focus_pic'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('banner/focus_pic');?>
    <?php endforeach;?>
<?php endif;?>
    </div>
    <label id="focusPicRequired" class="error-message"><?php echo $appSession->flash('BannerProductfocusPicRequired');?></label>
    <div class="btn clearfix">
        <input type="submit" name="button3" id="button3" value="提交" class="btnWidth"  onclick="javaScript:updateProductBanner();" />
    </div>
    <!-- 商品一览页广告位管理 end-->
    <p class="p_40_t clear"></p>
    <h2>品牌首页广告位管理</h2>
    <!-- 品牌首页广告位管理 -->
    <div id="focusPicBlockBannerBrand" class="topContent clearfix">
            <h4>
                左侧广告栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addFocusPic('BannerBrand', 'focusPicBlockBannerBrand');">[添加]</a>
            </h4>
<?php $this->set('pageSettingType', 'BannerBrand');?>
<?php echo $appForm->hidden('BannerBrand.id');?>
<?php if (!isset($this->data['BannerBrand']['focus_pic']) && empty($this->data['Banner']['mode'])):?>
    <?php $this->data['BannerBrand']['focus_pic'] = array(array(),array());?>
<?php endif;?>
<?php if (!empty($this->data['BannerBrand']['focus_pic'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['BannerBrand']['focus_pic'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('banner/focus_pic');?>
    <?php endforeach;?>
<?php endif;?>
    </div>
    <label id="focusPicRequired" class="error-message"><?php echo $appSession->flash('BannerBrandfocusPicRequired');?></label>
    <div class="btn clearfix">
        <input type="button" name="button3" id="button3" value="提交" class="btnWidth" onclick="javaScript:updateBrandBanner();" />
    </div>
    <?php echo $appForm->end();?>
    <!-- 品牌首页广告位管理 end-->
</div>
<div style="display:none">
<?php echo $appForm->create('Image', array('id'=>'uploadImg', 'type'=>'post', 'enctype'=>'multipart/form-data', 'url'=>'/image_upload/ajax_upload'));?>
<input type="hidden" name="savePath" id="savePath" />
<input type="hidden" name="widthNew" id="widthNew" />
<input type="hidden" name="heightNew" id="heightNew" />
<?php echo $appForm->end();?>
</div>
<script type="text/javascript">
function updateProductBanner() {
    $("#BannerType").val('Product');
    submitForm('BannerForm');
}
function updateBrandBanner() {
    $("#BannerType").val('Brand');
    submitForm('BannerForm');
}
<?php if ($appSession->check('Message.bannerUpdateSuccess')):?>
alert('<?php echo $appSession->flash('bannerUpdateSuccess', false);?>');
<?php endif;?>
</script>