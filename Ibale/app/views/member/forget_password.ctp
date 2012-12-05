<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 忘记密码';?>
<?php echo $appForm->create('Member', array('id'=>'MemberForgetPassword', 'url'=>'/member/send_password_reset_mail'));?>
<!-- main -->
<h3 class="loginPassword"></h3>
<ul class="messageInfo m_10_b">
    <li class="h_50 center"><span class="orange f_14">请输入您注册的E-MAIL和手机/固定电话。 以便我们给您的注册邮箱发送重置密码邮件。</span></li>
    <li>
        <span class="tit3"><em>*</em> 邮箱地址：</span>
        <?php echo $appForm->text('email', array('class'=>'w_210', 'autocomplete'=>'off', 'onblur'=>"javascript:zenToHan(this);chageLetterCase(this);trimAllSpace(this);"));?>
        <?php echo $appForm->error('Member.email', '邮件地址');?>
    </li>
    <li>
        <span class="tit3"><em>*</em> 手机/固定电话：</span>
        <?php echo $appForm->text('phone', array('class'=>'w_210', 'onblur'=>"javascript:zenToHan(this);trimAllSpace(this);removeHyphen(this);"));?>
        <?php echo $appForm->error('Member.phone', '手机/固定电话');?>
    <?php if ($appSession->check('Message.memberEmailAndPhoneIsNotExists')):?>
        <label class="error-message"><?php echo $appSession->flash('memberEmailAndPhoneIsNotExists', false);?></label>
    <?php endif;?>
    </li>
    <li class="center">
        <button type="button" class="btnImg btnReturn" onclick="javaScript:history.back(-1);"></button>
        <button type="button" class="btnImg btnSend" onclick="javaScript:submitForm('MemberForgetPassword');"></button>
    </li>
</ul>
<!-- main end -->
<?php echo $appForm->end();?>