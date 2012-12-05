    <p class="f_14_b">
        亲爱的 <em><?php echo getMailPrefix($mailTo);?></em>：
    </p>
    <p class="f_14">
        您好！您的朋友<?php echo $appHtml->html($memberInfo['name']);?> 在<?php __('info.siteNameCN');?>(<a href="<?php echo HTTP_HOME_PAGE_URL;?>"><?php echo HTTP_HOME_PAGE_URL;?></a>)上看到TA心仪的以下商品，TA希望您来帮TA完成支付，您能满足TA吗？<br>
    <?php foreach($productInfos as $key => $productInfo):?>
        <br>
        <?php echo $key + 1;?>) <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?>"><?php echo $productInfo['product_name'];?></a><br>
    <?php endforeach;?>
        <br>
        <a href="<?php echo $url;?>">没问题，立即支付！</a><br>
        <br>
        此邀请还有<?php echo 24*$payDayExpired;?>小时失效。
    </p>