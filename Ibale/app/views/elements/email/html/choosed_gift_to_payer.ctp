    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($giftInfo['name']);?></em>：
    </p>
    <p class="f_14">
        您好！您的朋友<?php echo $appHtml->html($this->data['Shopping']['receive_person_name']);?>收到您的送礼邀请非常开心！已经选择了以下商品作为礼物，您可以在7天之内完成支付，<?php __('info.siteNameCN');?>将在收到支付后安排送出您的礼物！<br>
        <?php foreach($this->data['Shopping']['product_info_list'] as $key => $value):?>
        <br>
        <?php echo $key + 1;?>.<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['product_cd']?>"><?php echo $value['product_name']?></a>
        <?php endforeach;?>
    </p>
    <p class="center">
        <a href="<?php echo $url;?>"><img src="<?php echo HTTP_HOME_PAGE_URL;?>/image/email/pay.jpg"/></a>
    </p>