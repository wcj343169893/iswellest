    <p class="f_14_b">
        尊敬的<em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14">
        您在 <?php echo substr($orderInfo['order_datetime'], 0, 19);?>下的订单 <?php echo $orderInfo['order_no'];?> 已成功取消。
        查看<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $orderInfo['order_no'];?>">订单详情</a>。
    </p>
    <p class="f_14">
        感谢您对<?php __('info.siteNameCN');?>的支持，您的满意是我们的追求。<br>
    </p>
