    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14" style="width:740px;word-wrap:break-word;">
        您的账号密码取回请求已收到，请点击下面的链接重置您的密码：（链接三日内访问有效）<br>
        <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/password_reset/case:<?php echo $memberInfo['id'];?>/hashCode:<?php echo $hashCode;?>/expired:<?php echo $expired;?>"><?php echo HTTPS_HOME_PAGE_URL;?>/member/password_reset/case:<?php echo $memberInfo['id'];?>/hashCode:<?php echo $hashCode;?>/expired:<?php echo $expired;?></a><br>
        如果以上链接无法点击，请将它复制到你的浏览器（如IE）地址栏中进入访问。
    </p>
    <p class="f_14">
    这是一封自动产生的email，请勿回复。
    </p>