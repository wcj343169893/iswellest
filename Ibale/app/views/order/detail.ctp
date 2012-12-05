<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 订单详细';?>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
    <!-- 左侧个人信息导航栏 -->
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:order');?>
    <!-- 左侧个人信息导航栏 end -->
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 订单信息 -->
<?php foreach($orderInfo['orders'] as $recordNum => $subOrder):?>
        <div class="tableTop">
            <span class="tableTitle">订单信息</span>
    <?php if ($recordNum == 0):?>
        <?php //出荷状態（Alipay：”未入金”、代引き：”未出荷”）の場合、取消ボタンを表示?>
        <?php if (($orderInfo['charge_type'] == CHARGE_TYPE_ALIPAY && $subOrder['shipping_status'] == SHIPPING_STATUS_NOTCREDITED) 
                || ($orderInfo['charge_type'] == CHARGE_TYPE_COD && in_array($subOrder['shipping_status'], array(SHIPPING_STATUS_NOTYET, SHIPPING_STATUS_SHIPPING, SHIPPING_STATUS_WAIT_ARRIVAL)))):?>
            <span class="tableStyle3"><a href="<?php HTTPS_HOME_PAGE_URL;?>/order/cancel_order/order_no:<?php echo $orderInfo['order_no'];?>">取消</a> </span>
        <?php endif;?>
        <?php if ($orderInfo['charge_type'] == CHARGE_TYPE_ALIPAY && $subOrder['shipping_status'] == SHIPPING_STATUS_NOTCREDITED):?>
            <span class="tableStyle2"><a href="<?php HTTPS_HOME_PAGE_URL;?>/shopping/post_to_alipay/order_no:<?php echo $orderInfo['order_no'];?>" target="_blank">付款</a> </span>
        <?php endif;?>
        <?php if (in_array($subOrder['shipping_status'], array(SHIPPING_STATUS_SHIPPING, SHIPPING_STATUS_WAIT_ARRIVAL, SHIPPING_STATUS_SHIPPED))):?>
            <span class="tableStyle4"><a href="<?php HTTPS_HOME_PAGE_URL;?>/order/return_edit/order_no:<?php echo $orderInfo['order_no'];?>">退款申请</a></span>
        <?php endif;?>
        <?php echo $this->element('order/paid_by_other_info');?>
        <?php echo $this->element('order/gift_receive_info');?>
    <?php endif;?>
        </div>
        <div class="clear"></div>
    <?php if($subOrder['order_type'] == ORDER_TYPE_REPAYMENT):?>
        <h3 class="logisticsInfo">退换货信息</h3>
    <?php endif;?>
        <div class="personalInfo m_10_b clearfix">
            <ul class="otherTxt width245">
                <li>订单编号： <?php echo $orderInfo['order_no'].'-'.$subOrder['record_num'];?></li>
                <li>订单日期： <?php echo substr($orderInfo['order_datetime'], 0, 19);?></li>
                <li>订单状态： <em><?php echo $msts['shipping_status'][$subOrder['shipping_status']];?></em></li>
                <li>支付方法： <?php echo $msts['charge_type'][$orderInfo['charge_type']];?>
                <?php $app->getExtradata($orderInfo, $extraData);?>
                <?php if ($extraData['sale_method'] == SALE_METHOD_PAID_BY_OTHER || ($extraData['pay_method'] == PAY_METHOD_PAID_BY_OTHER && $extraData['sale_method'] != SALE_METHOD_GIFT)):?>
                    <a href="javaScript:void(0);" onclick="javaScript:showPaidByOtherPop();return false;">第三方支付</a>
                <?php endif;?>
                </li>
                <li>订单类型： 
                <?php $orderType=$app->getOrderTypeDesc($orderInfo);?>
                <?php echo $orderType;?>
                <?php if ($extraData['sale_method'] == SALE_METHOD_GIFT):?>
                    <a href="javaScript:void(0);" onclick="javaScript:showGiftReceiveInfoPop();return false;">送给TA</a>
                <?php endif;?>
                </li>
                <li>
                总　　价： <em>￥<?php echo $number->currency($subOrder['claim_subtotal'], '');?></em></li>
            </ul>
            <div class="clear" style="padding-top:10px;"></div>
            <!-- 商品信息 -->
            <h3 class="shoppingInfo">商品信息</h3>
        <?php if (count($orderInfo['orders']) > 1):?>
            <h3 class="shoppingInfo2" style="padding:0px 15px;">包裹<?php echo $recordNum+1;?><?php if ($recordNum > 0):?><label class="orange" style="padding-left:15px;">※以下商品暂无库存，到货后我们将立即安排配送。</label><?php endif;?></h3>
        <?php endif;?>
            <?php //注文状態が、出荷準備中、または出荷済み、または配送完了の場合?>
        <?php //if (count($orderInfo['orders']) > 1):?>
            <!-- <div class="shoppingInfo2">购物商品<?php echo $subOrder['record_num'];?></div> -->
        <?php //endif;?>
        <?php $this->set('recordNum', $subOrder['record_num']);?>
        <?php $this->set('productList', $subOrder);?>
        <?php echo $this->element('shopping/product_list');?>
        <?php echo $this->element('shopping/product_total');?>
            <!-- 物流信息 -->
            <h3 class="logisticsInfo">收货人信息</h3>
            <div class="logisticsTxt">收件人：<?php echo $appHtml->html($orderInfo['shipto_name']);?><span class="p_35_l"><?php echo $appHtml->html($areaList[$orderInfo['shipto_address1']]);?> <?php echo $appHtml->html($areaList[$orderInfo['shipto_address2']]);?> <?php echo $appHtml->html($areaList[$orderInfo['shipto_address3']]);?> <?php echo $appHtml->html($orderInfo['shipto_address4']);?> <?php echo $orderInfo['shipto_phone']?></span></div>
            <h3 class="logisticsInfo">其他信息</h3>
            <div class="logisticsTxt">
                <span class="w_70">发票信息：</span>
            <?php if ($orderInfo['fapiao_flg'] == ACTIVE_FLG_TRUE):?>
                <span class="p_35_l">
                <?php echo $msts['need'][ACTIVE_FLG_TRUE];?>
                </span>
                <span class="p_35_l">
                发票抬头：<?php echo $appHtml->html($orderInfo['fapiao_name']);?>
                </span>
            <?php else:?>
                <span class="p_35_l">
                <?php echo $msts['need'][ACTIVE_FLG_FALSE];?>
                </span>
            <?php endif;?>
            <?php /**
                <br>
                <span class="w_70">赠送包装：</span>
                 <?php if ($orderInfo['gift_type'] != GIFT_TYPE_NONE):?>
                <span class="p_35_l">
                    <?php echo $msts['need'][ACTIVE_FLG_TRUE];?>
                </span>
                <span class="p_35_l">
                    <?php echo $msts['gift_type'][$orderInfo['gift_type']];?>
                </span>
                <span class="p_35_l">
                    包装费用<font class="orange"><?php echo $number->currency($subOrder['gift_charge'], '￥');?></font>
                </span>
                <?php else:?>
                <span class="p_35_l">
                    <?php echo $msts['need'][ACTIVE_FLG_FALSE];?>
                </span>
                <?php endif;?>
            */?>
            </div>
        </div>
<?php endforeach;?>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->