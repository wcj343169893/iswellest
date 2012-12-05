<?php if (!empty($redirectUrl)):?>
<p id="redirectUrl"><?php echo $redirectUrl;?></p>
<?php endif;?>
<?php echo $appForm->create('Enquiry', array('id'=>'EnquiryForm', 'url'=>'/enquiry/add'));?>
<?php $appForm->data['Enquiry']['product_cd'] = isset($this->params['named']['product_cd'])?$this->params['named']['product_cd']:$appForm->data['Enquiry']['product_cd'];?>
<?php echo $appForm->hidden('product_cd');?>
<p class="commentTitle">询问登录</p>
<p>
    <label>询问类型</label> 
    <?php echo $appForm->select('Enquiry.type', $msts[ENQUIRY_TYPE], null, array('empty'=>__('label.pleaseSelect', true)));?>
</p>
<?php echo renderMsg($appSession->flash('enquiryCreateFailuretype'), '询问类型');?>
<p>
    <label>询问内容</label>
    <?php echo $appForm->textarea('content', array('cols'=>'45', 'rows'=>'5'));?>
</p>
<?php echo renderMsg($appSession->flash('enquiryCreateFailurecontent'), '询问内容');?>
<p class="btn">
    <button type="button" class="btnImg btnEntry" onclick="javaScript:ajaxSubmit('productEnquiryForm', 'hiddenForAjaxSubmit', 'EnquiryForm')"></button>
</p>
<?php echo $appForm->end();?>
<?php if ($appSession->check('Message.enquiryAddSuccess')):?>
<?php echo $appSession->flash('enquiryAddSuccess');?>
<?php endif;?>
<?php //if (!empty($dispLogin)):?>
<?php //echo $this->element('member/login');?>
<?php //endif;?>