    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($this->data['Shopping']['receive_person_name']);?></em>：
    </p>
    <p class="f_14">
        您好！您的朋友<?php echo $appHtml->html($giftInfo['name']);?>要送你礼物，您已选择了以下商品，请等待TA买单！<br>
        <?php foreach($this->data['Shopping']['product_info_list'] as $key => $value):?>
        <br><?php echo $key + 1;?>.<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['product_cd']?>"><?php echo $value['product_name']?></a>
        <?php endforeach;?>
    </p>
    <p class="center">
        <img src="<?php echo HTTP_HOME_PAGE_URL;?>/image/email/banner.jpg"/>
    </p>