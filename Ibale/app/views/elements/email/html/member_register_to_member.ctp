    <p class="f_14_b">
        尊敬的<em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14">
        感谢您注册<?php __('info.siteNameCN');?> (<a href="http://www.ibale.com">www.ibale.com</a>)。<br>

        您的注册邮箱：<?php echo $appHtml->html($memberInfo['email']);?>。<br>
        登录爱芭乐需输入您的注册邮箱和密码，建议您保管好本邮件！如忘记密码，请点此<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/forget_password">找回密码</a>。<br>
        
        我们为您提供各种丰富的商品和优质的服务，马上开始您的爱芭乐体验之旅吧！<br>
    </p>
    <p class="f_14">
        如果您有任何疑问或建议，请<a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('联系我们');?>">联系我们</a>。<br>
        此邮件由系统自动发出，请勿直接回复。<br>
    </p>