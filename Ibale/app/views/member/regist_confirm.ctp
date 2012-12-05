<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 用户注册';?>
<?php echo $appForm->create('Member', array('id'=>'MemberRegist', 'url'=>'/member/regist_complete'));?>
<?php echo $appForm->hidden('mode');?>
<!-- main -->
<h3 class="memberTitle">
    <span></span>
</h3>
<div class="memberForm">
    <p>
        <label><b>* </b>姓名：</label><?php echo $appHtml->html($this->data['Member']['name']);?>
    </p>
    <p>
        <label><b>* </b>昵称：</label><?php echo $appHtml->html($this->data['Member']['nickname']);?>
    </p>
    <p><label><b>* </b>性别：</label> 
    <?php echo $msts['sex'][$this->data['Member']['sex']];?>
    </p>
    <p>
        <label><b>* </b>邮件地址：</label><?php echo $appHtml->html($this->data['Member']['email']);?>
    </p>
    <p>
        <label><b>* </b>密码：</label><?php echo preg_replace("/(\w|\W)/i", "●", $this->data['Member']['password']);?>
    </p>
    <p>
        <label><b>* </b>确认密码：</label><?php echo preg_replace("/(\w|\W)/i", "●", $this->data['Member']['password_confirm']);?>
    </p>
    <p>
        <label><b>* </b>手机/固定电话：</label><?php echo $this->data['Member']['phone'];?>
    </p>
    <p class="btn">
        <button type="button" class="btnImg btnRegister" onClick="javaScript:back();"></button>
        <button type="button" class="btnImg btnBack" onclick="javaScript:registComplete();"></button>
    </p>
</div>
<!-- main end -->
<?php echo $appForm->end();?>
<script type="text/javascript">
function back() {
    redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/member/regist/mode:back')
}
function registComplete() {
    $("#MemberMode").val('regist');
    submitForm('MemberRegist');
}
</script>