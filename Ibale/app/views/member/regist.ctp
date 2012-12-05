<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 用户注册';?>
<?php echo $appForm->create('Member', array('id'=>'MemberRegist', 'url'=>'/member/regist_confirm'));?>
<!-- main -->
<h3 class="memberTitle">
    <span></span>
</h3>
<div class="memberForm">
    <p>
        <label><b>* </b>姓名：</label>
        <?php echo $appForm->text('name', array('class'=>'w_210', 'autocomplete'=>'off', 'maxlength'=>'10'));?>
        <span class="txt">10字符以内</span>
    </p>
    <?php echo $appForm->error('Member.name', '姓名', array('hasBr'=>false));?>
    <p>
        <label><b>* </b>昵称：</label>
        <?php echo $appForm->text('nickname', array('class'=>'w_210', 'autocomplete'=>'off', 'maxlength'=>'10'));?>
        <span class="txt">10字符以内</span>
    </p>
    <?php echo $appForm->error('Member.nickname', '昵称', array('hasBr'=>false));?>
    <p><label><b>* </b>性别：</label> 
    <?php $appForm->data['Member']['sex'] = !empty($this->data['Member']['sex'])?$this->data['Member']['sex']:SEX_MALE;?>
    <span class="sex"><?php echo $appForm->radio('sex', $msts['sex'], array('class'=>'noBorder', 'label' => true, 'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;'));?></span>
    </p>
    <p>
        <label><b>* </b>邮件地址：</label>
        <?php echo $appForm->text('email', array('class'=>'w_210', 'autocomplete'=>'off', 'onblur'=>"javascript:zenToHan(this);chageLetterCase(this);trimAllSpace(this);"));?>
    </p>
    <?php echo $appForm->error('Member.email', '邮件地址', array('hasBr'=>false));?>
    <p>
        <label><b>* </b>密码：</label>
        <?php echo $appForm->password('password', array('class'=>'w_210', 'autocomplete'=>'off', 'maxlength'=>'16'));?>
        <span class="txt">6-16个字符组成，请使用英文字母、数字组合</span>
    </p>
    <?php echo $appForm->error('Member.password', '密码', array('hasBr'=>false));?>
    <p>
        <label><b>* </b>确认密码：</label>
        <?php echo $appForm->password('password_confirm', array('class'=>'w_210', 'autocomplete'=>'off'));?>
        <span class="txt">请再输入一遍上面输入的密码</span>
    </p>
    <?php echo $appForm->error('Member.password_confirm', '确认密码', array('hasBr'=>false));?>
    <p>
        <label><b>* </b>手机/固定电话：</label>
        <?php echo $appForm->text('phone', array('class'=>'w_210', 'onblur'=>"javascript:zenToHan(this);trimAllSpace(this);removeHyphen(this);"));?>
    </p>
    <?php echo $appForm->error('Member.phone', '手机/固定电话', array('hasBr'=>false));?>
    <p>
        <label><b>* </b>验证码：</label>
        <?php echo $appForm->text('security_code', array('class'=>'w_210'));?>
        <span class="checkCode"><img id="securityPic" src="/member/show_security_pic" width="100" height="30" /></span>
        <span class="txt">看不清? <a href="javaScript:void(0);" onClick="javaScript:changeSecurityCode();return false;">换一张</a> </span>
    </p>
    <?php echo $appSession->flash('securityCodeIsWrong');?>
    <p class="regist_article_link">
        <label></label>&nbsp;<a href="javascript:void(0);" onclick="javascript:displayRegistArticle();"><?php __('info.siteNameCN');?>服务协议&nbsp;&gt;&gt;</a>
    </p>
    <div class="regist_article">
    <?php $title = '服务协议';$this->set('articleTitle', $title);echo $this->element("/article/detail_noformat", array('cache'=>array('time'=>STATIC_PAGE_CACHED_DURATION, 'key'=>base64url_encode($title))));?></div>
    <?php if ($appSession->check('Message.emailOrPhoneIsWrong')):?>
        <?php echo $appSession->flash('emailOrPhoneIsWrong');?>
    <?php endif;?>
    <?php echo $appSession->flash('memberEmailOrNicknameDuplicate');?>
    <p class="btn">
        <button type="button" class="btnImg btnEnter" onClick="javaScript:registMember();"></button>
    </p>
</div>
<!-- main end -->
<?php echo $appForm->end();?>
<script type="text/javascript">
function displayRegistArticle() {
    console.debug($(".regist_article").css("display"));
    if($(".regist_article").css("display") == "none") {
        $(".regist_article").show();
    } else {
        $(".regist_article").hide();
    }
}
function changeSecurityCode() {
    var randval = Math.random();
    $("#securityPic").attr('src', '/member/show_security_pic/?r='+randval);
}
function registMember() {
    $("#MemberRegist").submit();
    return false;
}
</script>