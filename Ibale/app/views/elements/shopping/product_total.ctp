<!-- 合计信息 -->
<?php $productSubtotalTotal  = 0;?>
<?php $shippingChargeTotal   = 0;?>
<?php $codChargeTotal        = 0;?>
<?php $discountTotal         = 0;?>
<?php $saleDiscountTotal     = 0;?>
<?php $claimSubtotalTotal    = 0;?>
<?php $discountSubtotalTotal = 0;?>
<?php $giftChargeTotal = 0;?>
<?php $pointUsedTotal = 0;?>
<?php $couponDiscountTotal = 0;?>
<?php if ($this->name == 'Order' && $this->action == 'detail'):?>
        <?php $productSubtotalTotal  += $productList['product_subtotal'];?>
        <?php $shippingChargeTotal   += $productList['shipping_charge'];?>
        <?php $codChargeTotal        += $productList['cod_charge'];?>
        <?php $discountTotal         += $productList['discount'];?>
        <?php $saleDiscountTotal     += $productList['sale_discount'];?>
        <?php $claimSubtotalTotal    += $productList['claim_subtotal'];?>
        <?php $discountSubtotalTotal += $productList['discount_subtotal'];?>
        <?php $giftChargeTotal       += $productList['gift_charge'];?>
        <?php $pointUsedTotal        += $productList['point_used'];?>
        <?php $couponDiscountTotal   += $productList['coupon_discount'];?>
<?php else:?>
    <?php foreach($orderInfo['orders'] as $key => $value):?>
        <?php $productSubtotalTotal  += $value['product_subtotal'];?>
        <?php $shippingChargeTotal   += $value['shipping_charge'];?>
        <?php $codChargeTotal        += $value['cod_charge'];?>
        <?php $discountTotal         += $value['discount'];?>
        <?php $saleDiscountTotal     += $value['sale_discount'];?>
        <?php $claimSubtotalTotal    += $value['claim_subtotal'];?>
        <?php $discountSubtotalTotal += $value['discount_subtotal'];?>
        <?php $giftChargeTotal       += $value['gift_charge'];?>
        <?php $pointUsedTotal        += $value['point_used'];?>
        <?php $couponDiscountTotal   += $value['coupon_discount'];?>
    <?php endforeach;?>
<?php endif;?>
<div class="balanceInfo clearfix">
    <div class="shoppingTxt" style="<?php echo ($this->name == 'Order')?'width:500px;':'';?>">
    <?php if (($this->name != 'Shopping' && (!empty($pointUsedTotal) || !empty($couponDiscountTotal)))
                || (!empty($priceTypeFreeInfo) && $orderInfo['ordered_subtotal'] > $priceTypeFreeInfo['PriceType']['price'] && (empty($orderInfo['order_datetime']) || (!empty($orderInfo['order_datetime']) && strtotime($orderInfo['order_datetime']) >= strtotime($priceTypeFreeInfo['PriceType']['apply_start_date']))))
                || !empty($saleRuleList)):?>
        <?php //if (!empty($saleRuleList) 
                    //|| ($this->name == 'payment' && empty($giftInfo))):?>
        <div class="otherTxt">
        <?php if (!empty($saleRuleList) || !empty($priceTypeFreeInfo)):?>
            <div class="clearfix">
                <p class="eventTitle f_14_b">适用活动 ：</p>
                <ul class="eventInfo">
                <?php foreach($saleRuleList as $key => $value):?>
                    <li>※<?php echo $value['SaleRule']['display_string'];?></li>
                <?php endforeach;?>
                <?php if (!empty($priceTypeFreeInfo) && $orderInfo['ordered_subtotal'] > $priceTypeFreeInfo['PriceType']['price'] && (empty($orderInfo['order_datetime']) || (!empty($orderInfo['order_datetime']) && strtotime($orderInfo['order_datetime']) >= strtotime($priceTypeFreeInfo['PriceType']['apply_start_date'])))):?>
                <li>满<?php echo $number->currency($priceTypeFreeInfo['PriceType']['price'], '');?>元包邮</li>
                <?php endif;?>
                </ul>
            </div>
        <?php endif;?>
        <?php if ($this->name != 'Shopping' && !empty($couponDiscountTotal)):?>
            <p>
                <span class="f_14_b w_90">优惠券编号</span>
                <label><?php echo $orderInfo['coupon_code'];?></label>
            </p>
        <?php endif;?>
        <?php if ($this->name != 'Shopping' && !empty($pointUsedTotal)):?>
            <p>
                <span class="f_14_b w_90">使用积分</span>
                <label><?php echo $pointUsedTotal;?></label>
            </p>
        <?php endif;?>
        </div>
    <?php endif;?>
    </div>

    <div class="balancelTotal">
        产品金额共计：￥<?php echo $number->currency($productSubtotalTotal, '');?><br />
    <?php if (!empty($giftChargeTotal)):?>
        包装费用<?php if (count($orderInfo['orders']) > 1):?>共计<?php endif;?>：￥<?php echo $number->currency($giftChargeTotal, '');?><br />
    <?php endif;?> 
        运费<?php if (count($orderInfo['orders']) > 1):?>共计<?php endif;?>：￥<?php echo $number->currency($shippingChargeTotal, '');?><br />
    <?php if (!empty($codChargeTotal)):?>
        货到付款手续费<?php if (count($orderInfo['orders']) > 1):?>共计<?php endif;?>：￥<?php echo $number->currency($codChargeTotal, '');?><br />
    <?php endif;?> 
    <?php if (!empty($saleDiscountTotal)):?>
        活动减价共计：-￥<?php echo $number->currency($saleDiscountTotal, '');?><br />
    <?php endif;?> 
    <?php if (!empty($couponDiscountTotal)):?>
        优惠券：-￥<?php echo $number->currency($couponDiscountTotal, '');?><br />
    <?php endif;?>
    <?php if (!empty($pointUsedTotal)):?>
        积分：-￥<?php echo $number->currency($pointUsedTotal/100, '');?><br />
    <?php endif;?>
    <?php if (!empty($discountTotal)):?>
        其他减价共计：-￥<?php echo $number->currency($discountTotal, '');?><br />
    <?php endif;?> 
        <span>合计：<b>￥<?php echo $number->currency($claimSubtotalTotal, '');?></b></span>
<?php /**
    <?php if (!empty($discountSubtotalTotal)):?>
        <br/>(-￥<?php echo $number->currency($discountSubtotalTotal, '');?>)
    <?php endif;?>
*/?>
    </div>
</div>