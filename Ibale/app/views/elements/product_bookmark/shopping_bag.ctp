<?php if (!empty($totalCount)):?>
<script type="text/javascript">alert('<?php __('info.addToBagSuccess');?>');</script>
<?php elseif($appSession->check('Message.productStockNotEnough0') || $appSession->check('Message.maxOrderPriceOverflow')):?>
<script type="text/javascript">alert('<?php echo $appSession->flash('productStockNotEnough0', false);?><?php echo $appSession->flash('maxOrderPriceOverflow', false);?>');</script>
<?php endif;?>