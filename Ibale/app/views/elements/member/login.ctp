<div id="loginPop" class="popup display-none z-index-top">
<?php echo $appForm->create('Member', array('id'=>'LoginForm', 'url'=>'/member/login'));?>
    <h6 class="popupTop">
        <span class="title">用户登录</span>
        <span id="closePop" class="close cursor_pointer" onclick="javaScript:closeLoginPop('loginPop', '<?php echo $this->name?>');">关闭</span> 
        <span class="closeImg"><a href="javaScript:void(0);" onclick="javaScript:closeLoginPop('loginPop', '<?php echo $this->name?>');return false;"><img src="/image/front/close.gif"> </a> </span>
    </h6>
    <div class="popupMain">
        <p class="l_70">
            <span class="w_70">邮件地址:</span>
            <?php echo $appForm->text('email', array('class'=>'w_210', 'autocomplete'=>'off', 'onblur'=>"javascript:zenToHan(this);chageLetterCase(this);trimAllSpace(this);"));?>
        </p>
        <p class="l_70">
            <span class="w_70">密码:</span>
            <?php echo $appForm->password('password', array('class'=>'w_210', 'autocomplete'=>'off'));?>
        </p>
        <p class="l_70">
            <span class="w_70"></span>&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/forget_password/">忘记密码？</a>
        </p>
        <p style="padding-left:95px;">
            <button type="button" class="btnImg btnLogin" onclick="javaScript:$('#LoginForm').submit();"></button>
        </p>
        <p style="padding-left:140px;">
            还不是会员？点击这里：<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/regist">免费注册</a><br>
        </p>
    </div>
    <?php echo $appForm->end();?>
</div>
<script type="text/javascript">
showPop('loginPop');
</script>