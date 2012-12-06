<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 商品一览';?>
<?php echo $appForm->hidden('Search.sort_price', array('id'=>'sort_price'));?>
<?php echo $appForm->hidden('Search.sort_new', array('id'=>'sort_new'));?>
<?php echo $appForm->hidden('Search.sort_sale', array('id'=>'sort_sale'));?>
<!-- main -->
<?php if (!empty($this->params['named']['brand_id'])):?>
	<div class="mainCenter clearfix">
	    <?php $brandId = $this->params['named']['brand_id'];?>
	    <h2 class="crumbList">
	        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:0">全部结果</a> &gt; <?php echo $brandList[$brandId]['Brand']['brand_name'];?>
	    </h2>
	    <div class="brandTxt clearfix">
	        <p class="txtleft"><?php echo $brandList[$brandId]['Brand']['brand_name'];?></p>
	        <p class="txtRight"><?php echo $brandList[$brandId]['Brand']['brand_description'];?></p>
	    </div>
	    <?php if (!empty($brandList[$brandId]['BrandPhoto'][0]['url'])):?>
	    <h3>
	        <img src="<?php echo OMS_API_PHOTO_ROOT_URL.$brandList[$brandId]['BrandPhoto'][0]['url'];?>" width="1000" height="auto"/>
	    </h3>
	    <?php endif;?>
	</div>
<?php else:?>
<div class="mainCenter clearfix">
	<div class="crumb">
            <h2 class="crumbList">
            <?php if (!empty($this->params['named']['category_id'])):?>
                <?php $this->set('categoryId', $this->params['named']['category_id']);?>
            <?php endif;?>
            <?php echo $this->element('product/category_navi_link');?>
            </h2>
            <span>搜索结果 <b>(<?php echo number_format($this->params['paging']['Product']['count']);?>)</b></span>
        </div>
</div>
<?php endif;?>
<div class="mainCenter clearfix m_10">
    <!-- 活动广告 -->
    <div class="mainLeft">
        <h3 class="itemTitle">所有分类</h3>
        <div class="listProduct clearfix category_lst">
	        <?php if (!empty($this->params['named']['brand_id'])):?>
	            <?php $categoryList = $brandCategoryList;?>
	        <?php else:?>
	            <?php $categoryList = $categoryAllOptionList;?>
	        <?php endif;?>
        	<?php $this->set('categoryList', $categoryList);?>
        	<?php echo $this->element('category/tree_category');?>
        </div>
        <h3 class="itemTitle it_1 m_10">搜索过该商品的用户还看过</h3>
        <div class="listProduct clearfix">
        </div>
        <h3 class="itemTitle it_2 m_10">一周销量排行</h3>
        <div class="listProduct clearfix">
        </div>
        <h3 class="itemTitle it_3 m_10">搜索记录</h3>
        <div class="listProduct clearfix">
        </div>
        <h3 class="itemTitle it_4 m_10">浏览记录</h3>
        <div class="listProduct clearfix">
        </div>
        <?php if (!empty($bannerList)):?>
            <?php foreach($bannerList['focus_pic'] as $key => $value):?>
            <div class="leftAd">
                <a href="<?php echo $value['url'];?>"><img src="<?php echo $value['path'];?>" /></a><span class="adBorder"></span>
            </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="mainRight">
<?php if (empty($this->params['named']['brand_id'])):?>
		<div class="list_hot">
			<span class="list_hot_ico">热卖推荐</span>
			<?php if(!empty($recommend_product)):?>
			<ul class="list_hot_products">
				<?php foreach($recommend_product as $k=>$v):?>
				<li>
					<img alt="<?php echo $v["product_name"]?>" src="<?php echo $v["photo_url"]?>">
					<div class="pro_desc">
						<p class="pro_title"><?php echo $v["product_name"]?></p>
						<p class="pro_price">今日特价:￥<?php echo $v["price_for_normal"]?><span class="del">￥<?php echo $v["retail_price"]?></span></p>
						<p><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?>" class="ico_buy_now">立即抢购</a></p>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<div>一般分类列表</div>
        <?php $brandIdKeys = array_keys($brandIds);?>
        <?php if(!empty($brandIds) && count($brandIds) == 1 && !empty($brandIdKeys[0]) && !empty($brandList[$brandIdKeys[0]]['BrandPhoto'][0]['url'])):?>
        <h3>
            <?php $brandId = $brandIdKeys[0];?>
            <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/index/?brand_id=<?php echo $brandId;?>"><img src="<?php echo !empty($brandList[$brandId]['BrandPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$brandList[$brandId]['BrandPhoto'][0]['url']:'/image/front/none_300.jpg';?>" width="790" height="260" /></a>
        </h3>
        <?php endif;?>
        <!-- 相关分类 -->
        <div class="txtList clearfix">
            <p class="txtTitle">品牌：<span class="txtList_all">全部</span></p>
            <p class="txtContent" id="list_brand">
	            <?php $index = 0;?>
	            <?php $displayBrands = array();?>
	            <?php foreach($brandIds as $key => $value):?>
	                <?php if (in_array($key, $displayBrands)):?>
	                    <?php continue;?>
	                <?php endif;?>
	                <?php $displayBrands[] = $key;?>
	                <span class="display-inline m_l_20"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:<?php echo $key;?>" title="<?php echo $brandList[$key]['Brand']['brand_name'];?>"><?php echo $text->truncate($brandList[$key]['Brand']['brand_name'], 10, array('ending'=>'...'));?></a></span>
	                <?php $index++;?>
	            <?php endforeach;?>
            </p>
        <?php if ($index >= 8):?>
        	<div class="clear"></div>
        	<script type="text/javascript">
            	var list_brand = $("#list_brand");
                var list_brand_height=list_brand.height();
                var sfh=0;
                if(list_brand_height>40){
                    document.write("<div class='showMoreBrandBtn'></div>");
                    $("<a href='javascript:;' onclick='sofh()' class='more'>&nbsp;</a>").appendTo(".showMoreBrandBtn");sofh();
                 }
                        	function sofh(){
                        		if(sfh){
                        			$("#list_brand").animate({ height: list_brand_height,}, 500 );
                        			$(".showMoreBrandBtn>a").addClass("more_up");
                        			sfh=0;
                        		}else{
                        			$("#list_brand").animate({ height: "40px",}, 500 );
                        			$(".showMoreBrandBtn>a").removeClass("more_up");
                        			sfh=1;
                        		}
                        	}
            </script>
        <?php endif;?>
        </div>
        <!-- 
        <div class="txtList2 clearfix">
            <p class="txtTitle">相关分类：<span class="txtList_all">全部</span></p>
            <p class="txtContent">
        <?php if(!empty($categoryIds)):?>
            <?php $index = 0;?>
            <?php $category2Ids = array();?>
            <?php foreach($categoryIds as $key => $value):?>
                <?php //大カテゴリ ?>
                <?php if (!empty($categoryAllOptionList['level_1'][$key]) && !empty($categoryAllOptionList['level_2'][$key])):?>
                    <?php foreach($categoryAllOptionList['level_2'][$key] as $k2 => $v2):?>
                        <?php if (in_array($k2, $category2Ids)):?>
                            <?php continue;?>
                        <?php endif;?>
                        <?php $category2Ids[] = $k2;?>
                        <span class="display-inline" style="width:135px;"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $key;?>/category2_id:<?php echo $k2;?>"><?php echo $text->truncate($v2, 10, array('ending'=>'...'));?></a></span>
                        <?php $index++;?>
                        <?php if ($index == 8):?>
                    </p>
                    <p id="hiddenCategory" class="txtContentall" style="display:none;padding-left:90px;">
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php continue;?>
                <?php //中カテゴリ ?>
                <?php elseif (empty($categoryAllOptionList['level_1'][$key]) && !empty($categoryAllOptionList['level_2'][$categoryAllOptionList[$key]['parent_id']])):?>
                    <?php $parentId = $key;?>
                    <?php $parentParentId = $categoryAllOptionList[$key]['parent_id'];?>
                <?php //小カテゴリ ?>
                <?php elseif (empty($categoryAllOptionList['level_1'][$key]) && empty($categoryAllOptionList['level_2'][$key]) && !empty($categoryAllOptionList['level_3'][$categoryAllOptionList[$key]['parent_id']])):?>
                    <?php $parentId = $categoryAllOptionList[$key]['parent_id'];?>
                    <?php $parentParentId = $categoryAllOptionList[$parentId]['parent_id'];?>
                <?php endif;?>
                <?php if (empty($parentId) || in_array($parentId, $category2Ids)):?>
                    <?php continue;?>
                <?php endif;?>
                <?php $category2Ids[] = $parentId;?>
                <span class="display-inline" style="width:135px;">| <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $parentParentId;?>/category2_id:<?php echo $parentId;?>" title="<?php echo $categoryAllOptionList[$parentId]['category_title'];?>"><?php echo $text->truncate($categoryAllOptionList[$parentId]['category_title'], 10, array('ending'=>'...'));?></a></span>
                <?php $index++;?>
                <?php if ($index == 7):?>
            </p>
            <p id="hiddenCategory" class="txtContentall" style="display:none;padding-left:90px;">
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
            </p>
        <?php if ($index >= 8):?>
            <span id="showMoreCategoryBtn" class="txtMore" onclick="javaScript:showMoreCategory();"><a href="javaScript:void(0);"></a> </span>
        <?php endif;?>
        </div>
        <div class="clear"></div> -->
        <!-- 相关分类 end -->
<?php endif;?>
        <!-- 产品分页 -->
        <?php $this->set('pageSection', 1);?>
        <?php /** echo $this->element('common/pagination', array('model'=>'Product'));**/ ?>
        <!---------->
        <div class="modOrder">
            <p style="width:660px;">
                <?php if (empty($this->params['named']['sort_key'])):?><a href="javascript:void(0);" class="o_select">默认<span class="ico_12">&nbsp;</span></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('0');return false;">默认<span class="ico_12">&nbsp;</span></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '1'):?><a href="javascript:void(0);" class="o_select">销量<span class="ico_12">&nbsp;</span></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('1');return false;">销量<span class="ico_12">&nbsp;</span></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '2'):?><a href="javascript:void(0);" class="o_select">最新<span class="ico_12">&nbsp;</span></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('2');return false;">最新<span class="ico_12">&nbsp;</span></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '4'):?>
	                <a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('3');return false;" class="o_select">价格<span class="ico_13">&nbsp;</span></a>
                <?php elseif ($this->params['named']['sort_key'] == '3'):?>
	                <a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('4');return false;" class="o_select">价格<span class="ico_12">&nbsp;</span></a>
                <?php else:?>
                	<a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('4');return false;">价格<span class="ico_14">&nbsp;</span></a>
                <?php endif;?> 
                <span class="modOrder_search_price">
	              	<?php echo $appForm->text('Product.min_price', array('id'=>'minPrice', 'class'=>'input', 'size'=>'8','title'=>"按价格区间筛选"));?> - <?php echo $appForm->text('Product.max_price', array('id'=>'maxPrice', 'class'=>'input', 'size'=>'8','title'=>"按价格区间筛选"));?>
	                <button type="button" class="btnImg btnOk" onclick="javaScript:searchProductByPrice();"></button>
                </span>
            </p>
            <?php $this->set('pageSection', 2);$this->set('onlyButton', 1);?>
        	<?php echo $this->element('common/pagination', array('model'=>'Product')); ?>
        </div>
        <ul class="itemLisit clearfix">
    <?php if(!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <?php $this->set('productInfo', $value);?>
            <li style="padding-right:15px;text-align:center;"><?php echo $this->element('product/category_product_info');?></li>
        <?php endforeach;?>
    <?php else:?>
        <?php __('info.recodeNotFound');?>
    <?php endif;?>
        </ul>
        <div class="clear"></div>
        <?php echo $this->element('common/pagination', array('model'=>'Product')); ?>
<?php if(empty($dataList)):?>
    <div style="width:788px;height:300px;">
    <?php echo $this->requestAction('/toppage/ranking_products');?>
    </div>
<?php endif;?>
    </div>
</div>
<!-- main end -->
<script type="text/javascript">
function showMoreBrand() {
    if ($("#hiddenBrand").css('display') == 'none') {
        $("#hiddenBrand").show();
        $("#showMoreBrandBtn").attr('class', 'txtMoredown');
    } else {
        $("#hiddenBrand").hide();
        $("#showMoreBrandBtn").attr('class', 'txtMore');
    }
}
function showMoreCategory() {
    if ($("#hiddenCategory").css('display') == 'none') {
        $("#hiddenCategory").show();
        $("#showMoreCategoryBtn").attr('class', 'txtMoredown');
    } else {
        $("#hiddenCategory").hide();
        $("#showMoreCategoryBtn").attr('class', 'txtMore');
    }
}

function changeSortOrder(sortKey) {
    var url = '<?php echo HTTP_HOME_PAGE_URL;?>/<?php echo addslashes($this->params['url']['url']);?>';
    var reg = new RegExp('/sort_key:.*', 'gi');
    var newUrl = url.replace(reg, "");
    newUrl += '/sort_key:'+sortKey;
    redirect(newUrl);
}
function searchProductByPrice() {
    if ($("#minPrice").val() == '' && $("#maxPrice").val() == '') {
        //alert('<?php __('error.inputSearchPrice');?>');
        //return;
    }
    //数値をチェック
    var intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    var minPrice = $('#minPrice').val();
    var maxPrice = $('#maxPrice').val();
    
    if(minPrice != '' && !intRegex.test(minPrice) && !floatRegex.test(minPrice)) {
        alert('<?php echo renderMsg(__('error.numeric', true),'最小价格');?>');
        return;
    }
    if(maxPrice != '' && !intRegex.test(maxPrice) && !floatRegex.test(maxPrice)) {
        alert('<?php echo renderMsg(__('error.numeric', true),'最大价格');?>');
        return;
    }
    var url = '<?php echo HTTP_HOME_PAGE_URL;?>/<?php echo addslashes($this->params['url']['url']);?>';
    var reg = new RegExp('(/min_price\:.*|/max_price\:.*)', 'gi');
    var newUrl = url.replace(reg, "");
    newUrl += '/min_price:'+minPrice+'/max_price:'+ maxPrice;

    window.location.href = newUrl;
}
</script>