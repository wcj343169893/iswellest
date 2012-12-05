<?php echo $this->element('/common/brand_list');?>
<link rel="stylesheet" type="text/css" href="/css/admin/autocomplete.css" />
<script type="text/javascript" src="/js/ajaxOption.js"></script>
<script type="text/javascript" src="/js/ajaxupload.js"></script>
<script type="text/javascript" src="/js/autoComplete.js"></script>
<?php include_once WWW_ROOT.'/js/admin/product.js';?>
<?php include_once WWW_ROOT.'/js/admin/pageSetting.js';?>
<?php echo $appForm->create('CategoryTop', array('id'=>'CategoryTop', 'url'=>'/admin/category_top/edit_comp'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('mode', array('value'=>'update'));?>
<div class="mainWrapper">
    <h2>频道首页内容配置</h2>
    <div class="search">
        频道名称 <?php echo $appForm->text('name', array('class'=>'input'));?> &nbsp;&nbsp;
        关联分类 
        <?php echo $appForm->select('category1_id', $category1List, null, array('id'=>'CategoryTopCategory1','empty'=>__('label.pleaseSelect',true)));?>
        <?php echo $appForm->select('category2_id', $category2List, null, array('id'=>'CategoryTopCategory2','empty'=>__('label.pleaseSelect',true)));?>
        <?php echo $appForm->error("CategoryTop.name",'频道名称');?>
        <?php echo $appSession->flash('nameIsExists');?>
        <?php echo $appForm->error("CategoryTop.category1_id",'关联分类1');?>
        <?php echo $appForm->error("CategoryTop.category2_id",'关联分类2');?>
    </div>
    <div class="search">
        热门搜索关键字 <?php echo $appForm->text('keywords', array('class'=>'input_400'));?> <span>空格分离，不超过30个字</span>
        <?php echo $appForm->error("CategoryTop.keywords",'热门搜索关键字');?>
    </div>
    <div class="topContent clearfix" id="focusPicBlock">
        <!--焦点图-->
        <h4>
            焦点图 <a href="javaScript:void(0);" class="add" onClick="javaScript:addFocusPic('CategoryTop');">[添加]</a>
        </h4>
<?php if (!isset($this->data['CategoryTop']['focus_pic']) && empty($this->data['CategoryTop']['mode'])):?>
    <?php $this->data['CategoryTop']['focus_pic'] = array(array(),array());?>
<?php endif;?>
<?php if (!empty($this->data['CategoryTop']['focus_pic'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['CategoryTop']['focus_pic'] as $key => $value):?>
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
    <!-- 最新及最热商品 -->
    <div class="topContent clearfix">
        <h4>最新及最热商品</h4>
        <!--  热销商品 -->
        <div class="ad">
            <p class="title">最新商品</p>
        <?php for($i=1;$i<=5;$i++):?>
            <p>
                商品<?php echo $appNumber->alphToChinese($i);?>ID 
                <?php echo $appForm->text("CategoryTop.new_product.{$i}.product_cd", array('id'=>"newProductCd{$i}", 'class'=>'input_70 gray', 'onblur'=>"javaScript:getCategoryProductProductInfo('newProductCd{$i}','newProductCd','newProductName{$i}','','CategoryTopCategory1','CategoryTopCategory2', '', false, false);"));?> 
                <?php echo $appForm->text("CategoryTop.new_product.{$i}.product_name", array('id'=>"newProductName{$i}",'class'=>'input_70 gray', 'disabled'=>'disabled'));?>
                <?php echo $appForm->error("CategoryTop.new_product.{$i}.product_cd", '商品ID')?>
                <?php echo $appSession->flash("NewProductProductCdIsDuplicate_{$i}");?>
            </p>
        <?php endfor;?>
        </div>
        <!--  热销商品 end-->
        <!--  常用OTC -->
        <div class="ad">
            <p class="title">最热商品</p>
        <?php for($i=1;$i<=5;$i++):?>
            <p>
                商品<?php echo $appNumber->alphToChinese($i);?>ID 
                <?php echo $appForm->text("CategoryTop.hot_product.{$i}.product_cd", array('id'=>"hotProductCd{$i}", 'class'=>'input_70 gray', 'onblur'=>"javaScript:getCategoryProductProductInfo('hotProductCd{$i}','hotProductCd','hotProductName{$i}','','CategoryTopCategory1','CategoryTopCategory2', '', false, false);"));?> 
                <?php echo $appForm->text("CategoryTop.hot_product.{$i}.product_name", array('id'=>"hotProductName{$i}",'class'=>'input_70 gray', 'disabled'=>'disabled'));?>
                <?php echo $appForm->error("CategoryTop.hot_product.{$i}.product_cd", '商品ID')?>
                <?php echo $appSession->flash("HotProductProductCdIsDuplicate_{$i}");?>
            </p>
        <?php endfor;?>
        </div>
        <!--  常用OTC end-->
    </div>
    <!-- 最新及最热商品 end-->
    <br class="clear" />
    <!-- 品牌滚动栏 -->
    <div class="topContent clearfix">
        <h4>品牌滚动栏</h4>
        <div class="search">
            <?php echo $appForm->hidden('Search.brand_id', array('id'=>'brandIdSearch'));?>
            <?php echo $appForm->text('Search.brand_name', array('id'=>'brandNameSearch', 'class'=>'input_80', 'autocomplete'=>'off', 'onKeyup'=>"suggest.display('brandNameSearch','brand',1,event,'brandIdSearch');", 'onClick'=>"suggest.display('brandNameSearch', 'brand',1,event,'brandIdSearch');"));?>
            <input name="button2" type="button" class="btnWidth" id="btnAddBrand" value="添加" onclick="javaScript:addBrand();"/>
        </div>
        <ul class="scrollList" id="brandBlock">
    <?php if (!empty($this->data['CategoryTop']['brand'])):?>
            <?php foreach($this->data['CategoryTop']['brand'] as $key => $value):?>
            <?php $this->set('key', $key);?>
            <?php echo $this->element('category_top/brand');?>
        <?php endforeach;?>
    <?php elseif (!empty($this->data['CategoryTop']['mode'])):?>
        <label id="brandRequired" class="error-message"><?php echo $appSession->flash('brandRequired');?></label>
    <?php endif;?>
        </ul>
    </div>
    <!-- 品牌滚动栏 end-->
    <br class="clear" />
    <!-- 分类商品栏 -->
    <div class="topContent clearfix" id="categoryProductBlock">
        <h4>
            分类商品栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addCategoryProduct('CategoryTop');">[添加]</a>
        </h4>
    <?php if (!isset($this->data['CategoryTop']['category_product']) && empty($this->data['CategoryTop']['mode'])):?>
        <?php $this->data['CategoryTop']['category_product'][] = array();?>
    <?php endif;?>
<?php if (!empty($this->data['CategoryTop']['category_product'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['CategoryTop']['category_product'] as $key => $value):?>
        <?php $this->set('key', $key);?>
        <?php $this->set('index', $index);?>
        <?php echo $this->element('category_top/category_product');?>
        <?php $index++;?>
    <?php endforeach;?>
<?php endif;?>
        <label id="categoryProductRequired" class="error-message"><?php echo $appSession->flash('categoryProductRequired');?></label>
    </div>
    <!-- 分类商品栏 end-->
    <!-- 左侧广告栏 -->
    <div class="topContent clearfix" id="leftAdBlock">
        <h4>
            左侧广告栏 <a href="javaScript:void(0);" class="add" onClick="javaScript:addLeftAd('CategoryTop');">[添加]</a>
        </h4>
<?php if (!isset($this->data['CategoryTop']['left_ad']) && empty($this->data['CategoryTop']['mode'])):?>
    <?php $this->data['CategoryTop']['left_ad'][] = array();?>
<?php endif;?>
<?php if(!empty($this->data['CategoryTop']['left_ad'])):?>
    <?php $index=1;?>
    <?php foreach($this->data['CategoryTop']['left_ad'] as $key => $value):?>
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