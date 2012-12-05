<?php echo $appForm->create('Member', array('id'=>'MemberPasswordReset', 'url'=>'/member/update_password'));?>
<?php echo $appForm->hidden('id');?>
<ul class="messageInfo m_10_b">
    <li class="h_50 center"><span class="orange f_14">请您重新设置您的新密码。</span></li>
    <li>
        <span class="tit3"><em>*</em>新密码：</span>
        <?php echo $appForm->password('password', array('class'=>'w_210', 'autocomplete'=>'off'));?>
        <?php echo $appForm->error('Member.password', '密码');?>
    </li>
    <li>
        <span class="tit3"><em>*</em>确认新密码：</span>
        <?php echo $appForm->password('password_confirm', array('class'=>'w_210', 'autocomplete'=>'off'));?>
        <?php echo $appForm->error('Member.password_confirm', '确认密码');?>
    </li>
    <li class="center"><button type="button" class="btnImg btnConfirm" onclick="javaScript:submitForm('MemberPasswordReset');"></button></li>
</ul>
<?php echo $appForm->end();?>