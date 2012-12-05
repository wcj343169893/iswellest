<?php $this->page_props['title'] = $this->data['CategoryTop']['name'].' - '.__('info.siteNameCN', true);?>
<link href="/css/front/smoothDivScroll.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/jquery.smoothDivScroll-1.1.js"></script>
<style>
<!--
#scrollingBrand {
    border: 0px;
    height: 43px;
    padding: 2px 0;
    position: relative;
    width: 743px;
}
#scrollingFocusPic {
    width: 743px;
    height:200px;
}
.scrollableArea a {
    margin:0 19px 0 0;
}
-->
</style>
<!-- main -->
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/">首页</a> > <?php echo $this->data['CategoryTop']['name'];?>
</h2>
<div class="mainCenter clearfix">
    <!-- 活动广告 -->
    <div class="mainLeft">
        <h3 class="categorytopTitle"><?php echo $this->data['CategoryTop']['name'];?></h3>
        <div class="listProduct clearfix">
<?php if(empty($this->data['CategoryTop']['category2_id'])):?>
    <?php $categoryId = $this->data['CategoryTop']['category1_id'];?>
    <?php if (!empty($categoryAllOptionList['level_1'][$categoryId])):?>
            <dl class="listSort noneBorder">
                <dt><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $categoryId;?>"><?php echo $categoryAllOptionList['level_1'][$categoryId];?></a></dt>
            <?php if (!empty($categoryAllOptionList['level_2'][$categoryId])):?>
                <?php foreach($categoryAllOptionList['level_2'][$categoryId] as $k2 => $v2):?>
                <dd>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $categoryId;?>&category2_id:<?php echo $k2;?>"><?php echo $v2;?></a>
                </dd>
                <?php endforeach;?>
            <?php endif;?>
            </dl>
    <?php endif;?>
<?php else:?>
    <?php $category1Id = $this->data['CategoryTop']['category1_id'];?>
            <dl class="listSort noneBorder">
                <dt><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $category1Id;?>"><?php echo $categoryAllOptionList['level_1'][$category1Id];?></a></dt>
            <?php if (!empty($categoryAllOptionList['level_2'][$category1Id])):?>
                <?php foreach($categoryAllOptionList['level_2'][$category1Id] as $k2 => $v2):?>
                <dd>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $category1Id;?>/category2_id:<?php echo $k2;?>"><?php echo $v2;?></a>
                </dd>
                <?php endforeach;?>
            <?php endif;?>
            </dl>
<?php endif;?>
         </div>
     <?php foreach($this->data['CategoryTop']['left_ad'] as $key => $value):?>
        <div class="leftAd">
            <a href="<?php echo $value['url'];?>" title="<?php echo $value['comment'];?>"><img src="<?php echo $value['path'];?>" alt="<?php echo $value['comment'];?>"/></a><span class="adBorder"></span>
        </div>
    <?php endforeach;?>
    </div>
    <div class=" mainRight">
        <div class="focusPics">
        <?php echo $this->element('page_setting/focus_pic_disp');?>
        </div>
        <!-- Tab选项卡 -->
        <div id="categoryTab">
            <div class="tabTitle"> 
                <ul> 
                    <li id="newProductTab" class="selected" onmouseover="javaScript:showTab('newProduct');" onclick="javaScript:showTab('newProduct');"><a href="javaScript:void(0);">最新产品</a></li>
                    <li id="hotProductTab" onmouseover="javaScript:showTab('hotProduct');" onclick="javaScript:showTab('hotProduct');"><a href="javaScript:void(0);">最热产品</a></li> 
                </ul>
            </div>
            <div class="tabContent">
                <ul id="newProduct" class="tabList">
                <?php foreach($this->data['CategoryTop']['new_product'] as $k => $v):?>
                    <?php $this->set('productInfo', $v);?>
                    <li style="text-align:center"><?php echo $this->element('product/category_product_info');?></li>
                <?php endforeach;?>
                </ul>
                <ul id="hotProduct" class="tabList" style="display:none">
                <?php foreach($this->data['CategoryTop']['hot_product'] as $k => $v):?>
                    <?php $this->set('productInfo', $v);?>
                    <li style="text-align:center"><?php echo $this->element('product/category_product_info');?></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <!-- Tab选项卡 end -->
        <div class="clear"></div>
<?php if(!empty($brandList)):?>
        <div class="otherLogo" >
            <div id="scrollingBrand">
                <div class="scrollingHotSpotLeft" ></div>
                <div class="scrollingHotSpotRight"></div>
                <div class="scrollWrapper">
                    <div class="scrollableArea" style="width: 4000px;">
                <?php foreach($brandList as $key => $value):?>
                    <?php if (!empty($value['BrandPhoto'][0]['url'])):?>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:<?php echo $value['Brand']['id'];?>" title="<?php echo $value['Brand']['brand_name'];?>"><img src="<?php echo OMS_API_PHOTO_ROOT_URL.$value['BrandPhoto'][0]['url'];?>" width="88" height="43" alt="<?php echo $value['Brand']['brand_name'];?>"/></a>
                    <?php else:?>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:<?php echo $value['Brand']['id'];?>" title="<?php echo $value['Brand']['brand_name'];?>"><?php echo $value['Brand']['brand_name'];?></a>
                    <?php endif;?>
                    <?php /**
                    <!-- demo start -->
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_1.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_2.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_3.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_4.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_5.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_6.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_7.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_1.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_2.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_3.jpg"/></a>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/brand_id:1"><img src="/image/front/demo/logo_4.jpg"/></a>
                    <!-- demo end -->
                    */?>
                <?php endforeach;?>
                    </div>
                </div>
        </div>
        </div>
    <?php endif;?>
<?php foreach($this->data['CategoryTop']['category_product'] as $value):?>
        <!-- 化妆品分类 -->
        <span class="more"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $value['category1_id'];?>&category2_id:<?php echo $value['category2_id'];?>&category3_id:<?php echo $value['category3_id'];?>"></a></span>
        <h3 class="categorytopTitle2"><?php echo $categoryAllOptionList['level_3'][$value['category2_id']][$value['category3_id']];?></h3>
        <div class="categorytopSort bottom clearfix">
            <div class="csLeft" style="padding-top:5px;">
                <a href="<?php echo $value['leftmain_ad']['url'];?>" title="<?php echo $value['leftmain_ad']['comment'];?>"><img src="<?php echo $value['leftmain_ad']['path'];?>" alt="<?php echo $value['leftmain_ad']['comment'];?>"/></a>
            </div>
            <div class="csRight">
                <ul>
                <?php foreach($value['product'] as $k => $v):?>
                    <?php $this->set('productInfo', $v);?>
                    <li style="text-align:center"><?php echo $this->element('product/category_product_info');?></li>
                <?php endforeach;?>
                </ul>
                <div class="clear"></div>
                <p class="csBottom m_10">
                <?php foreach($value['right_ad'] as $k => $v):?>
                    <a href="<?php echo $v['url'];?>" title="<?php echo $v['comment'];?>"><img src="<?php echo $v['path'];?>"  alt="<?php echo $v['comment'];?>"/></a>
                <?php endforeach;?>
                </p>
            </div>
        </div>
        <div class="clear"></div>
<?php endforeach;?>
        <!-- 化妆品分类 end -->
    </div>
</div>
<!-- main end -->
<script type="text/javascript">
function showTab(id) {
    if (id == 'newProduct') {
        $("#newProductTab").addClass('selected');
        $("#hotProductTab").removeClass('selected');
        $("#newProduct").show();
        $("#hotProduct").hide();
    } else {
        $("#newProductTab").removeClass('selected');
        $("#hotProductTab").addClass('selected');
        $("#newProduct").hide();
        $("#hotProduct").show();
    }
}
$(window).load(function() {
    $("#scrollingFocusPic").smoothDivScroll(
            {autoScroll: "always", autoScrollDirection: "endlessloopright", autoScrollStep: 2, autoScrollInterval: 15});

    $("#scrollingBrand").smoothDivScroll(
            {autoScroll: "always", autoScrollDirection: "endlessloopright", autoScrollStep: 1, autoScrollInterval: 15});

    });
$("#scrollingFocusPic").bind("mouseover", function(){
    $("#scrollingFocusPic").smoothDivScroll("stopAutoScroll");
});
$("#scrollingFocusPic").bind("mouseout", function(){
    $("#scrollingFocusPic").smoothDivScroll("startAutoScroll");
});
$("#scrollingBrand").bind("mouseover", function(){
    $("#scrollingBrand").smoothDivScroll("stopAutoScroll");
});
$("#scrollingBrand").bind("mouseout", function(){
    $("#scrollingBrand").smoothDivScroll("startAutoScroll");
});
</script>