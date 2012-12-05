    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14">
        您好！<br> 
        很遗憾地通知您，您于<?php echo $orderInfo['order_datetime'];?> 提交的订单 <?php echo $orderInfo['order_no'];?> ，因超过了支付期限<?php __('info.alipayExpiredTime');?>未支付而取消。<br>
        您可以随时进入<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $orderInfo['order_no'];?>">订单详情页面</a>查看订单的详细情况。
    </p>
