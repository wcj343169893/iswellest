<?php $this->page_props['title'] = __('info.siteNameCN', true).' - '.((isset($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == SALE_METHOD_GIFT)?'赠送礼物购物车':'购物车');?>
<script type="text/javascript" src="/js/front/ajaxSubmit.js"></script>
<!-- main -->
<?php if (!empty($priceTypeFreeInfo)):?>
    <label class="free_shipping orange">
        满<?php echo $number->currency(($priceTypeFreeInfo['PriceType']['price']), '', array('places'=>0));?>元包邮
    </label>
<?php endif;?>
<h3 class="<?php echo !empty($giftInfo)?'giftShopping':'shopping';?>Title m_10">我的购物车</h2>
<div class="<?php echo !empty($giftInfo)?'giftShopping':'shopping';?>Step">我的购物车</div>
<div id="cartList" class="relative">
<?php echo $this->element('/shopping/cart_list');?>
</div>
<div class="clear"></div>
<?php echo $this->element('/shopping/recommend');?>
<!-- main end -->
<div id="cartHidden" style="display:none">
</div>
