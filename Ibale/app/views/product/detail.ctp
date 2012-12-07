<?php $this->page_props['title'] = $detail['Product']['product_name'].' - '.__('info.siteNameCN', true);?>
<script type="text/javascript" src="/js/jquery.url.js"></script>
<script type="text/javascript" src="/js/front/ajaxSubmit.js"></script>
<script type="text/javascript" src="/js/Groject.ImageSwitch.yui.js"></script>
<script type="text/javascript">
<!--
function addToBag2() {
    $.get('/shopping/ajax_add_to_bag/', {
                product_cd:'<?php echo $this->params['named']['product_cd']?>',
                order_amount:$("#ProductOrderAmount").val(),
                sale_method:'<?php echo (!empty($this->params['named']['gift_flg']))?SALE_METHOD_GIFT:'';?>'
            }, function(rs){
                $('body').append(rs);
                $("#shoppingBagCountHeader").text($("#shoppingBagCount").text());
            }
    );
}
function rediretToPayment() {
    $.get('/shopping/ajax_add_to_payment/', {
                product_cd:'<?php echo $this->params['named']['product_cd']?>',
                order_amount:$("#ProductOrderAmount").val(),
                sale_method:'<?php echo (!empty($this->params['named']['gift_flg']))?SALE_METHOD_GIFT:'';?>',
                referer:'product'
            }, function(rs){
                $('body').append(rs);
            }
    );
}
function bookmarkProduct() {
    $.get('/product_bookmark/ajax_add/', {
                product_cd:'<?php echo $this->params['named']['product_cd']?>'
            }, function(rs){
                    $('body').append(rs);
            }
    );
}
function showEstimation() {
    var index = 1;
    var obj = $(".tabTitle ul li").eq(index);
    obj.addClass("selected").siblings().removeClass("selected");//当前选中CSS样式
    $(".tabContent .bd").eq(index).show().siblings().hide();//内容CSS
}
function ctrlHiddenProduct(obj, key) {
    if ($(obj).attr('title') == '收起') {
        $(obj).html('<span class="more-product-expand"></span>其他商品');
        $(obj).attr('title','展开');
        $(obj).parent().find("#hiddenProduct"+key).hide();
    } else {
        $(obj).html('<span class="more-product-collapse"></span>收起');
        $(obj).attr('title','收起');
        $(obj).parent().find("#hiddenProduct"+key).show();
    }
}

$(function(){
    var index = 0;  
    $(".tabTitle ul li").click(function(){//你的选项卡导航
        index = $(".tabTitle ul li").index(this);//
        $(this).addClass("selected").siblings().removeClass("selected");//当前选中CSS样式
        $(".tabContent .bd").eq(index).show().siblings().hide();//内容CSS
    });
 });
//-->
</script>
    <!-- main -->
    <h2 class="crumbList">
    <?php $this->set('categoryId', '');?>
    <?php if (!empty($detail['Category'][0]['Category']['id'])):?>
        <?php $this->set('categoryId', $detail['Category'][0]['Category']['id']);?>
    <?php endif;?>
    <?php //echo $this->element('product/category_navi_link');?>
    </h2>
    <div class="mainCenter">
        <div class="detail clearfix">
            <div class="picture">
                <?php $picUrl = '/image/front/none_300.jpg';?>
                <?php if (!empty($detail['ProductPhoto'][0]['url'])):?>
                    <?php $picUrl = OMS_API_PHOTO_ROOT_URL.$detail['ProductPhoto'][0]['url'];?>
                <?php endif;?>
                 <p class="pic" ><img id="bigPic" src="<?php echo $picUrl;?>" width="450" height="450" /></p>
                  <ul class="smallPic" id="picBlock">
            <?php if (!empty($detail['ProductPhoto'])):?>
                    <li id="picPrev" class="cursor_pointer"><img src="/image/front/btn_thumbnail_previous.png" width="8" height="75" /></li>
                <?php $index = 0;?>
                <?php foreach($detail['ProductPhoto'] as $key => $value):?>
                    <?php $picUrl = '/image/front/none_90.jpg';?>
                    <?php if (!empty($value['url'])):?>
                        <?php $picUrl = OMS_API_PHOTO_ROOT_URL.$value['url'];?>
                    <?php endif;?>
                    <?php if ($key < 5):?>
                    <li><a href="javaScript:void(0);" onclick="javaScript:showLargePic(this);return false;"><img src="<?php echo $picUrl;?>" width="75" height="75" /></a></li>
                    <?php endif;?>
                <?php endforeach;?>
                    <li id="picNext" class="cursor_pointer"><img src="/image/front/btn_thumbnail_next.png" width="8" height="75" /></li>
            <?php endif;?>
                </ul>
            </div>
            <div class="property">
                   <h1>
               <?php if (!empty($detail['Product']['require_customer_rank']) && !in_array($detail['Product']['require_customer_rank'], array(CUSTOMER_RANK_NORMAL, CUSTOMER_RANK_NONE))):?>
                   <span class="orange">【<?php echo $msts['customer_rank'][strtolower($detail['Product']['require_customer_rank'])]?>限定】</span>
               <?php endif;?>
                   <?php echo $detail['Product']['product_name'];?></h1>
                <ul>
                <?php if (!empty($detail['Product']['require_customer_rank']) && !in_array($detail['Product']['require_customer_rank'], array(CUSTOMER_RANK_NORMAL, CUSTOMER_RANK_NONE))):?>
                    <li><span class=""><a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('什么是会员限定？');?>">什么是会员限定？</a></span>
                <?php endif;?>
                    <li><span class="w_90">商品编号：</span><span><?php echo $detail['Product']['product_cd'];?></span>
                    </li>
                    <li><span class="w_90">爱芭乐价格：</span>
                        <?php if (!empty($detail['Product']['sale_price']) && !empty($detail['Product']['retail_price']) && ($detail['Product']['retail_price'] > $detail['Product']['sale_price'])):?>
                            <del>
                                ￥
                                <?php echo $number->currency($detail['Product']['retail_price'], '');?>
                            </del>
                            <em>￥<?php echo $number->currency($detail['Product']['sale_price'], '');?> </em> <br />
                        <?php elseif(!empty($detail['Product']['sale_price'])):?>
                            <em style="padding:0px;">￥<?php echo $number->currency($detail['Product']['sale_price'], '');?> </em>
                        <?php endif;?>
                    
                    </li>
                <?php if(!empty($detail['SaleRule'])):?>
                    <li><span class="w_90">活    动：</span>
                    <div style="padding:5px 10px;background:#FFF9E8;border-top:1px solid #ECAF44;border-bottom:1px solid #ECAF44;">
                        <?php echo $this->element('product/sale_rule');?>
                    </div>
                    </li>
                <?php endif;?>
                <?php if (!empty($bonusProductList)):?>
                    <li><span class="w_100">赠    品：(买即赠以下任一商品，抢完为止。)</span>
                    <div style="padding:5px 10px;background:#FFF9E8;border-top:1px solid #ECAF44;border-bottom:1px solid #ECAF44;">
                    <?php foreach($bonusProductList as $key => $value):?>
                        <img style="vertical-align:middle;" src="<?php echo !empty($value['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$value['ProductPhoto'][0]['url']:'/image/front/none_90.jpg'?>" onerror="this.src=/image/front/none_90.jpg" width="20" height="20"/><font style="padding-left:10px;"><?php echo $value['Product']['product_name'];?></font><br>
                    <?php endforeach;?>
                    </div>
                    </li>
                <?php endif;?>
                    <li><span class="w_90">厂    家：</span><?php echo !empty($detail['Manufacturer']['manufacturer_name'])?$detail['Manufacturer']['manufacturer_name']:'';?> </li>
                    <li><span class="w_90">评    价：</span>
                <?php if (!empty($detail['Estimation']['count'])):?>
                    <?php $this->set('point', $detail['Estimation']['point']);?>
                    <?php echo $this->element('estimation/point');?>
                    <?php echo number_format($detail['Estimation']['point'],1);?>分
                <?php endif;?> 
                    <a href="#tab" onclick="javaScript:showEstimation();">(已有<?php echo $detail['Estimation']['count'];?>人评价)</a>
                    </li>
                    <li><span class="w_90">规    格：</span>
                    <span>
                    <?php foreach(objectToArray(json_decode($detail['Product']['attributes'])) as $key => $value):?>
                        <?php echo $key?>:<?php echo $value;?><br/>
                    <?php endforeach;?>
                    </span>
                    </li>
                <?php if ($detail['Product']['product_type'] != PRODUCT_TYPE_JIT):?>
                    <li><span class="w_90">库存数量：</span>
                        <?php $stockNumEnough = $app->getConfigValue('product', 'stock_num_enough');?>
                        <?php if (!empty($detail['StockInfo']['count']) && !empty($stockNumEnough) && $detail['StockInfo']['count']> $stockNumEnough):?>
                            <?php printf(__('info.stockNumEnough', true), $stockNumEnough);?>
                        <?php else:?>
                            <?php echo !empty($detail['StockInfo']['count'])?$detail['StockInfo']['count']:'0';?>
                        <?php endif;?>
                    </li>
                <?php endif;?>
                    <li><span class="w_90">送到日期：</span><?php echo $deliveryDay;?></li>
                    <li><span class="w_90">付款方式：</span><span><img src="/image/front/i_1.gif"> 支付宝</span><span class="p_15_l"><img src="/image/front/i_2.gif"> 货到付款</span></li>
                </ul>
                <div class="buyInfo">
                    <p>
                        购物数量： <label class="jian" id="reduceOrderAmount">&#12288;</label><?php echo $appForm->text('Product.order_amount', array('class'=>'w_25 center', 'maxlength'=>2, 'style'=>'ime-mode:disabled !important;', 'onkeydown'=>'javaScript:digitInput(this,event)'));?><label class="jia" id="addOrderAmount">&#12288;</label>
                        <?php if(!empty($detail['Product']['order_limit_count'])):?>
                        <span class=" p_35_l orange">最大限购数量: <?php echo number_format($detail['Product']['order_limit_count']);?>件</span>
                        <?php endif;?>
                    </p>
                    <p>
                    <?php if ($enableSale):?>
                        <button type="button" class="btnImg btnBuy" onclick="javascript:rediretToPayment();"></button>
                        <button type="button" class="btnImg btnCart" onclick="javascript:addToBag2();"></button>
                    <?php else:?>
                        <button type="button" class="btnImg btnBuynone" onclick="javascript:void(0);"></button>
                        <button type="button" class="btnImg btnCartnone" onclick="javascript:void(0);"></button>
                    <?php endif;?>
                        <button type="button" class="btnImg btnCollect" onclick="javascript:bookmarkProduct();"></button>
                    </p>
                    <p>
                        <?php echo $this->element('product/share_to');?>
                    </p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?php if(!empty($detail['SaleRule'])):?>
        <!-- 促销信息 -->
        <div class="titleBg m_10">
            <h3 class="itemTitle1">促销信息</h3>
        </div>
        <div class="itemSale sale_rule" style="padding:5px 10px;background:#FFF9E8;border-top:1px solid #ECAF44;border-bottom:1px solid #ECAF44;">
            <?php echo $this->element('product/sale_rule');?>
        </div>
        <!-- 促销信息 end -->
        <?php endif;?>
        <div class="clear"></div>
        <!-- Tab栏 -->
        <div id="tab">
            <div class="tabTitle">
            <?php $selectedTab = !empty($this->params['named']['selected'])?$this->params['named']['selected']:'desc';?>
            <?php $tabs = array('desc', 'estimation', 'service', 'enquiry');?>
                <ul>
                    <li <?php if ($selectedTab == 'desc'):?>class="selected"<?php endif;?>>商品详细</li>
                    <li <?php if ($selectedTab == 'estimation'):?>class="selected"<?php endif;?>>评价详细(<?php echo $detail['Estimation']['count'];?>件)</li>
                    <li <?php if ($selectedTab == 'service'):?>class="selected"<?php endif;?>>售后服务</li>
                    <li <?php if ($selectedTab == 'enquiry'):?>class="selected"<?php endif;?>>询问(<?php echo $detail['Enquiry']['count'];?>件)</li>
                </ul> 
            </div>
            <div class="tabContent">
                <div id="productDesc" class="bd <?php if ($selectedTab != 'desc'):?>none<?php endif;?>">
                <?php echo $this->element('product/cached_product_comment', array('cache'=>array('time'=>STATIC_PAGE_CACHED_DURATION, 'key'=>$detail['Product']['product_cd'])));?>
                </div>
                <!-- 评价详细 -->
                <div id="productEstimation" class="bd <?php if ($selectedTab != 'estimation'):?>none<?php endif;?>">
                <?php if (!empty($detail['Estimation']['count'])):?>
                    <div class="perf clearfix">
                        <div class="perfLeft"><?php echo sprintf('%01.1f',round($detail['Estimation']['point']));?></div>
                        <div class="perfCenter">
                            <?php $this->set('point', $detail['Estimation']['point']);?>
                            <?php echo $this->element('estimation/point');?>
                            <br /><?php echo $detail['Estimation']['count'];?>次打分
                        </div>
                        <div class="perfRight"><?php echo $detail['Product']['product_name'];?></div>
                    </div>
                    <?php else:?>
                    <?php endif;?>
                    <br class="clear" />
                    <div id="estimationBody">
                    <?php echo $this->requestAction('/estimation/ajax_list/product_cd:'.$this->params['named']['product_cd']);?>
                    <?php echo $this->element('estimation/add_for_product_detail');?>
                    </div>
                </div>
                <!-- 售后服务 -->
                <div id="service" class="bd <?php if ($selectedTab != 'service'):?>none<?php endif;?>">
                <?php echo $this->element('product/service');?>
                </div>
                <!-- 询问 -->
                <div id="productEnquiry" class="bd <?php if ($selectedTab != 'enquiry'):?>none<?php endif;?>">
                    <div id="enquiryBody">
                    <?php echo $this->requestAction('/enquiry/ajax_list/product_cd:'.$this->params['named']['product_cd']);?>
                    </div>
                    <div id="productEnquiryForm" class="itemComment">
                    <?php //if ($appSession->check('Front.Product.Enquiry.data')):?>
                        <?php //echo $this->requestAction('/enquiry/add');?>
                    <?php //else:?>
                        <?php echo $this->element('/product/add_enquiry');?>
                    <?php //endif;?>
                    </div>
                </div> 
            </div>
        </div>
        <!-- Tab栏 end -->
        <?php //echo $this->element('product/cached_relation_product', array('cache' => array('key'=>$detail['Product']['product_cd'], 'time'=>STATIC_PAGE_CACHED_DURATION)));?>
        <br class="clear" />
        <?php $this->set('currentProductCd', $detail['Product']['product_cd']);?>
</div>
<div class="detail_history">
	<?php echo $this->element('product/cached_browsered_product');//, array('cache' => array('key'=>$appSession->id(), 'time'=>'+1 hour')));?>
</div>
<script type="text/javascript">
var pics  = [
<?php if (!empty($detail['ProductPhoto'])):?>
<?php foreach($detail['ProductPhoto'] as $key => $value):?>
<?php $picUrl = '/image/front/none_300_2.jpg';?>
<?php if (!empty($value['url'])):?>
<?php $picUrl = OMS_API_PHOTO_ROOT_URL.$value['url'];?>
<?php endif;?>
"<?php echo $picUrl;?>",
<?php endforeach;?>
<?php endif;?>
];
var beginImgIndex = 0;

$("#bigPic").attr("src", pics[0]);
$(function(){
    $("#reduceOrderAmount").click(function(){
        if ($("#ProductOrderAmount").val() != '' & parseInt($("#ProductOrderAmount").val()) > 1) {
            $("#ProductOrderAmount").val(parseInt($("#ProductOrderAmount").val()) - 1);
        } else {
            alert('<?php __('error.orderAmountDenyZero');?>');
        }
    });
    $("#addOrderAmount").click(function(){
        if (parseInt($("#ProductOrderAmount").val()) == 99) {
            return false;
        }
        if ($("#ProductOrderAmount").val() == '') {
            $("#ProductOrderAmount").val(1);
            return;
        }
        $("#ProductOrderAmount").val(parseInt($("#ProductOrderAmount").val()) + 1);
    });
    $("#closeBookmark").click(function(){
        $("#bookmarkPop").hide();
    });
    $("#closeLoginPop").click(function(){
        $("#loginPop").hide();
    });
});
</script>