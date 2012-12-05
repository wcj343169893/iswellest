<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 重置密码';?>
<!-- main -->
<?php if ($appSession->check('Auth.Member')):?>
    <div class="titleBg m_10">
        <h3 class="mypageTitle"></h3>
    </div>
    <div class="mainCenter clearfix m10">
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:edit_member');?>
        <!-- 右侧详细信息 -->
        <div class=" mainRight">
            <!-- 送货地址 -->
            <h3 class="tableTop">
                <span class="tableTitle">重置密码</span>
            </h3>
            <div class="clear"></div>
            <ul class="messageInfo m_10_b">
                <li class="orange f_14 center">新密码设置完成。</li>
            </ul>
        </div>
    </div>
<?php else:?>
    <h3 class="loginPassword"></h3>
    <div class="messageInfo m_10_b">
        <p class="h_50 center">
            <span class="orange f_14">新密码设置完成，请请点击下方"登录"按钮重新登陆。</span>
        </p>
        <p class="center">
            <button type="button" class="btnImg btnLogin" onclick="javaScript:redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/member/login');"></button>
        </p>
    </div>
<?php endif;?>
<!-- main end -->