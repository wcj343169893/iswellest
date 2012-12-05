
        <?php echo $appForm->create('GiftTop', array('id'=>'GiftTopForm', 'url'=>HTTPS_HOME_PAGE_URL.'/gift_top/send_mail'));?>
            <p>让TA自己来选！</p>
            <p>
                <?php echo $appForm->text('email', array('style'=>'width:170px;'));?>
                <?php echo $appForm->error('GiftTop.email', '邮件地址');?>
            </p>
            <p>打算送TA</p>
            <p>
                <?php echo $appForm->select('gift_send_type', $categoryProductOptions, null, array('empty' => '送礼对象X送礼场合'));?>
                <?php /**
                <?php echo $appForm->select('send_to', $sendToOptionList, null, array('empty' => '送礼对象'));?>
                <?php echo $appForm->select('send_date', $sendDateOptionList, null, array('empty' => '送礼场合'));?>
                */?>
            </p>
            <p>预算</p>
            <p>
                <?php echo $appForm->text('min_price', array('size'=>'8'));?> - <?php echo $appForm->text('max_price', array('size'=>'8'));?>
                <?php echo $appForm->error('GiftTop.min_price', '最少预算');?>
                <?php echo $appForm->error('GiftTop.max_price', '最多预算');?>
            </p>
            <p class="center">
                <button type="button" class="btnImg btnSubmit" onclick="javaScript:sendMailToTA();"></button>
            </p>
            <?php echo $appSession->flash('sendMailToTASuccess');?>
        <?php echo $appForm->end();?>
        <?php if (!empty($loginFlg)):?>
        <?php echo $this->element('member/login');?>
        <?php endif;?>
