<h3 class="shoppingInfo">
    付款人邮件地址 <span class="orange f_12 p_15_l">※付款人必须是本商城用户</span>
</h3>
<div id="giftMailAddress" class="shoppingContent">
    <p>
        <span class="w_170">付款人邮箱地址：</span><?php echo $appHtml->html($giftInfo['email']);?>
        <?php echo $appForm->hidden('Address.pay_person_email', array('value'=>$giftInfo['email']));?>
        <?php echo $appForm->hidden('Address.pay_person_name', array('value'=>$giftInfo['name']));?>
        <span class="w_70 p_35_l">付款人：</span><?php echo $appHtml->html($giftInfo['name']);?>
    </p>
    <p>
        <span class="w_170">您收到选礼物邮件的邮箱地址：</span>
        <?php if (!isset($this->data['Address']['receive_person_email'])):?>
            <?php $appForm->data['Address']['receive_person_email'] = base64url_decode($giftInfo['receive_person_email']);?>
        <?php endif;?>
        <?php echo $appForm->hidden('Address.receive_person_email');?>
        <?php echo $appHtml->html($appForm->data['Address']['receive_person_email']);?>
        <span class="w_70 p_35_l">您的姓名：</span>
        <?php echo $appForm->text('Address.receive_person_name', array('class'=>'w_150'));?>
        <?php //echo $appForm->error('Address.receive_person_email', '您收到选礼物邮件的邮箱地址');?>
        <label class="error-message"><?php echo $appForm->error('Address.receive_person_name', '您的姓名', array('wrap'=>false));?></label>
    </p>
</div>
<!--收货地址-->
<h3 class="shoppingInfo">收货地址</h3>
<div class="addressInfo">
<?php echo $this->set('className', '');?>
<?php echo $this->element('address/edit');?>
</div>
