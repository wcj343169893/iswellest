<table cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <th width="80" class="center">商品</th>
            <th>名称</th>
        <?php if ($this->name == 'Shopping'):?>
            <!-- <th width="180">错误信息</th> -->
            <!-- <th width="80">市场价格</th> -->
            <th width="80">商城价格</th>
            <th width="80">赠送积分</th>
            <th width="80">数量</th>
            <th width="120">商品总价</th>
        <?php elseif ($this->name == 'Order' && $productList['order_type'] != ORDER_TYPE_REPAYMENT):?>
            <th width="80">商城价格</th>
            <th width="80">赠送积分</th>
            <th width="80">数量</th>
            <th width="120">商品总价</th>
            <th width="40">操作</th>
        <?php elseif ($this->name == 'Order' && $productList['order_type'] == ORDER_TYPE_REPAYMENT):?>
            <th width="40">退/换货</th>
        <?php endif;?>
        </tr>
    <?php $totalAmount = 0;?>
    <?php $totalPrice = 0;?>
    <?php $totalSaleDiscount = 0;?>
    <?php $totalPoint = 0;?>
    <?php $shippingPlanDate = null;?>
    <?php foreach ($productList['product_info_list'] as $key => $value):?>
        <?php $totalAmount            += $value['order_amount'];?>
        <?php //$pointAdjustment         = !empty($value['point_adjustment'])?$value['point_adjustment']:0;?>
        <?php $value['sale_discount']  = !empty($value['sale_discount'])?$value['sale_discount']:0;?>
        <?php $retailPrice             = !empty($productInfoList[$value['product_cd']]['Product']['retail_price'])?$productInfoList[$value['product_cd']]['Product']['retail_price']:0;?>
        <?php $picUrl                  = !empty($productInfoList[$value['product_cd']]['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$productInfoList[$value['product_cd']]['ProductPhoto'][0]['url']:'/image/front/none_90.jpg';?>
    <?php if (empty($value['bonus_flg'])):?>
        <?php $point                   = floor($value['point']*$value['order_amount']);?>
        <?php $totalPoint             += $point;?>
        <?php $price                   = $value['price'];?>
        <?php $saleDiscount            = $retailPrice - $value['price'];?>
        <?php $subTotalPrice           = $value['order_amount']*$price;?>
        <?php $subTotalSaleDiscount    = $value['order_amount']*$saleDiscount;?>
        <?php $totalPrice             += $subTotalPrice;?>
        <?php $totalSaleDiscount      += $subTotalSaleDiscount;?>
    <?php else:?>
        <?php $point = $price = $saleDiscount = $subTotalPrice = $subTotalSaleDiscount = $totalPrice = $totalSaleDiscount = 0;?>
    <?php endif;?>
        <?php $shippingPlanDate        = ($shippingPlanDate < $value['shipping_plan_date'])?$value['shipping_plan_date']:$shippingPlanDate;?>
        <?php if (!empty($this->data['Shopping']['sale_method']) && $this->data['Shopping']['sale_method'] == SALE_METHOD_GROUP_BUY):?>
            <?php $url = HTTP_HOME_PAGE_URL.'/group_buy/detail/id:'.$this->data['Shopping']['product_info_list'][0]['id'];?>
        <?php else:?>
        <?php $url = HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$value['product_cd'];?>
        <?php endif;?>
        <tr>
        <?php if (empty($value['bonus_flg']) && !in_array($this->action, array('payment', 'confirm'))):?>
            <td class="center"><a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $picUrl;?>" width="60" height="60" /></a></td>
            <td>
	            <a href="<?php echo $url;?>" target="_blank"><?php echo $value['product_name'];?></a><br>
	            <em><?php echo $appSession->flash('productSaleStatusStop'.$key);?></em>
            </td>
        <?php else:?>
            <td class="center"><img src="<?php echo $picUrl;?>" width="60" height="60" /></td>
            <td>
                <?php echo $value['product_name'];?><br>
                <em><?php echo $appSession->flash('productSaleStatusStop'.$key);?></em>
            </td>
        <?php endif;?>
        <?php //ショッピング機能の場合 ?>
        <?php if ($this->name == 'Shopping'):?>
            <?php /*<td><em><?php echo $appSession->flash('productSaleStatusStop'.$key);?></em></td>*/?>
            <!-- <td>￥<?php echo $number->currency($retailPrice, '');?></td> -->
            <td>￥<?php echo $number->currency($price, '');?>
            <!-- 
            <br /><?php if (!empty($saleDiscount)):?>(-￥<?php echo $number->currency($saleDiscount, '');?>)<?php endif;?>
             -->
            </td>
            <td><?php echo $point;?></td>
            <td><?php echo $value['order_amount'];?> 件 </td>
            <td>￥<?php echo $number->currency($subTotalPrice, '');?>
            <?php if (!empty($subTotalSaleDiscount)):?>
            <!-- 
            <br />
            (-￥<?php echo $number->currency($subTotalSaleDiscount, '');?>)
             -->
            <?php endif;?></td>
        <?php //注文情報詳細画面かつ注文種類が"注文"の場合 ?>
        <?php elseif ($this->name == 'Order' && $productList['order_type'] != ORDER_TYPE_REPAYMENT):?>
            <td>￥<?php echo $number->currency($price, '');?>
            <!-- <br /><?php if (!empty($saleDiscount)):?>(-￥<?php echo $number->currency($saleDiscount, '');?>)<?php endif;?> -->
            </td>
            <td><?php echo $point;?></td>
            <td><?php echo $value['order_amount'];?> 件 </td>
            <td>￥<?php echo $number->currency($subTotalPrice, '');?>
            <?php if (!empty($subTotalSaleDiscount)):?>
            <!-- 
            <br />
            (-￥<?php echo $number->currency($subTotalSaleDiscount, '');?>)
             -->
            <?php endif;?></td>
            <td>
            <?php //TODO:if ($productList['shipping_status'] == SHIPPING_STATUS_SHIPPED):?>
            <?php if (empty($value['bonus_flg']) && $productList['shipping_status'] == SHIPPING_STATUS_SHIPPED && empty($existsEstimation[$orderInfo['order_no']][$productList['record_num']][$value['product_cd']])):?>
            <a href="<?php echo HTTP_HOME_PAGE_URL;?>/estimation/add/order_no:<?php echo $orderInfo['order_no'];?>/record_num:<?php echo $recordNum;?>/product_cd:<?php echo $value['product_cd'];?>" ><img class="no-border" src="/image/front/comment.png" /></a>
            <?php elseif (empty($value['bonus_flg'])):?>
            <?php /*<img class="no-border" src="/image/front/comment_2.png" />*/?>
            <?php endif;?>
            <?php if (!empty($productInfoList[$value['product_cd']]['Product']['enable_sale'])):?>
            <a href="javascript:void(0);" onclick="javascript:addToBag('<?php echo $value['product_cd'];?>');"><img class="no-border" src="/image/front/s_cart.png" /></a>
            <?php endif;?>
            </td>
        <?php //注文情報詳細画面かつ注文種類が"返品"の場合?>
        <?php elseif ($this->name == 'Order' && $productList['order_type'] == ORDER_TYPE_REPAYMENT):?>
            <td><?php echo $value['order_amount'];?></td>
        <?php endif;?>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<div class="balanceInfo clearfix">
    <div class="shoppingTxt">
        <ul class="otherTxt2">
            <li>产品数量总计：<em><?php echo $totalAmount;?>件</em></li>
            <li class="w_190">赠送积分总计：<em><?php echo $totalPoint+$productList['point_adjustment'];?>分</em> (调整积分：<em><?php echo $productList['point_adjustment'];?></em>分)</li>
            <li>预计发货日期：<em><?php echo $shippingPlanDate;?></em></li>
        </ul>
    </div>
</div>