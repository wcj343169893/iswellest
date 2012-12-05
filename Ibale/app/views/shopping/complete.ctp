<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 完成订单';?>
<!-- main -->
<div class="<?php echo ($appSession->check('Shopping.view.pay_person_email'))?'giftShopping':'shopping';?>Step4 m10">订单完成</div>
<!--送货地址-->
<h3 class="shoppingInfo">完成订单</h3>
<div class="shoppingFinish m_10_b">
    <p class="center f_14">
<?php if ($appSession->check('Shopping.view.pay_person_email')):?>
    感谢您礼品申请。我们给您的礼品申请邮箱发送了确认邮件。<br />
    您的邮件：<span class="orange"><?php echo $appSession->read('Shopping.view.receive_person_email');?></span><br/>
    付款人的邮件：<span class="orange"><?php echo $appSession->read('Shopping.view.pay_person_email');?></span>
    </p>
    <p class="center m_30">
        <button type="button" class="btnImg btnGift" onclick="javaScript:redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/gift_top/');"></button>
    </p>
<?php else:?>
    <p class="center f_14">
        感谢您订购，我们给您的注册邮箱发送了确认邮件。<br />
        <?php foreach($orderInfo['orders'] as $key => $value):?>
        订单号码：<span class="orange"><?php echo $orderInfo['order_no'].'-'.$value['record_num'];?></span><br/>
        <?php endforeach;?>
    </p>
    <p class="center m_30">
        <button type="button" class="btnImg btnMypage" onclick="javaScript:redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/');"></button>
    </p>
<?php endif;?>
</div>
<script type="text/javascript">
<!--
_gaq.push(['_addTrans',
    '<?php echo $orderInfo['order_no'];?>',           // order ID - required
    '', // affiliation or store name
    '<?php echo $orderInfo['ordered_subtotal'];?>',          // total - required
    '',           // tax
    '<?php echo $orderInfo['shipping_charge'];?>',          // shipping
    '<?php echo $areaList[$orderInfo['shipto_address2']];?>',       // city
    '<?php echo $areaList[$orderInfo['shipto_address1']];?>',     // state or province
    '中国'             // country
]);
<?php foreach($orderInfo['orders'] as $key => $order):?>
    <?php foreach($order['product_info_list'] as $k => $product):?>
_gaq.push(['_addItem',
    '<?php echo $orderInfo['order_no'];?>',           // order ID - necessary to associate item with transaction
    '<?php echo $product['product_cd'];?>',           // SKU/code - required
    '<?php echo $product['product_name'];?>',        // product name
    '<?php echo $product['category_id'];?>',   // category or variation
    '<?php echo $product['price'];?>',          // unit price - required
    '<?php echo $product['order_amount'];?>'               // quantity - required
]);
    <?php endforeach;?>
<?php endforeach;?>
_gaq.push(['_trackTrans']);
//-->
</script>
<!-- main end -->