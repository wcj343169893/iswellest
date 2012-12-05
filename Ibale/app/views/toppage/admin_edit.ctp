<link rel="stylesheet" type="text/css" href="/css/admin/autocomplete.css" />
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/ajaxOption.js"></script>
<script type="text/javascript" src="/js/ajaxupload.js"></script>
<script type="text/javascript" src="/js/autoComplete.js"></script>
<?php include_once WWW_ROOT.'/js/admin/product.js';?>
<?php include_once WWW_ROOT.'/js/admin/pageSetting.js';?>
<?php echo $appForm->create('Toppage', array('id'=>'Toppage', 'url'=>'/admin/toppage/edit_comp'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('mode', array('value'=>'update'));?>
<div class="mainWrapper">
    <h2>首页内容配置</h2>
        <div class="search">
            热门搜索关键字 <?php echo $appForm->text('keywords', array('class'=>'input_400'));?> <span>空格分离，不超过30个字</span>
            <?php echo $appForm->error("Toppage.keywords",'热门搜索关键字');?>
        </div>
    <div class="topContent clearfix" id="focusPicBlock">
        <!--焦点图-->
        <h4>
            焦点图 <a href="javaScript:void(0);" class="add" onClick="javaScript:addFocusPic('Toppage');">[添加]</a>
        </h4>
<?php if (!isset($this->data['Toppage']['focus_pic']) && empty($this->data['Toppage']['mode'])):?>
    <?php $this->data['Toppage']['focus_pic'] = array(array(),array());?>
<?php endif;?>
<?php if (!empty($this->data['Toppage']['focus_pic'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['Toppage']['focus_pic'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('toppage/focus_pic');?>
    <?php endforeach;?>
<?php endif;?>
        <label id="focusPicRequired" class="error-message"><?php echo $appSession->flash('focusPicRequired');?></label>
        <!--焦点图 end-->
    </div>
    <br class="clear" />
    <div class="topContent clearfix" id="underFocusAdBlock">
        <!--焦点图文下方广告位-->
        <h4>焦点图文下方4个广告位</h4>
    <?php for($i=0;$i<4;$i++):?>
        <?php $this->set('key', $i);?>
        <?php echo $this->element('toppage/under_focus_ad');?>
    <?php endfor;?>
    <?php if($appSession->check('Message.underFocusAdRequired')):?>
        <p id="underFocusAdRequired" style="float:left;width:300px;"><label class="error-message"><?php echo $appSession->flash('underFocusAdRequired');?></label></p>
    <?php endif;?>
        <!--焦点图文下方广告位 end-->
    </div>
    <br class="clear" />
    <!-- 分类商品栏 -->
    <div class="topContent clearfix" id="categoryProductBlock">
        <h4>
            分类商品栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addCategoryProduct('Toppage');">[添加]</a>
        </h4>
<?php if (!isset($this->data['Toppage']['category_product']) && empty($this->data['Toppage']['mode'])):?>
    <?php $this->data['Toppage']['category_product'][] = array();?>
<?php endif;?>
<?php if (!empty($this->data['Toppage']['category_product'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['Toppage']['category_product'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('toppage/category_product');?>
    <?php endforeach;?>
<?php endif;?>
        <label id="categoryProductRequired" class="error-message"><?php echo $appSession->flash('categoryProductRequired');?></label>
    </div>
    <!-- 分类商品栏 end-->
    <br class="clear" />
    <!-- 活动广告位 -->
    <div class="topContent clearfix" id="activeAdBlock">
        <h4>
            活动广告位 <a href="javaScript:void(0);" class="add" onClick="javaScript:addActiveAd('Toppage');">[添加]</a>
        </h4>
<?php if (!isset($this->data['Toppage']['active_ad']) && empty($this->data['Toppage']['mode'])):?>
    <?php $this->data['Toppage']['active_ad'][] = array();?>
<?php endif;?>
<?php if (!empty($this->data['Toppage']['active_ad'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['Toppage']['active_ad'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php $index++;?>
        <?php echo $this->element('toppage/active_ad');?>
    <?php endforeach;?>
<?php endif;?>
        <label id="activeAdRequired" class="error-message"><?php echo $appSession->flash('activeAdRequired');?></label>
    </div>
    <!-- 活动广告位 end-->
    <br class="clear" />
    <!-- 商品排行 -->
    <div class="topContent clearfix">
        <h4>商品排行</h4>
        <!--  热销商品 -->
        <div class="ad">
            <p class="title">热销商品</p>
        <?php for($i=1;$i<=10;$i++):?>
            <p>
                商品<?php echo $appNumber->alphToChinese($i);?>ID 
                <?php echo $appForm->text("Toppage.hot_sale_product.{$i}.product_cd", array('id'=>"hotSaleProductCd{$i}", 'class'=>'input_70 gray', 'onblur'=>"javaScript:getCategoryProductProductInfo('hotSaleProductCd{$i}','hotSaleProductCd','hotSaleProductName{$i}');"));?> 
                <?php echo $appForm->text("Toppage.hot_sale_product.{$i}.product_name", array('id'=>"hotSaleProductName{$i}",'class'=>'input_70 gray', 'disabled'=>'disabled'));?>
                <?php echo $appForm->error("Toppage.hot_sale_product.{$i}.product_cd", '商品ID')?>
                <?php echo $appSession->flash("HotSaleProductProductCdIsDuplicate_{$i}");?>
            </p>
        <?php endfor;?>
        </div>
        <!--  热销商品 end-->
        <!--  常用OTC -->
        <div class="ad">
            <p class="title">常用OTC</p>
        <?php for($i=1;$i<=10;$i++):?>
            <p>
                <span style="width:50px;">商品<?php echo $appNumber->alphToChinese($i);?>ID</span> 
                <?php echo $appForm->text("Toppage.otc_product.{$i}.product_cd", array('id'=>"otcProductCd{$i}", 'class'=>'input_70 gray', 'onblur'=>"javaScript:getCategoryProductProductInfo('otcProductCd{$i}','otcProductCd','otcProductName{$i}');"));?> 
                <?php echo $appForm->text("Toppage.otc_product.{$i}.product_name", array('id'=>"otcProductName{$i}",'class'=>'input_70 gray', 'disabled'=>'disabled'));?>
                <?php echo $appForm->error("Toppage.otc_product.{$i}.product_cd", '商品ID')?>
                <?php echo $appSession->flash("OtcProductProductCdIsDuplicate_{$i}");?>
            </p>
        <?php endfor;?>
        </div>
        <!--  常用OTC end-->
        <!--  热门咨询商品 -->
        <div class="ad">
            <p class="title">热门咨询商品</p>
        <?php for($i=1;$i<=10;$i++):?>
            <p>
                商品<?php echo $appNumber->alphToChinese($i);?>ID 
                <?php echo $appForm->text("Toppage.hot_enquiry_product.{$i}.product_cd", array('id'=>"hotEnquiryProductCd{$i}", 'class'=>'input_70 gray', 'onblur'=>"javaScript:getCategoryProductProductInfo('hotEnquiryProductCd{$i}','hotEnquiryProductCd','hotEnquiryProductName{$i}');"));?> 
                <?php echo $appForm->text("Toppage.hot_enquiry_product.{$i}.product_name", array('id'=>"hotEnquiryProductName{$i}",'class'=>'input_70 gray', 'disabled'=>'disabled'));?>
                <?php echo $appForm->error("Toppage.hot_enquiry_product.{$i}.product_cd", '商品ID')?>
                <?php echo $appSession->flash("HotEnquiryProductProductCdIsDuplicate_{$i}");?>
            </p>
        <?php endfor;?>
        </div>
        <!--  热门咨询商品 end-->
    </div>
    <!-- 商品排行 end-->
    <br class="clear" />
    <!-- 品牌区域 -->
    <div class="topContent clearfix">
        <h4>品牌区域</h4>
        <?php echo $appForm->textarea('brand_content', array('class'=>'ckeditor'));?>
        <?php echo $appForm->error('Toppage.brand_content', '品牌区域');?>
    </div>
    <!-- 品牌区域 end-->
    <br class="clear" />
    <div class="btn clearfix">
        <input type="submit" name="button3" id="button3" value="全部提交" class="btnWidth" />
    </div>
</div>
<?php echo $appForm->end();?>
<div class="display-none">
<?php echo $appForm->create('Image', array('id'=>'uploadImg', 'type'=>'post', 'enctype'=>'multipart/form-data', 'url'=>'/image_upload/ajax_upload'));?>
<input type="hidden" name="savePath" id="savePath" />
<input type="hidden" name="widthNew" id="widthNew" />
<input type="hidden" name="heightNew" id="heightNew" />
<?php echo $appForm->end();?>
</div>
<?php if ($appSession->check('Message.ToppageUpdateSuccess')):?>
<script type="text/javascript">alert('<?php echo $appSession->flash('ToppageUpdateSuccess', false);?>');</script>
<?php endif;?>