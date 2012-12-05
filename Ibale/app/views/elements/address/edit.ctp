    <ul id="updateAddress" class="<?php if(in_array($this->action, array('edit_for_shopping_payment', 'edit_address_for_shopping_payment'))):?>addressInfo2<?php else:?>addressInfo<?php endif;?> clearfix <?php echo !empty($className)?$className:'';?>" style="margin-bottom:10px;">
<?php if (empty($giftInfo)):?>
<?php echo $appForm->create('Address', array('id'=>'AddressEdit', 'url'=>!empty($formAction)?$formAction:'/address/update_address'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('Address.address');?>
<?php echo $appForm->hidden('referer');?>
<?php echo $appForm->hidden('update_flg', array('value' => 'update'));?>
<?php endif;?>
        <li>
            <span class="tit"><em>*</em> 收件人：</span>
            <?php echo $appForm->text('Address.name', array('class'=>'w_210'));?>
            <?php echo $appForm->error('Address.name', '收件人');?>
        </li>
        <?php echo $this->element('address/area');?>
        <li>
        <span class="tit"><em>*</em> 手机/电话：</span>
            <?php echo $appForm->text('Address.phone', array('class'=>'w_210'));?>
            <?php echo $appForm->error('Address.phone', '手机/电话');?>
        </li>
        <?php if (empty($giftInfo) && (!isset($this->data[$this->name]['id']) || $this->data[$this->name]['id'] === '')):?>
        <li><button type="button" class="btnImg btnAdd" onclick="javaScript:updateAddress();"></button></li>
        <?php else:?>
        <li><button type="button" class="btnImg btnEdit" onclick="javaScript:updateAddress();"></button></li>
        <?php endif;?>
<?php if (empty($giftInfo)):?>
    <?php echo $appForm->end();?>
<?php endif;?>
    </ul>