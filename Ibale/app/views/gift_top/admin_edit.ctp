<link rel="stylesheet" type="text/css" href="/css/admin/autocomplete.css" />
<script type="text/javascript" src="/js/ajaxOption.js"></script>
<script type="text/javascript" src="/js/ajaxupload.js"></script>
<script type="text/javascript" src="/js/autoComplete.js"></script>
<?php include_once WWW_ROOT.'/js/admin/product.js';?>
<?php include_once WWW_ROOT.'/js/admin/pageSetting.js';?>
<?php echo $appForm->create('GiftTop', array('id'=>'GiftTop', 'url'=>'/admin/gift_top/edit_comp'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('mode', array('value'=>'update'));?>
<div class="mainWrapper">
    <h2>送礼频道首页内容配置</h2>
    <div class="search">
        热门搜索关键字 <?php echo $appForm->text('keywords', array('class'=>'input_400'));?> <span>空格分离，不超过30个字</span>
        <?php echo $appForm->error("GiftTop.keywords",'热门搜索关键字');?>
    </div>
    <div class="topContent clearfix" id="focusPicBlock">
        <!--焦点图-->
        <h4>
            焦点图 <a href="javaScript:void(0);" class="add" onClick="javaScript:addFocusPic('GiftTop');">[添加]</a>
        </h4>
<?php if (!isset($this->data['GiftTop']['focus_pic']) && empty($this->data['GiftTop']['mode'])):?>
    <?php $this->data['GiftTop']['focus_pic'] = array(array(),array());?>
<?php endif;?>
<?php if (!empty($this->data['GiftTop']['focus_pic'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['GiftTop']['focus_pic'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('page_setting/focus_pic');?>
    <?php endforeach;?>
<?php endif;?>
        <label id="focusPicRequired" class="error-message"><?php echo $appSession->flash('focusPicRequired');?></label>
        <!--焦点图 end-->
    </div>
    <br class="clear" />
    <!-- 分类商品栏 -->
    <div class="topContent clearfix" id="categoryProductBlock">
        <h4>
            分类商品栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addCategoryProduct('GiftTop');">[添加]</a>
        </h4>
<?php if (!isset($this->data['GiftTop']['category_product']) && empty($this->data['GiftTop']['mode'])):?>
    <?php $this->data['GiftTop']['category_product'][] = array();?>
<?php endif;?>
<?php if (!empty($this->data['GiftTop']['category_product'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['GiftTop']['category_product'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('gift_top/category_product');?>
    <?php endforeach;?>
<?php endif;?>
        <label id="categoryProductRequired" class="error-message"><?php echo $appSession->flash('categoryProductRequired');?></label>
    </div>
    <!-- 分类商品栏 end-->
    <!-- 左侧广告栏 -->
    <div class="topContent clearfix" id="leftAdBlock">
        <h4>
            左侧广告栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addLeftAd('GiftTop');">[添加]</a>
        </h4>
    <?php if (!isset($this->data['GiftTop']['left_ad']) && empty($this->data['GiftTop']['mode'])):?>
        <?php $this->data['GiftTop']['left_ad'][] = array();?>
    <?php endif;?>
<?php if(!empty($this->data['GiftTop']['left_ad'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['GiftTop']['left_ad'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('category_top/left_ad');?>
    <?php endforeach;?>
<?php endif;?>
    <label id="leftAdRequired" class="error-message"><?php echo $appSession->flash('leftAdRequired');?></label>
    </div>
    <!-- 左侧广告栏 end-->
    <br class="clear" />
    <div class="btn clearfix">
        <input name="button3" type="submit" class="btnWidth" id="button3" value="全部提交" />
    </div>
</div>
<?php echo $appForm->end();?>
<div style="display:none">
<?php echo $appForm->create('Image', array('id'=>'uploadImg', 'type'=>'post', 'enctype'=>'multipart/form-data', 'url'=>'/image_upload/ajax_upload'));?>
<input type="hidden" name="savePath" id="savePath" />
<input type="hidden" name="widthNew" id="widthNew" />
<input type="hidden" name="heightNew" id="heightNew" />
<?php echo $appForm->end();?>
</div>
<?php if ($appSession->check('Message.giftTopUpdateSuccess')):?>
<script type="text/javascript">alert('<?php echo $appSession->flash('giftTopUpdateSuccess', false);?>');</script>
<?php endif;?>