<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 用户登录';?>
<?php echo $appForm->create('Member', array('id'=>'LoginForm', 'url'=>'/member/login'));?>
<!-- main -->
<div class="mainCenter m_10">
<h3 class="loginTitle"></h3>
<div class="loginMain">
    <div class="login_form">
        <p>
            <label>邮件地址：</label><?php echo $appForm->text('email', array('class'=>'w_210', 'autocomplete'=>'off', 'onblur'=>"javascript:zenToHan(this);chageLetterCase(this);trimAllSpace(this);"));?>
            <?php echo $appForm->error('Member.email', '邮件地址');?>
            
        </p>
        <p>
            <label>密码：</label><?php echo $appForm->password('password', array('class'=>'w_210', 'autocomplete'=>'off'));?>
            <?php echo $appForm->error('Member.password', '密码');?>
        </p>
        <?php echo $appSession->flash('auth');?>
        <p>
            <label></label><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/forget_password/">忘记密码？</a>
        </p>
        <p class="btn">
            <button type="button" class="btnImg btnEntry" onclick="javaScript:login();"></button>
        </p>
        <p style="padding-left:95px;">
            还不是会员？点击这里：<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/regist">免费注册</a><br />
        </p>
    </div>
</div>
<!-- main end -->
<?php echo $appForm->end();?>
<script type="text/javascript">
$("#MemberEmail").focus();
function login() {
    submitForm('LoginForm');
}
</script>
</div>