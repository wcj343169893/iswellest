    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14">
        您好！ <br>
        <?php __('info.siteNameCN');?>(<a href="<?php echo HTTP_HOME_PAGE_URL;?>"><?php echo HTTP_HOME_PAGE_URL;?></a>)已收到您于<?php echo $orderInfo['order_datetime'];?> 提交的订单 <?php echo $orderInfo['order_no'];?> ，我们会立即处理订单。<br>
        您可以随时进入<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $orderInfo['order_no'];?>">订单详情页面</a>查看订单的后续处理情况。<br>
    </p>