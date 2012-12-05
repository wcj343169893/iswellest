<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 确认订单';?>
<?php $this->noHeaderMenu = true;?>
<?php $this->noFooterLink = true;?>
<?php echo $appForm->create('Shopping', array('id'=>'ShoppingCompleteForm', 'url'=>HTTPS_HOME_PAGE_URL.'/shopping/create_order'));?>
<?php echo $appForm->hidden('bag_referer');?>
<?php echo $appForm->hidden('Shopping.back_to_payment', array('value'=>false));?>
<!-- main -->
<div class="<?php echo !empty($giftInfo)?'giftShopping':'shopping';?>Step3 m10">确认订单</div>
<?php if (!empty($giftInfo)):?>
<h3 class="shoppingInfo">付款人邮件地址</h3>
<div class="shoppingContent">
    <p>
        <span class="w_170">付款人邮箱地址：</span><?php echo $appHtml->html($this->data['Address']['pay_person_email']);?><span class="w_70 p_35_l">付款人：</span><?php echo $appHtml->html($this->data['Address']['pay_person_name']);?>
    </p>
    <p>
        <span class="w_170">您收到选礼物邮件的邮箱地址：</span><?php echo $appHtml->html($this->data['Address']['receive_person_email']);?><span class="w_70 p_35_l">您的姓名：</span><?php echo $appHtml->html($this->data['Address']['receive_person_name']);?>
    </p>
</div>
<?php endif;?>
<!--送货地址-->

<h3 class="shoppingInfo">收货人地址<span class="shoppingInfoModify"><a href="javascript:void(0);" onclick="javascript:return modifyPayment('address');">修改</a></span></h3>
<div class="shoppingContent">
    <p>
        <span class="w_90">收件人:</span><span class=""><?php echo $appHtml->html($this->data['Shopping']['shipto_name'])?></span><span class="p_35_l"><?php echo $this->data['Shopping']['shipto_zip']?>&nbsp;&nbsp;<?php echo $appHtml->html($areaList[$this->data['Shopping']['shipto_address1']]);?> <?php echo $appHtml->html($areaList[$this->data['Shopping']['shipto_address2']])?> <?php echo $appHtml->html($areaList[$this->data['Shopping']['shipto_address3']]);?> <?php echo $appHtml->html($this->data['Shopping']['shipto_address4']);?>&nbsp;&nbsp;<?php echo $this->data['Shopping']['shipto_phone']?></span>
        <?php echo $appForm->hidden('Shopping.address');?>
        <?php echo $appForm->hidden('Shopping.name');?>
        <?php echo $appForm->hidden('Shopping.address1');?>
        <?php echo $appForm->hidden('Shopping.address2');?>
        <?php echo $appForm->hidden('Shopping.address3');?>
        <?php echo $appForm->hidden('Shopping.address4');?>
        <?php echo $appForm->hidden('Shopping.zip');?>
        <?php echo $appForm->hidden('Shopping.phone');?>
    </p>
</div>
<?php if (empty($giftInfo)):?>
<!--支付方式-->
<h3 class="shoppingInfo">支付方式<span class="shoppingInfoModify"><a href="javascript:void(0);" onclick="javascript:return modifyPayment('paymentway');">修改</a></span></h3>
<div class="shoppingContent">
    <p>
        <?php echo $msts['charge_type'][$this->data['Shopping']['charge_type']];?>
    <?php if (isset($this->data['Shopping']['payself']) && $this->data['Shopping']['payself'] == ACTIVE_FLG_FALSE):?>
        <span class="p_35_l">支付者E-MAIL：<?php echo $appHtml->html($this->data['Shopping']['pay_person_email']);?></span>
        <span class="p_35_l"><?php echo $appHtml->html($this->data['Shopping']['message_to_pay_person']);?></span>
    <?php endif;?>
    </p>
</div>
<?php if (empty($giftInfo)):?>
<!-- 优惠方式 -->
<h3 class="shoppingInfo">优惠方式<span class="shoppingInfoModify"><a href="javascript:void(0);" onclick="javascript:return modifyPayment('coupon');">修改</a></span></h3>
<div class="shoppingContent">
    <p>
        <span class="w_90">优惠券编号:</span><span class=""><?php echo !empty($this->data['Shopping']['coupon_code'])?$appHtml->html($this->data['Shopping']['coupon_code']):'';?></span>
    </p>
    <p>
        <span class="w_90">使用积分:</span><span class=""><?php echo !empty($this->data['Shopping']['point_used'])?$appHtml->html($this->data['Shopping']['point_used']):'';?></span>
    </p>
</div>
<?php endif;?>
<!--其他信息-->
<h3 class="shoppingInfo">其他信息<span class="shoppingInfoModify"><a href="javascript:void(0);" onclick="javascript:return modifyPayment('other');">修改</a></span></h3>
<div class="shoppingContent">
    <p>
        <span class="w_90">发票信息</span>
        <span class="w_70"><?php echo $msts['need'][$this->data['Shopping']['fapiao_flg']];?></span>
    <?php if ($this->data['Shopping']['fapiao_flg'] == ACTIVE_FLG_TRUE):?>
        发票抬头：<?php echo $appHtml->html($this->data['Shopping']['fapiao_name']);?>
    <?php endif;?>
    </p>
<?php /**
    <p>
        <span class="w_90">赠送包装</span>
        <span class="w_70"><?php echo $msts['need'][$this->data['Shopping']['gift_type_flg']];?></span>
    <?php if ($this->data['Shopping']['gift_type_flg'] == ACTIVE_FLG_TRUE):?>
        <?php echo $msts['gift_type'][$this->data['Shopping']['gift_type']]?><span class="orange p_15_l">※包装费用需要￥<?php echo $orderInfo['orders'][0]['gift_charge']?></span>
    <?php endif;?>
    </p>
*/?>
</div>
<?php endif;?>
<h3 class="shoppingInfo">商品信息</h3>
<?php foreach($orderInfo['orders'] as $key => $value):?>
    <?php if (count($orderInfo['orders']) > 1):?>
    <div class="shoppingInfo2">包裹<?php echo $key+1;?><?php if ($key > 0):?><label class="orange" style="padding-left:15px;">※以下商品暂无库存，到货后我们将立即安排配送。</label><?php endif;?></div>
    <?php endif;?>
    <?php $this->set('productList', $value);?>
    <?php echo $this->element('shopping/product_list');?>
<?php endforeach;?>
<?php echo $this->element('shopping/product_total');?>
<?php if (!empty($giftProductList)):?>
<h3 class="shoppingInfo noneborder">礼品信息</h3>
<div class="shoppingContent">
    <?php $appForm->data['Shopping']['need_gift_flg'] = isset($appForm->data['Shopping']['need_gift_flg'])?$appForm->data['Shopping']['need_gift_flg']:ACTIVE_FLG_TRUE;?>
    <?php echo $appForm->radio('Shopping.need_gift_flg', $msts['need'], array('class'=>'noBorder', 'legend' => false));?>
</div>
<table cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <th>商品</th>
            <th>名称</th>
            <!-- <th width="80">错误信息</th> -->
            <th width="80">市场价格</th>
            <th width="80">商城价格</th>
            <th>赠送积分</th>
            <th>数量</th>
            <th>商品总价</th>
        </tr>
    <?php foreach($giftProductList as $key => $value):?>
        <?php $picUrl = !empty($value['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$value['ProductPhoto'][0]['url']:'/image/front/none_90.jpg';?>
        <tr>
            <td><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['Product']['product_cd'];?>"><img src="<?php echo $picUrl;?>" width="60" height="60" /></a></td>
            <td><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['Product']['product_cd'];?>"><?php echo $value['Product']['product_name'];?></a></td>
            <!-- <td><em></em></td> -->
            <td>￥0.00</td>
            <td>￥0.00</td>
            <td>0</td>
            <td>1 件</td>
            <td>￥0.00</td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>
<div class="shoppingBtn m_10_b clearfix">
<?php $orderInfo['ordered_subtotal'] = floatval($orderInfo['ordered_subtotal']);?>
<?php if (!empty($loadFromUrl) && $appSession->check('Message.orderPayDateExpired')):?>
    <p class="message" style="width:500px;"><?php echo $appSession->flash('orderPayDateExpired', false);?></p>
<?php elseif (!empty($loadFromUrl) && !$appSession->check('Message.orderPayDateExpired')):?>
    <?php if (!empty($orderInfo['ordered_subtotal'])):?>
        <span>请核对以上信息，确认无误后点击"立即支付"。</span>
        <button type="button" class="btnImg btnPayment" onclick="javaScirpt:redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/post_to_alipay');"></button>
    <?php else:?>
        购物金额等于￥0，不需要支付！
    <?php endif;?>
<?php else:?>
    <span>请核对以上信息，确认无误后请点击"立即支付"或"提交订单"。</span>
    <button type="button" class="btnImg <?php if (isset($this->data['Shopping']['charge_type']) && $this->data['Shopping']['charge_type'] == CHARGE_TYPE_ALIPAY && $this->data['Shopping']['payself'] == ACTIVE_FLG_TRUE && empty($giftInfo) && !empty($orderInfo['ordered_subtotal'])):?>btnPayment<?php else:?>btnOrders<?php endif;?>" onclick="javaScirpt:createOrder();"></button>
    <?php /*<button type="button" class="btnImg btnRecart" onclick="javaScirpt:backToBag();"></button>*/?>
<?php endif;?>
</div>
<!-- main end -->
<?php echo $appForm->end();?>
<script type="text/javascript">
function backToBag() {
<?php if (!empty($this->data['Shopping']['bag_referer'])):?>
    redirect('<?php echo $this->data['Shopping']['bag_referer'];?>');
<?php else:?>
    redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/bag/');
<?php endif;?>
}
function createOrder() {
    submitForm('ShoppingCompleteForm');
}
function modifyPayment(type) {
    var anchor = 'addressList';
    if (type == 'address') {
        anchor = 'addressList';
    } else if (type == 'paymentway') {
        anchor = 'h3Paymentway';
    } else if (type == 'coupon') {
        anchor = 'h3Coupon';
    } else {
        anchor = 'h3Other';
    }
    $("#ShoppingCompleteForm").attr("action", "<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/payment#"+anchor);
    $("#ShoppingBackToPayment").val(true);
    submitForm('ShoppingCompleteForm');
    return false;
}
</script>