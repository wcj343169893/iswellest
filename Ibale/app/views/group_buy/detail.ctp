<?php $this->page_props['title'] = $groupBuyInfo['GroupBuy']['title'].' 【'.__('info.siteNameCN', true).'】';?>
<script type="text/javascript" src="/js/front/groupBuy.js"></script>
<!-- main -->
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>">首页</a> > <a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/">团购一览</a>
     > <?php echo $text->truncate($groupBuyInfo['GroupBuy']['title'], 30, array('ending'=>'...'));?>
</h2>
<div class="mainCenter clearfix m10">
    <div class="groupLeft">
        <h3 class="groupbuyTitle"><?php echo $groupBuyInfo['GroupBuy']['title'];?></h3>
        <!-- 团购图片-->
        <div class="groupPicture">
            <div class="btn">
                <div class="priceBuy">
                    <div class="saleBtn">
                    <?php /**
                    <?php if ($groupBuyInfo['GroupBuy']['max_purchase_number'] == $groupBuyInfo['GroupBuy']['purchase_product_count']):?>
                            结束时间 <?php echo substr($groupBuyInfo['GroupBuy']['last_order_datetime'], 0, 19);?>
                    <?php elseif (!$enableSale || $groupBuyInfo['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
                    */?>
                    <?php if(!empty($groupBuyInfo['GroupBuy']['inactive_flg']) || $groupBuyInfo['GroupBuy']['max_purchase_number'] <= $groupBuyInfo['GroupBuy']['purchase_product_count']):?>
                        <button type="button" class="btnImg btnNoneb"></button>
                    <?php elseif (!$enableSale || $groupBuyInfo['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
                        <button type="button" class="btnImg btnStopb"></button>
                    <?php else:?>
                        <button type="button" class="btnImg btnBuyb" onclick="javaScript:addToBag('<?php echo $groupBuyInfo['GroupBuy']['id'];?>', '<?php echo $groupBuyInfo['GroupBuy']['product_cd'];?>');"></button>
                    <?php endif;?>
                    </div>
                    <div class="salePrice"><?php echo $number->currency($groupBuyInfo['Product']['price_for_normal'], '￥');?></div>
                </div>
                <div class="clear"></div>
                <div class="priceTable">
                <?php if (!empty($groupBuyInfo['Product']['retail_price'])):?>
                    <p class="priceTxt">
                        原价<span><?php echo $number->currency($groupBuyInfo['Product']['retail_price'], '￥');?></span>
                    </p>
                <?php endif;?>
                    <p class="priceTxt">
                        总数<span><?php echo $groupBuyInfo['GroupBuy']['max_purchase_number'];?></span>
                    </p>
                <?php if (!empty($groupBuyInfo['Product']['retail_price'])):?>
                    <p class="priceTxt">
                        折扣<span><?php echo round(($groupBuyInfo['Product']['price_for_normal']/$groupBuyInfo['Product']['retail_price'])*10, 2);?></span>
                    </p>
                    <p class="priceTxt">
                        节省<span>
                        <?php echo $number->currency(($groupBuyInfo['Product']['retail_price']-$groupBuyInfo['Product']['price_for_normal']), '￥');?>
                        </span>
                    </p>
                <?php endif;?>
                </div>
                <div class="priceTable2 m_5">
                <?php /**
                <?php if ($groupBuyInfo['GroupBuy']['max_purchase_number'] == $groupBuyInfo['GroupBuy']['purchase_product_count']):?>
                        结束时间 <?php echo substr($groupBuyInfo['GroupBuy']['last_order_datetime'], 0, 19);?>
                <?php elseif (!$enableSale || $groupBuyInfo['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
                */?>
                
                <?php if (!empty($groupBuyInfo['GroupBuy']['inactive_flg'])):?>
                    结束时间 <?php echo substr($groupBuyInfo['GroupBuy']['inactive_datetime'], 0, 19);?>
                <?php elseif (!$enableSale || $groupBuyInfo['GroupBuy']['end_time'] <= date('Y-m-d H:i:s') || $groupBuyInfo['GroupBuy']['max_purchase_number'] <= $groupBuyInfo['GroupBuy']['purchase_product_count']):?>
                    结束时间 <?php echo substr($groupBuyInfo['GroupBuy']['end_time'], 0, 19);?>
                <?php else:?>
                    <p>距离结束还有</p>
                    <p class="priceTime orange remainTime" endtime="<?php echo date('Y/m/d H:i:s', strtotime($groupBuyInfo['GroupBuy']['end_time']));?>"><?php echo getRemainTime($groupBuyInfo['GroupBuy']['end_time']);?></p>
                <?php endif;?>
                </div>
                <div class="priceTable2 m_5">
                <?php if (!$enableSale || !empty($groupBuyInfo['GroupBuy']['inactive_flg']) || $groupBuyInfo['GroupBuy']['end_time'] <= date('Y-m-d H:i:s') || $groupBuyInfo['GroupBuy']['max_purchase_number'] <= $groupBuyInfo['GroupBuy']['purchase_product_count']):?>
                    <font class="orange"><?php __('info.groupBuySoldOut');?></font>
                <?php else:?>
                    <p class="priceTime">
                        <span class="orange"><?php echo $groupBuyInfo['GroupBuy']['purchase_person_count']+$groupBuyInfo['GroupBuy']['base_purchase_person_count'];?></span> 人已购买
                    </p>
                    <p>数量有限，下单要快哦</p>
                <?php endif;?>
                </div>
            </div>
            <?php $picUrl = (!empty($groupBuyInfo['Product']['ProductPhoto'][0]['url']))?OMS_API_PHOTO_ROOT_URL.$groupBuyInfo['Product']['ProductPhoto'][0]['url']:'/image/front/none_300.jpg';?>
            <p class="pic">
                <img id="bigPic" src="<?php echo $picUrl;?>" width="450" height="450" />
            </p>
            <ul class="smallPic" id="picBlock">
        <?php if (!empty($groupBuyInfo['Product']['ProductPhoto'])):?>
                <li id="picPrev" class="cursor_pointer"><img src="/image/front/btn_thumbnail_previous.png" width="8" height="75" /></li>
            <?php $index = 0;?>
            <?php foreach($groupBuyInfo['Product']['ProductPhoto'] as $key => $value):?>
                <?php $picUrl = (!empty($value['url']))?OMS_API_PHOTO_ROOT_URL.$value['url']:'/image/front/none_90.jpg';?>
                <?php if ($key < 5):?>
                <li><a href="javaScript:void(0);" onclick="javaScript:showLargePic(this);return false;"><img src="<?php echo $picUrl;?>" width="75" height="75" /> </a></li>
                <?php endif;?>
            <?php endforeach;?>
                <li id="picNext" class="cursor_pointer"><img src="/image/front/btn_thumbnail_next.png" width="8" height="75" /></li>
        <?php endif;?>
            </ul>
        </div>
        <div class="clear"></div>
        <!-- 详细介绍 -->
        <div class="groupDetail m10">本团购详细信息</div>
        <div class="bdDetail">
            <?php echo $groupBuyInfo['GroupBuy']['comment'];?>
        </div>
    </div>
    <div class="groupRight">
        <h3 class="otherTitle">正在进行的其他团购</h3>
        <ul class="otherGroupbuy">
        <?php foreach($dataList as $key => $value):?>
            <?php $picUrl = (!empty($photoList[$value['GroupBuy']['product_cd']][0]['ProductPhoto']['url']))?OMS_API_PHOTO_ROOT_URL.$photoList[$value['GroupBuy']['product_cd']][0]['ProductPhoto']['url']:'/image/front/none_90.jpg';?>
            <li class="borderNone">
                <p>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>"><?php echo $value['GroupBuy']['title'];?></a>
                </p>
                <p>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>"><img src="<?php echo $picUrl;?>" width="170" height="170" /></a>
                </p>
                <p class=" font-12">
                <?php if (!$value['GroupBuy']['enable_sale'] || !empty($value['GroupBuy']['inactive_flg']) || $value['GroupBuy']['end_time'] <= date('Y-m-d H:i:s') || $value['GroupBuy']['max_purchase_number'] <= $value['GroupBuy']['purchase_product_count']):?>
                    <font class="orange"><?php __('info.groupBuySoldOut');?></font>
                <?php else:?>
                    <font class="orange">
                    <?php echo $value['GroupBuy']['purchase_person_count']+$value['GroupBuy']['base_purchase_person_count'];?></font>
                    人已购买
                <?php endif;?>
                <?php if (!empty($value['GroupBuy']['inactive_flg']) || $value['GroupBuy']['max_purchase_number'] <= $value['GroupBuy']['purchase_product_count']):?>
                    <button type="button" class="btnImg btnNone" onclick="javascript:void(0);"></button>
                <?php elseif (!$value['GroupBuy']['enable_sale'] || $value['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
                    <button type="button" class="btnImg btnStop" onclick="javascript:void(0);"></button>
                <?php else:?>
                    <button type="button" class="btnImg btnBuy" onclick="javaScript:addToBag('<?php echo $value['GroupBuy']['id'];?>', '<?php echo $value['GroupBuy']['product_cd'];?>');"></button>
                <?php endif;?>
                </p>
            </li>
        <?php endforeach;?>
        </ul>
    </div>
</div>
<!-- main end -->
<script type="text/javascript">
var pics  = [
<?php if (!empty($groupBuyInfo['Product']['ProductPhoto'])):?>
<?php foreach($groupBuyInfo['Product']['ProductPhoto'] as $key => $value):?>
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

function addToBag(id, productCd) {
    $.get('/shopping/ajax_add_to_bag/', {
                id:id,
                product_cd:productCd,
                sale_method:'<?php echo SALE_METHOD_GROUP_BUY?>',
                order_amount:1
            }, function(rs){
                $(".groupLeft").append(rs);
            }
    );
}

</script>