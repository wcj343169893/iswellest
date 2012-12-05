    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html(getMailPrefix($mailTo));?></em>：
    </p>
    <p class="f_14">
        您好！您的朋友<?php echo $appHtml->html($memberInfo['name']);?>想送你一个礼物，在<?php __('info.siteNameCN');?>选定了一些商品，邀请你直接挑，TA买单！<b><br>
        <a href="<?php echo $url;?>">去挑礼物</a></b>
    </p>
    <p class="gray" style="width:740px;word-wrap:break-word;">
        （如果链接无法打开，请将下面地址复制到网页浏览)<br>
        <a href="<?php echo $url;?>"><?php echo $url;?></a> 
    </p>
    <p class="center">
        <a href="<?php echo $url;?>"><img src="<?php echo HTTP_HOME_PAGE_URL;?>/image/email/banner.jpg"/></a>
    </p>
