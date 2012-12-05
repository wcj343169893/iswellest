<ul class="otherTxt">
    <li>总消费额：￥<?php echo $number->currency($orderTotal['amount'], '')?> <span class="p_200_l">总完成订单：<?php echo $orderTotal['count'];?></span></li>
    <li>会员积分：<?php echo $point;?> <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('积分规则');?>">积分规则</a></li>
<?php if(!empty($orderTotal['notCredited'])):?>
    <li><em>您现在有未支付的订单！</em> <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/shipping_status:<?php echo SHIPPING_STATUS_NOTCREDITED;?>">查看>></a></li>
<?php endif;?>
</ul>