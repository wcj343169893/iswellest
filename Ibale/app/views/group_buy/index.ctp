<?php $this->page_props['title'] = '团购'.' - '.__('info.siteNameCN', true);?>
<script type="text/javascript" src="/js/front/groupBuy.js"></script>
<!-- main -->
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>">首页</a> > 团购一览
</h2>
<h3 class="groupTitle">
    <span></span>
</h3>
<div class="groupOrder">
    <p>
        <?php if ($this->params['named']['sort_key'] == '1'):?><a href="javaScript:void(0);">默认排序<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/list/sort_key:1">默认排序<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
        <?php if ($this->params['named']['sort_key'] == '2'):?><a href="javaScript:void(0);">销售排序<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/list/sort_key:2">销售排序<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
        <?php if ($this->params['named']['sort_key'] == '3' ):?><a href="javaScript:void(0);">价格排序<img src="/image/front/arrow_up.gif"></a><?php else:?><a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/list/sort_key:3">价格排序<img src="/image/front/arrow_up_dis.gif"></a><?php endif;?> 
        <?php if ($this->params['named']['sort_key'] == '4'):?><a href="javaScript:void(0);">折扣排序<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/list/sort_key:4">折扣排序<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
    </p>
</div>
<?php if (!empty($dataList)):?>
<ul class="groupContent clearfix">
    <?php foreach($dataList as $key => $value):?>
        <li>
            <p class="titleTxt"><?php echo $text->truncate($value['GroupBuy']['title'], 40, array('ending' => '...'));?></p>
            <p style="align:center;margin:0px 50px;">
                <?php $picUrl = (!empty($photoList[$value['GroupBuy']['product_cd']][0]['ProductPhoto']['url']))?OMS_API_PHOTO_ROOT_URL.$photoList[$value['GroupBuy']['product_cd']][0]['ProductPhoto']['url']:'/image/front/none_300.jpg';?>
                <a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>"><img src="<?php echo $picUrl;?>" width="180" height="180"/></a>
            </p>
            <p class="tRight">
            <?php if (!empty($value['Product']['discount'])):?>
                <span class="floatL">原价：<del>￥<?php echo $number->currency($value['Product']['retail_price'], '');?></del> 
                <em><?php echo round(($value['Product']['discount'])*10, 2);?>折</em> 
                </span>
            <?php endif;?>
            <?php if (!empty($value['GroupBuy']['inactive_flg']) || !$value['GroupBuy']['enable_sale'] || $value['GroupBuy']['end_time'] <= date('Y-m-d H:i:s') || $value['GroupBuy']['max_purchase_number'] <= $value['GroupBuy']['purchase_product_count']):?>
                <font class="orange"><?php __('info.groupBuySoldOut');?></font>
            <?php else:?>
                购买：<em><?php echo $value['GroupBuy']['purchase_person_count']+$value['GroupBuy']['base_purchase_person_count'];?>人</em>
            <?php endif;?>
            </p>
            <p class="buy">
                <span class="salePrice">￥<?php echo $number->currency($value['Product']['price_for_normal'], '');?></span>
            <?php /**
            <?php if ($value['GroupBuy']['max_purchase_number'] == $value['GroupBuy']['purchase_product_count']):?>
                <button type="button" class="btnImg btnNone"></button>
            <?php elseif (!$value['GroupBuy']['enable_sale'] || $value['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
            */?>
            <?php if (!empty($value['GroupBuy']['inactive_flg']) || $value['GroupBuy']['max_purchase_number'] <= $value['GroupBuy']['purchase_product_count']):?>
                <button type="button" class="btnImg btnNone"></button>
            <?php elseif (!$value['GroupBuy']['enable_sale'] || $value['GroupBuy']['end_time'] <= date('Y-m-d H:i:s')):?>
                <button type="button" class="btnImg btnStop"></button>
            <?php else:?>
                <button type="button" class="btnImg btnBuy" onclick="javaScript:addToBag('<?php echo $value['GroupBuy']['id'];?>', '<?php echo $value['GroupBuy']['product_cd']?>');"></button>
                <button type="button" class="btnImg btnDetail" onclick="javaScript:redirect('<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>');"></button>
            <?php endif;?>
            </p>
        <?php if (!$value['GroupBuy']['inactive_flg'] && $value['GroupBuy']['enable_sale'] && $value['GroupBuy']['max_purchase_number'] > $value['GroupBuy']['purchase_product_count'] && $value['GroupBuy']['end_time'] > date('Y-m-d H:i:s')):?>
            <p class="tRight remainTime" endtime="<?php echo date('Y/m/d H:i:s', strtotime($value['GroupBuy']['end_time']));?>"><?php echo getRemainTime($value['GroupBuy']['end_time']);?></p>
        <?php endif;?>
        </li>
    <?php endforeach;?>
<?php endif;?>
</ul>
<div class="clear"></div>
<?php echo $this->element('common/pagination', array('model'=>'GroupBuy')); ?>
<!-- main end -->
<script type="text/javascript">
function addToBag(id, productCd) {
    $.get('/shopping/ajax_add_to_bag/', {
                id:id,
                product_cd:productCd,
                sale_method:'<?php echo SALE_METHOD_GROUP_BUY?>',
                order_amount:1
            }, function(rs){
                $(".groupOrder").append(rs);
            }
    );
}
</script>