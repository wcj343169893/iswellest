    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html(getMailPrefix($mailTo));?></em>：
    </p>
    <p class="f_14">
        您好！您的朋友<?php echo $appHtml->html($memberInfo['name']);?> 在<?php __('info.siteNameCN');?>(<a href="<?php echo HTTP_HOME_PAGE_URL;?>"><?php echo HTTP_HOME_PAGE_URL;?></a>)上看到TA心仪的"<?php echo $productInfos[0]['product_name'];?>"，你愿意把这件商品作为礼物送给TA吗？<br>
        <br>
        <a href="<?php echo $url;?>">接受考验送TA</a>！<br>
        <br>
        此邀请还有<?php echo 24*$payDayExpired;?>小时失效。
    </p>