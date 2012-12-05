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
            <?php echo $this->element('member/password_reset');?>
        </div>
        <!-- 右侧详细信息 end -->
    </div>
<?php else:?>
    <h3 class="loginPassword"></h3>
    <?php echo $this->element('member/password_reset');?>
<?php endif;?>
<!-- main end -->