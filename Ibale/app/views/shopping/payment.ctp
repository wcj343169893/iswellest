<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 填写订单信息';?>
<script type="text/javascript" src="/js/front/ajaxSubmit.js"></script>
<script type="text/javascript" src="/js/area.js"></script>
<div id="paymentMain">
<!-- main -->
<div class="<?php echo ($this->data['Shopping']['sale_method'] == 'gift')?'giftShopping':'shopping';?>Step2 m10">请填写申请表单</div>
<!--送货地址-->
<?php if ($this->data['Shopping']['sale_method'] == 'gift'):?>
<?php echo $this->element('shopping/gift_address_edit');?>
<?php else:?>
<h3 class="shoppingInfo">
    收货地址 <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/address/list">管理收货地址</a>
</h3>
<div id="addressList" class="shoppingContent">
<?php echo $this->requestAction('address/edit_for_shopping_payment');?>
</div>
<?php endif;?>
<?php echo $appForm->create('Shopping', array('id'=>'ShoppingPaymentForm', 'url'=>HTTPS_HOME_PAGE_URL.'/shopping/confirm'));?>
<?php if (!empty($giftInfo)):?>
<?php echo $appForm->hidden('Shopping.receive_person_email');?>
<?php echo $appForm->hidden('Shopping.receive_person_name');?>
<?php else:?>
<?php echo $appForm->hidden('Shopping.address');?>
<?php endif;?>
<?php echo $appForm->hidden('Shopping.shipto_name');?>
<?php echo $appForm->hidden('Shopping.shipto_zip');?>
<?php echo $appForm->hidden('Shopping.shipto_phone');?>
<?php echo $appForm->hidden('Shopping.shipto_address1');?>
<?php echo $appForm->hidden('Shopping.shipto_address2');?>
<?php echo $appForm->hidden('Shopping.shipto_address3');?>
<?php echo $appForm->hidden('Shopping.shipto_address4');?>
<?php echo $appForm->hidden('Shopping.bag_referer');?>
<?php if ($this->data['Shopping']['sale_method'] != 'gift'):?>
    <!--支付方式-->
    <h3 id="h3Paymentway" class="shoppingInfo">支付方式</h3>
    <div class="shoppingContent">
    <?php $appForm->data['Shopping']['charge_type'] = !empty($appForm->data['Shopping']['charge_type'])?$appForm->data['Shopping']['charge_type']:CHARGE_TYPE_ALIPAY;?>
    <?php $disabledCod     = ($this->data['Shopping']['sale_method'] == SALE_METHOD_PAID_BY_OTHER)?true:false;?>
    <?php $disabledPaySelf = ($this->data['Shopping']['sale_method'] == SALE_METHOD_PAID_BY_OTHER)?true:false;?>
        <p>
            <?php echo $appForm->radio('Shopping.charge_type', array(CHARGE_TYPE_ALIPAY=>$msts['charge_type'][CHARGE_TYPE_ALIPAY]), array('class' => 'noBorder',  'legend' => false, 'seperator'=>'span'));?>
            <img src="/image/front/alipay2.jpg" style="padding-left:3px;vertical-align: middle; margin: 0px;"/>
        </p>
        <?php echo $appForm->hidden('payself', array('value' => ACTIVE_FLG_TRUE));?>
        <?php /**
        <p>
        <?php if ($appForm->data['Shopping']['charge_type'] == CHARGE_TYPE_ALIPAY && (!isset($appForm->data['Shopping']['payself']) || '' == $appForm->data['Shopping']['payself'])):?>
            <?php $appForm->data['Shopping']['payself'] = ACTIVE_FLG_TRUE;?>
        <?php endif;?>
            <span class="p_35_l"><?php echo $appForm->radio('Shopping.payself', array(ACTIVE_FLG_TRUE=>$msts['payself'][ACTIVE_FLG_TRUE]), array('class' => 'noBorder',  'legend' => false, 'seperator'=>'span', 'disabled'=>$disabledPaySelf));?></span>
        </p>
        <p>
            <span class="p_35_l"><?php echo $appForm->radio('Shopping.payself', array(ACTIVE_FLG_FALSE=>$msts['payself'][ACTIVE_FLG_FALSE]), array('class' => 'noBorder',  'legend' => false, 'seperator'=>'span'));?></span>
        </p>
        <p id="alipayPayPersonMail" class="display-none">
            <span class="w_120 p_35_l">支付者E-Mail：</span>
            <?php echo $appForm->text('Shopping.pay_person_email', array('class'=>'w_210'));?>
            <?php echo $appForm->error('Order.pay_person_email', '支付者E-Mail');?>
        </p>
        */?>
        <?php /**
        <p id="alipayRelationToPayer" class="display-none">
            <span class="w_120 p_35_l">与支付者的关系：</span>
            <?php echo $appForm->select('Shopping.relation_to_payer', $msts['relation_to_payer'], null, array('empty'=>__('label.pleaseSelect', true)));?>
            <?php echo $appForm->error('Order.relation_to_payer', '与支付者的关系');?>
        </p>
        */?>
        <p id="alipayMessageToPayPerson" class="display-none">
            <span class="w_120 p_35_l">留言：</span>
            <?php echo $appForm->text('Shopping.message_to_pay_person', array('class'=>'w_540'));?>
            <?php echo $appForm->error('Order.message_to_pay_person', '留言');?>
        </p>
        <p>
            <?php echo $appForm->radio('Shopping.charge_type', array(CHARGE_TYPE_COD=>$msts['charge_type'][CHARGE_TYPE_COD]), array('class' => 'noBorder',  'legend' => false, 'seperator'=>'span', 'disabled'=>$disabledCod));?>
        </p>
    <?php if ($appSession->check('Message.maxOrderPriceOverflow')):?>
        <p class="message" style="padding-left:10px;"><?php echo $appSession->flash('maxOrderPriceOverflow', false);?></p>
    <?php endif;?>
    </div>
<?php if (empty($giftInfo)):?>
    <!--优惠方式-->
    <h3 id="h3Coupon" class="shoppingInfo">优惠方式</h3>
    <div class="shoppingContent">
        <p style="line-height:21px;padding:3px;">
            <span class="w_90">优惠券编号：</span>
            <span>
                <?php echo $appForm->text('Shopping.coupon_code', array('class'=>'w_150'));?>
                <button type="button" class="btnImg btnConfirm_s" onclick="javaScript:reCalcPrice();"></button>
                <label class="error-message" style="padding-left:10px">
                <?php echo $appForm->error('Order.coupon_code', '优惠券编号', array('wrap'=>false));?>
                <?php echo $appSession->flash('couponInvalid', false);?>
                </label>
            </span>
        </p>
        <p style="line-height:21px;padding:3px;">
            <span class="w_90">使用积分：</span>
            <span>
            <?php if (!empty($pointInfo['points'])):?>
                <?php echo $appForm->text('Shopping.point_used', array('class'=>'w_150'));?>
                <button type="button" class="btnImg btnConfirm_s" onclick="javaScript:reCalcPrice();"></button>&nbsp;&nbsp;&nbsp;
            <?php endif;?>
                <span class="f_14_b ">您现在可用的积分为：<?php echo $pointInfo['points'];?>&nbsp;&nbsp;有效期截止：<?php echo $pointInfo['expiredate'];?></span>
                <?php echo $appSession->flash('pointInvalid');?>
            </span>
        </p>
    </div>
<?php endif;?>
    <h3 id="h3Other" class="shoppingInfo">其他信息</h3>
    <div class="shoppingContent">
        <p style="line-height:21px;padding:3px;">
            <span class="w_90">发票信息</span>
            <span class="w_90">
            <?php echo $appForm->checkBox('Shopping.fapiao_flg', array('value'=>ACTIVE_FLG_TRUE, 'class'=>'noBorder'));?> 要发票
            </span>
            <span id="fapiaoLabel" style="display:none;">发票抬头</span>
            <?php echo $appForm->text('fapiao_name', array('id' => 'fapiaoName', 'class'=>'w_150 display-none'));?>
            <label class="error-message" style="padding-left:15px;"><?php echo $appForm->error('Order.fapiao_name', '发票抬头', array('wrap'=>false));?></label>
        </p>
        <?php echo $appForm->hidden('gift_type_flg', array('value' => ACTIVE_FLG_FALSE));?>
        <?php /**
        <p>
            <span class="w_90">赠送包装</span>
            <?php $appForm->data['Shopping']['gift_type_flg'] = !empty($appForm->data['Shopping']['gift_type_flg'])?$appForm->data['Shopping']['gift_type_flg']:ACTIVE_FLG_FALSE;?>
            <?php echo $appForm->radio('Shopping.gift_type_flg', $msts['need'], array('class'=>'noBorder', 'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));?>
            &nbsp;&nbsp;<?php echo $appForm->select('Shopping.gift_type', $msts['gift_type'], null, array('empty' => __('label.pleaseSelect', true)));?>
            <label class="error-message" style="padding-left:15px;"><?php echo $appForm->error('Order.gift_type', '包装', array('wrap'=>false));?></label>
        <?php if (!empty($appForm->data['Shopping']['gift_type']) && !empty($orderInfo['orders'][0]['gift_charge'])):?>
            <span class="orange p_15_l">※包装费用需要￥<?php echo $orderInfo['orders'][0]['gift_charge'];?></span>
        <?php endif;?>
        </p>
        <ul class="packing clearfix">
        <?php foreach($msts['gift_type'] as $key => $value):?>
            <li><?php echo $value;?><img src="/image/front/<?php echo $key;?>_90_60.jpg" /></li>
        <?php endforeach;?>
        </ul>
        */?>
    </div>
<?php endif;?>
<h3 class="shoppingInfo">商品信息</h3>
<?php //$orderInfo['orders'][1] = $orderInfo['orders'][0];?>
<?php //$this->set('orderInfo', $orderInfo);?>
<?php foreach($orderInfo['orders'] as $key => $value):?>
    <?php if (count($orderInfo['orders']) > 1):?>
    <div class="shoppingInfo2">包裹<?php echo $key+1;?><?php if ($key > 0):?><label class="orange" style="padding-left:15px;">※以下商品暂无库存，到货后我们将立即安排配送。</label><?php endif;?></div>
    <?php endif;?>
    <?php $this->set('productList', $value);?>
    <?php echo $this->element('shopping/product_list');?>
<?php endforeach;?>
<?php echo $this->element('shopping/product_total');?>
<div class="shoppingBtn m_10_b clearfix">
    <?php //<span>请核对以上信息，确认无误后点击"订单确认"</span> ?>
    <button type="button" class="btnImg btnOrder" onclick="javaScirpt:confirmPayment();"></button>
    <button type="button" class="btnImg btnRecart" onclick="javaScirpt:backToBag();"></button>
</div>
<div id="addressHidden" class="display-none"></div>
<?php echo $appForm->end();?>
<script language="Javascript">
function ctrlPayself() {
    var obj = $("input[name='data[Shopping][payself]']:checked");
    if (obj.val() == '<?php echo ACTIVE_FLG_FALSE;?>') {
        $("p[id^='alipay']").show();
        $("input[name='data[Shopping][pay_person_email]']").attr('disabled', false);
        $("input[name='data[Shopping][message_to_pay_person]']").attr('disabled', false);
    } else {
        $("p[id^='alipay']").hide();
        $("input[name='data[Shopping][pay_person_email]']").val('');
        $("input[name='data[Shopping][message_to_pay_person]']").val('');
        $("input[name='data[Shopping][pay_person_email]']").attr('disabled', true);
        $("input[name='data[Shopping][message_to_pay_person]']").attr('disabled', true);
    }
}
function ctrlFapiao() {
    var obj = $("input[name='data[Shopping][fapiao_flg]']:checked");
    if (obj.attr('checked') == 'checked') {
        $("#fapiaoLabel").show();
        $("#fapiaoName").show();
        $("input[name='data[Shopping][fapiao_name]']").attr('disabled', false);
    } else {
        $("#fapiaoLabel").hide();
        $("#fapiaoName").hide();
        $("input[name='data[Shopping][fapiao_name]']").attr('disabled', true);
        $("#fapiaoLabel").parent().find(".error-message").hide();
    }
}
function ctrlGiftType() {
    var obj = $("input[name='data[Shopping][gift_type_flg]']:checked");
    if (obj.val() == '<?php echo ACTIVE_FLG_FALSE;?>') {
        $("#ShoppingGiftType").val('');
        $("#ShoppingGiftType").attr('disabled', true);
    } else {
        $("#ShoppingGiftType").attr('disabled', false);
    }
}
function reCalcPrice() {
    $("#wait").css('height', $('body').css('height'));
    $("#wait").css('width', $('body').css('width'));
    $("#wait").show();
    loadAddress();
    $("#ShoppingPaymentForm").attr('action', '<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/ajax_reload_payment/');
    ajaxSubmit('paymentMain', 'hiddenForAjaxSubmit', 'ShoppingPaymentForm');
}
function backToBag() {
<?php if (!empty($this->data['Shopping']['bag_referer'])):?>
    redirect('<?php echo $this->data['Shopping']['bag_referer'];?>');
<?php else:?>
    redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/bag/');
<?php endif;?>
}
function loadAddress() {
<?php if (!empty($giftInfo)):?>
    $("#ShoppingReceivePersonEmail").val($("#AddressReceivePersonEmail").val());
    $("#ShoppingReceivePersonName").val($("#AddressReceivePersonName").val());
    $("#ShoppingShiptoName").val($("#AddressName").val());
    $("#ShoppingShiptoZip").val($("#AddressZip").val());
    $("#ShoppingShiptoPhone").val($("#AddressPhone").val());
    $("#ShoppingShiptoAddress1").val($("#address1 :selected").val());
    $("#ShoppingShiptoAddress2").val($("#address2 :selected").val());
    $("#ShoppingShiptoAddress3").val($("#address3 :selected").val());
    $("#ShoppingShiptoAddress4").val($("#AddressAddress4").val());
    $("[name^='data[Address]']").each(function(){
        cloneFormElement($(this), 'addressHidden');
    });
<?php else:?>
    var checkedValue = $("input[name='data[Shopping][address]']:checked").val();
    $("#ShoppingAddress").val(checkedValue);
    $("#ShoppingShiptoName").val($("#ShoppingName"+checkedValue).val());
    $("#ShoppingShiptoZip").val($("#ShoppingZip"+checkedValue).val());
    $("#ShoppingShiptoPhone").val($("#ShoppingPhone"+checkedValue).val());
    $("#ShoppingShiptoAddress1").val($("#ShoppingAddress1"+checkedValue).val());
    $("#ShoppingShiptoAddress2").val($("#ShoppingAddress2"+checkedValue).val());
    $("#ShoppingShiptoAddress3").val($("#ShoppingAddress3"+checkedValue).val());
    $("#ShoppingShiptoAddress4").val($("#ShoppingAddress4"+checkedValue).val());
<?php endif;?>
}
function confirmPayment() {
    loadAddress();
    submitForm('ShoppingPaymentForm');
}
$(function(){
    $("input[name='data[Shopping][payself]']").click(function(){
        $("#ShoppingChargeTypeALIPAY").attr("checked", true);
        ctrlPayself();
    });
    $("input[name='data[Shopping][fapiao_flg]']").click(function(){
        ctrlFapiao();
    });
    $("input[name='data[Shopping][gift_type_flg]']").click(function(){
        ctrlGiftType();
        if ($(this).val() == '<?php echo ACTIVE_FLG_FALSE;?>') {
            reCalcPrice();
        }
    });
    $("input[name='data[Shopping][address]']").click(function(){
        reCalcPrice();
    });
    $("input[name='data[Shopping][charge_type]']").change(function(){
        if ($(this).val() == '<?php echo CHARGE_TYPE_COD;?>') {
            $("#ShoppingPayself0").attr('checked', false);
            $("#ShoppingPayself1").attr('checked', false);
            ctrlPayself();
        }
        reCalcPrice();
    });
    $("#ShoppingGiftType").change(function(){
        reCalcPrice();
    });
});
ctrlPayself();
ctrlFapiao();
ctrlGiftType();
</script>
</div>
<!-- main end -->