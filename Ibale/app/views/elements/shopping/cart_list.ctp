<script src="/js/front/common.js" type="text/javascript"></script>
<?php if (!empty($redirectUrl)):?>
<p id="redirectUrl"><?php echo $redirectUrl;?></p>
<?php endif;?>
<?php echo $appForm->create('Shopping', array('id'=>'ShoppingBagForm', 'url'=>HTTPS_HOME_PAGE_URL.'/shopping/ajax_to_payment'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('mode');?>
<?php echo $appForm->hidden('bag_referer');?>
<?php echo $appForm->hidden('sale_method');?>
<?php /**
<?php if (!empty($saleRuleList) || !empty($priceTypeFreeInfo)):?>
<div class="shoppingNotes clearfix">
    <div class="otherTxt">
        <div class="clearfix">
            <p class="eventTitle f_14_b">适用活动 ：</p>
            <ul class="eventInfo" style="padding:5px 0px;">
            <?php foreach($saleRuleList as $key => $value):?>
                <li>※<?php echo $value['SaleRule']['display_string'];?></li>
            <?php endforeach;?>
            <?php if (!empty($priceTypeFreeInfo)):?>
                <li>满<?php echo $number->currency($priceTypeFreeInfo['PriceType']['price'], '');?>元包邮</li>
            <?php endif;?>
            </ul>
        </div>
    </div>
</div>
<?php endif;?>
*/?>
<table cellpadding="0" cellspacing="0" class="m_10" id="shoppingBag">
    <tbody>
        <tr>
            <th width="80" class="center">商品</th>
            <th>名称</th>
            <!--<th width="180">错误信息</th>-->
            <!--<th width="80">市场价格</th>-->
            <th width="80">商城价格</th>
            <th width="120">数量</th>
            <th width="120">商品总价</th>
            <th width="40"></th>
        </tr>
<?php $totalCount = 0;?>
<?php $totalAmount = 0;?>
<?php $diffSaleTotalAmount = 0;?>
<?php if (!empty($this->data['Shopping']['product_info_list'])):?>
    <?php foreach($this->data['Shopping']['product_info_list'] as $key => $value):?>
        <?php if (!empty($value['bonus_flg'])):?>
            <?php continue;?>
        <?php endif;?>
        <?php $productInfo = $productInfos[$value['product_cd']];?>
        <?php $totalCount += $this->data['Shopping']['product_info_list'][$key]['order_amount'];?>
        <?php $picUrl = (!empty($productInfo['ProductPhoto'][0]['url']))?OMS_API_PHOTO_ROOT_URL.$productInfo['ProductPhoto'][0]['url']:'/image/front/none_90.jpg';?>
        <?php echo $appForm->hidden("Shopping.product_info_list.{$key}.product_cd");?>
        <?php //echo $appForm->hidden("Shopping.product_info_list.{$key}.sale_price");?>
        <?php //echo $appForm->hidden("Shopping.product_info_list.{$key}.retail_price");?>
        <?php //echo $appForm->hidden("Shopping.product_info_list.{$key}.point");?>
        <?php if (!empty($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == SALE_METHOD_GROUP_BUY):?>
            <?php $url = HTTP_HOME_PAGE_URL.'/group_buy/detail/id:'.$value['id'];?>
        <?php else:?>
        <?php $url = HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$value['product_cd'];?>
        <?php endif;?>
        <tr id="product_<?php echo $value['product_cd'];?>">
            <td class="center"><a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $picUrl;?>" width="60" height="60" /></a></td>
            <td>
                <a href="<?php echo $url;?>" target="_blank"><?php echo $productInfo['Product']['product_name'];?></a>
                <br>
                <?php $br = "";?>
                <?php if ($appSession->check('productSaleStatusStop'.$key.'.message') && $appSession->check('Message.productStockNotEnough'.$key.'.message')):?>
                    <?php $br = '<br>';?>
                <?php endif;?>
                <em><?php echo $appSession->flash('productSaleStatusStop'.$key);?></em>
                <?php echo $br;?>
                <em><?php echo $appSession->flash('productStockNotEnough'.$key);?></em>
            </td>
            <?php /**
            <td>
                <?php $br = '';?>
                <?php if ($appSession->check('productSaleStatusStop'.$key.'.message') && $appSession->check('Message.productStockNotEnough'.$key.'.message')):?>
                    <?php $br = '<br>';?>
                <?php endif;?>
                <em><?php echo $appSession->flash('productSaleStatusStop'.$key);?></em>
                <?php echo $br;?>
                <em><?php echo $appSession->flash('productStockNotEnough'.$key);?></em>
            </td>
            */?>
            <!-- 
            <td>￥<?php echo $number->currency(!empty($value['retail_price'])?$value['retail_price']:$value['sale_price'], '');?></td>
             -->
            <td>￥<?php echo $number->currency($value['sale_price'], '');?>
            <?php if($value['retail_price'] > $value['sale_price']):?>
            <!-- <br />(-￥<?php echo $number->currency($value['retail_price'] - $value['sale_price'], '');?>)
             -->
            <?php endif;?>
            </td>
            <td><label class="jian" onclick="javaScript:reduceOrderCount('<?php echo $key;?>');">　</label><?php echo $appForm->text("Shopping.product_info_list.{$key}.order_amount", array('class'=>'w_25', 'maxlength'=>'2', 'style'=>'ime-mode:disabled !important;', 'onkeydown'=>'javaScript:digitInput(this,event)', 'onchange'=>"javaScript:changeOrderCount('{$key}')"));?><label class="jia" onclick="javaScript:addOrderCount('<?php echo $key;?>');">　</label> 件 
            </td>
            <?php $orderAmount = $value['sale_price']*$this->data['Shopping']['product_info_list'][$key]['order_amount'];?>
            <?php $totalAmount += $orderAmount;?>
            <td>￥<label id="orderAmount<?php echo $key;?>"><?php echo $number->currency($orderAmount, '');?></label><br />
            <?php $diffSaleAmount = 0;?>
            <?php if($value['retail_price'] > $value['sale_price']):?>
            <?php $diffSaleAmount = ($value['retail_price'] - $value['sale_price'])*$this->data['Shopping']['product_info_list'][$key]['order_amount'];?>
            <!-- (-￥<label id="diffSaleAmount<?php echo $key;?>"><?php echo $number->currency($diffSaleAmount, '');?></label>)
            -->
            <?php endif;?>
            <?php $diffSaleTotalAmount += $diffSaleAmount;?>
            </td>
            <td><a href="javaScript:void(0);" onclick="javaScript:deleteCart('<?php echo $key;?>', '<?php echo $value['product_cd'];?>');return false;">删除</a></td>
        </tr>
    <?php if (!empty($bonusProductList[$value['product_cd']])):?>
        <tr id="bonus_product_<?php echo $value['product_cd'];?>" class="bonus">
            <td colspan="7">
            <font class="title bold orange">赠品：</font><font class="bold">(买即赠以下任一商品，抢完为止。)</font>
            <?php $seq = 0;?>
            <?php foreach($bonusProductList[$value['product_cd']] as $k => $bonusProductInfo):?>
                <?php if (empty($seq)):?>
                    <?php $totalCount++;?>
                <?php endif;?>
                <?php $className = "unselected"?>
                <?php if (empty($appForm->data['Shopping']['bonus_product_info_list'][$key]['product_cd'])):?>
                    <?php $appForm->data['Shopping']['bonus_product_info_list'][$key]['product_cd_bonus'] = $value['product_cd'];?>
                    <?php $appForm->data['Shopping']['bonus_product_info_list'][$key]['product_cd']       = $bonusProductInfo['Product']['product_cd'];?>
                    <?php $appForm->data['Shopping']['bonus_product_info_list'][$key]['product_name']     = $bonusProductInfo['Product']['product_name'];?>
                <?php endif;?>
                <?php if($appForm->data['Shopping']['bonus_product_info_list'][$key]['product_cd'] == $bonusProductInfo['Product']['product_cd']):?>
                    <?php $className = "selected"?>
                <?php endif;?>
                <div class="cursor_pointer" onclick="javascript:chooseBonus('<?php echo $key;?>', '<?php echo $value['product_cd'];?>', '<?php echo $bonusProductInfo['Product']['product_cd'];?>');">
                    <span class="bonus_select_img">
                    <img id="img_<?php echo $value['product_cd'];?>_<?php echo $bonusProductInfo['Product']['product_cd'];?>" class="<?php echo $className;?>" src="<?php echo !empty($bonusProductInfo['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$bonusProductInfo['ProductPhoto'][0]['url']:'/image/front/none_90.jpg'?>" onerror="this.src=/image/front/none_90.jpg" width="60" height="60"/>
                    </span>
                    <span id="product_name_<?php echo $value['product_cd'];?>_<?php echo $bonusProductInfo['Product']['product_cd'];?>" class="product_name"><?php echo $bonusProductInfo['Product']['product_name'];?></span>
                </div>
                <?php $seq++;?>
                <?php endforeach;?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_list.{$key}.product_cd_bonus");?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_list.{$key}.product_cd");?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_list.{$key}.product_name");?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_list.{$key}.bonus_flg", array('value' => ACTIVE_FLG_TRUE));?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_list.{$key}.order_amount", array('value' => '1'));?>
                <?php $br = '';?>
                <?php if ($appSession->check('productSaleStatusStopBonus'.$key.'.message') && $appSession->check('Message.productStockNotEnoughBonus'.$key.'.message')):?>
                    <?php $br = '<br>';?>
                <?php endif;?>
                <em><?php echo $appSession->flash('productSaleStatusStopBonus'.$key);?></em>
                <?php echo $br;?>
                <em><?php echo $appSession->flash('productStockNotEnoughBonus'.$key);?></em>
            </td>
        </tr>
    <?php endif;?>
    <?php endforeach;?>
    <?php if (!empty($bonusByPrice)):?>
        <tr id="price_bonus_product" class="bonus">
            <td colspan="7">
            <font class="title bold orange">赠品：</font><font class="bold">(买满</font>￥<font id="bonus_price" class="bold"><?php echo $number->currency($bonusPrice, '')?></font><font class="bold">即赠以下任一商品，抢完为止。)</font>
            <?php $seq = 0;?>
            <?php $totalCount++;?>
            <?php foreach($bonusByPrice as $k => $bonusProductInfo):?>
                <?php $className = "unselected"?>
                <?php if (empty($appForm->data['Shopping']['bonus_product_info_by_price']['product_cd'])):?>
                    <?php $appForm->data['Shopping']['bonus_product_info_by_price']['product_cd']       = $bonusProductInfo['Product']['product_cd'];?>
                    <?php $appForm->data['Shopping']['bonus_product_info_by_price']['product_name']     = $bonusProductInfo['Product']['product_name'];?>
                <?php endif;?>
                <?php if($appForm->data['Shopping']['bonus_product_info_by_price']['product_cd'] == $bonusProductInfo['Product']['product_cd']):?>
                    <?php $className = "selected"?>
                <?php endif;?>
                <div class="cursor_pointer" onclick="javascript:chooseBonus('', '', '<?php echo $bonusProductInfo['Product']['product_cd'];?>');">
                    <span class="bonus_select_img">
                    <img id="img_price_bonus_<?php echo $bonusProductInfo['Product']['product_cd'];?>" class="<?php echo $className;?>" src="<?php echo !empty($bonusProductInfo['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$bonusProductInfo['ProductPhoto'][0]['url']:'/image/front/none_90.jpg'?>" onerror="this.src=/image/front/none_90.jpg" width="60" height="60"/>
                    </span>
                    <span id="product_name_price_bonus_<?php echo $bonusProductInfo['Product']['product_cd'];?>" class="product_name"><?php echo $bonusProductInfo['Product']['product_name'];?></span>
                </div>
                <?php $seq++;?>
                <?php endforeach;?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_by_price.product_cd");?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_by_price.product_name");?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_by_price.bonus_flg", array('value' => ACTIVE_FLG_TRUE));?>
                <?php echo $appForm->hidden("Shopping.bonus_product_info_by_price.order_amount", array('value' => '1'));?>
                <?php $br = '';?>
                <?php $key = 0;?>
                <?php if ($appSession->check('productSaleStatusStopBonusByPrice'.$key.'.message') && $appSession->check('Message.productStockNotEnoughBonusByPrice'.$key.'.message')):?>
                    <?php $br = '<br>';?>
                <?php endif;?>
                <em><?php echo $appSession->flash('productSaleStatusStopBonusByPrice'.$key);?></em>
                <?php echo $br;?>
                <em><?php echo $appSession->flash('productStockNotEnoughBonusByPrice'.$key);?></em>
            </td>
        </tr>
    <?php endif;?>
<?php else:?>
        <tr><td colspan="8"><?php __('info.bagIsEmpty');?></td></tr>
<?php endif;?>
    </tbody>
</table>
<?php if (!empty($this->data['Shopping']['product_info_list'])):?>
<div class="shoppingCount">
    产品数量总计：<span class="orange"><label id="totalCount"><?php echo $totalCount;?></label>件</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;产品金额总计(不含运费)：<span class="orange">￥<label id="totalAmount"><?php echo $number->currency($totalAmount, '');?></label><?php /**if (!empty($diffSaleTotalAmount)):?>(-￥<label id="diffSaleTotalAmount"><?php echo $number->currency($diffSaleTotalAmount, '');?></label>)<?php endif;*/?></span>
</div>
<?php if ('1'=='2'):?>
<?php //if (!empty($enableDivide)):?>
<?php //if (!empty($enableDivide) 
        //|| (!(!empty($this->data['Shopping']['sale_method']) && in_array($this->data['Shopping']['sale_method'], array(SALE_METHOD_GIFT, SALE_METHOD_PAID_BY_OTHER))))
        //|| $appSession->check('Message.maxOrderPriceOverflow')):?>
<div class="shoppingNotes clearfix">
    <p class="leftTxt">
    <?php //if ($stockIsNotEnough || isset($this->data['Shopping']['wish_to_divide'])):?>
    <?php if (!empty($enableDivide)):?>
        <?php /*由于部分商品缺货，是否将库存不足的商品自动拆分， 商品按拆分后的子订单分开配送。<br />*/?>
    <?php endif;?>
    <?php if (!(!empty($this->data['Shopping']['sale_method']) && in_array($this->data['Shopping']['sale_method'] ,array(SALE_METHOD_GIFT, SALE_METHOD_PAID_BY_OTHER)))):?>
        <?php /**付款人：找人代付只能选择【支付宝】*/?>
    <?php endif;?>
    </p>
    <p class="rightInput">
    <?php if (!empty($enableDivide)):?>
        <?php //$appForm->data['Shopping']['wish_to_divide'] = isset($this->data['Shopping']['wish_to_divide'])?$this->data['Shopping']['wish_to_divide']:ACTIVE_FLG_TRUE;?>
        <?php //echo $appForm->radio('wish_to_divide', $msts['agree'], array('class'=>'noBorder', 'label' => true, 'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));?>
        <br />
    <?php endif;?>
    <?php if (!(!empty($this->data['Shopping']['sale_method']) && in_array($this->data['Shopping']['sale_method'] ,array(SALE_METHOD_GIFT, SALE_METHOD_PAID_BY_OTHER)))):?>
        
        <?php /**
        <?php $appForm->data['Shopping']['payself'] = isset($this->data['Shopping']['payself'])?$this->data['Shopping']['payself']:ACTIVE_FLG_TRUE;?>
        <?php echo $appForm->radio('payself', $msts['payself'], array('class'=>'noBorder', 'label' => true, 'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));?>
        */?>
        <?php echo $appForm->hidden('payself', array('value'=>ACTIVE_FLG_FALSE));?>
    <?php else:?>
        <?php echo $appForm->hidden('payself', array('value'=>ACTIVE_FLG_FALSE));?>
    <?php endif;?>
    </p>
</div>
<?php endif;?>
<?php echo $appForm->hidden('wish_to_divide', array('value' => ACTIVE_FLG_FALSE));?>
<?php echo $appForm->hidden('payself', array('value'=>ACTIVE_FLG_FALSE));?>
<div class="shoppingBtn clearfix">
    <button type="button" class="btnImg btnSettle" onclick="javaScript:ajaxSubmit('cartList', 'hiddenForAjaxSubmit', 'ShoppingBagForm');"></button>
    <button type="button" class="btnImg btnNext" onclick="javaScript:searchProduct();"></button>
</div>
<?php else:?>
<div class="shoppingBtn clearfix">
    <button type="button" class="btnImg btnNext" onclick="javaScript:searchProduct();"></button>
</div>
<?php endif;?>
<?php echo $appForm->end();?>
<?php if (!empty($dispLogin)):?>
<?php echo $this->element('member/login');?>
<?php endif;?>
<script type="text/javascript">
function deleteCart(key, productCd) {
    //$("tr[id^='bonus_product_"+productCd+"']").remove();
    $("#ShoppingBagForm").attr('action', '<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/delete_cart');
    $("#ShoppingId").val(key);
    submitForm('ShoppingBagForm');
}

function searchProduct() {
    redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/product/list');
}
//var validCount = false;
function reduceOrderCount(key) {
    var orderCountObj = $("input[name='data[Shopping][product_info_list]["+key+"][order_amount]']");
    var orderCount = orderCountObj.val();
    if (orderCount == '' || orderCount == 0) {
        return;
    }

    checkStock(key, -1);
}
function addOrderCount(key) {
    var orderCountObj = $("input[name='data[Shopping][product_info_list]["+key+"][order_amount]']");
    if (orderCountObj.val() == '') {
        orderCountObj.val('0');
    }
    checkStock(key, 1);
}
function changeOrderCount(key) {
    checkStock(key);
}
function checkStock(key, count) {
    $("#wait").css('height', $('body').css('height'));
    $("#wait").css('width', $('body').css('width'));
    $("#wait").show();
    var orderCountObj = $("input[name='data[Shopping][product_info_list]["+key+"][order_amount]']");
    if (count == undefined) {
        count = orderCountObj.val()*1;
    } else {
        orderCountObj.val(orderCountObj.val()*1 + count);
        if (orderCountObj.val()*1 == 99 && count == 1) {
            $("#wait").hide();
            return false;
        }
    }
    //validCount = false;
    $.get('/shopping/ajax_check_stock/', {
            product_cd:$("input[name='data[Shopping][product_info_list]["+key+"][product_cd]']").val(),
            order_amount:orderCountObj.val()
        }, function(rs){
            if (rs.length > 0) {
                //validCount = false;
                alert(rs);
            } else {
                //validCount = true;
            }

            ret = reCalculate();
            if (ret) {
                $("#wait").hide();
            }
        }
    );
}
function chooseBonus(key, productCd, bonusProductCd) {
    if (key != '') {
        $("img[id^='img_"+productCd+"']").removeClass('selected');
        $("img[id^='img_"+productCd+"']").addClass('unselected');
        $("#img_"+productCd+"_"+bonusProductCd).addClass('selected');
        $("#ShoppingBonusProductInfoList"+key+"ProductCd").val(bonusProductCd);
        $("#ShoppingBonusProductInfoList"+key+"ProductName").val($("#product_name_"+productCd+"_"+bonusProductCd).text());
    } else {
        $("img[id^='img_price_bonus']").removeClass('selected');
        $("img[id^='img_price_bonus']").addClass('unselected');
        $("#img_price_bonus_"+bonusProductCd).addClass('selected');
        $("#ShoppingBonusProductInfoByPriceProductCd").val(bonusProductCd);
        $("#ShoppingBonusProductInfoByPriceProductName").val($("#product_name_price_bonus_"+bonusProductCd).text());
    }
}
var bag = <?php echo json_encode($this->data['Shopping']['product_info_list']);?>;
var bonusType = '<?php echo !empty($bonusType)?$bonusType:'';?>';
var priceTypeList = <?php echo !empty($priceTypeList)?json_encode($priceTypeList):"new Array()";?>;
function reCalculate() {
    var totalCount = 0;
    var totalAmount = 0;
    var diffSaleTotalAmount = 0;
    $.each(bag, function(key, value){
        var orderCountObj  = $("input[name='data[Shopping][product_info_list]["+key+"][order_amount]']");
        var diffSaleAmount = (value.retail_price*1 - value.sale_price*1)*orderCountObj.val();
        var orderAmount    = value.sale_price*orderCountObj.val();
        $("#diffSaleAmount"+key).html(formatCurrency(diffSaleAmount));
        $("#orderAmount"+key).html(formatCurrency(orderAmount));
        totalCount += orderCountObj.val()*1;
        diffSaleTotalAmount += diffSaleAmount;
        totalAmount += orderAmount;
    });

<?php if ($appSession->check('Auth.Member')):?>
    var newBonusType = '';
    $.each(priceTypeList, function(key, value) {
        if (value.PriceType.price < totalAmount) {
            newBonusType = value.PriceType.price_type;
        }
    });

    if (newBonusType != bonusType) {
        $("#ShoppingMode").val('reload');
        ajaxSubmit('cartList', 'hiddenForAjaxSubmit', 'ShoppingBagForm');
        return false;
    }
<?php endif;?>
    $("tr[id^='bonus_product_']").each(function(){
        totalCount++;
    });
    if ($("#price_bonus_product").length > 0) {
        totalCount++;
    }

    $("#diffSaleTotalAmount").text(formatCurrency(diffSaleTotalAmount));
    $("#totalCount").text(totalCount);
    $("#totalAmount").text(formatCurrency(totalAmount));
    //$("#shoppingBagCountHeader").text(totalCount);
    return true;
}
if ($('body').find("#tempIframe").length) {
    <?php if($appSession->check('Message.maxOrderPriceOverflow')):?>
    alert('<?php echo $appSession->flash('maxOrderPriceOverflow', false);?>');
    <?php endif;?>
}
</script>