<?php if (!empty($redirectUrl)):?>
<script type="text/javascript">window.location.href='<?php echo $redirectUrl;?>';</script>
<?php elseif (!empty($totalCount)):?>
<div id="shoppingBagPop" class="popup z-index-top display-none">
    <h6 class="popupTop">
        <span class="close cursor_pointer" onclick="javaScript:closePop('shoppingBagPop');">关闭</span> 
        <span class="closeImg"><a href="javaScript:void(0);" onclick="javaScript:closePop('shoppingBagPop');return false;"><img src="/image/front/close.gif"> </a> </span>
    </h6>
    <div class="popupMain">
        <span class="balanceImg"></span>
        <p class="popupTitle">商品已成功添加到购物车</p>
        <p>
            购物车共<span class="orange" id="shoppingBagCount"><?php echo $totalCount?> </span>件商品 合计：<span class="orange f_14_b"><?php echo $number->currency($totalPrice,'');?> </span> 元
        </p>
        <p>
            <a href="javaScript:void(0);" onclick="javaScript:closePop('shoppingBagPop');return false;"><img src="/image/front/continue_shopping_pop.png" /></a>&nbsp;&nbsp;
            <a href="javaScript:void(0);" onclick="javaScript:redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/bag/<?php if (!empty($giftFlg)):?>sale_method:<?php echo SALE_METHOD_GIFT;?><?php endif;?>')"><img src="/image/front/payment_pop.png" /></a>
        </p>
    </div>
</div>
<script type="text/javascript">
showPop('shoppingBagPop');
function closePop(id) {
    $('#'+id).remove();
    $("#blockOtherOperation").hide();
    if (window.location.href.indexOf('shopping/bag') != -1) {
        showWait();
        window.location.href = "<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/bag";
    }
}
</script>
<?php elseif($appSession->check('Message.productStockNotEnough0') || $appSession->check('Message.maxOrderPriceOverflow')):?>
<script type="text/javascript">
alert('<?php echo $appSession->flash('productStockNotEnough0', false);?>\n<?php echo $appSession->flash('maxOrderPriceOverflow', false);?>');
</script>
<?php endif;?>