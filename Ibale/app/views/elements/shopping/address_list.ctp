<script type="text/javascript" src="/js/front/ajaxSubmit.js"></script>
<script type="text/javascript" src="/js/area.js"></script>
<?php if (!empty($addressList)):?>
    <?php $appForm->data['Shopping']['address'] = !empty($appForm->data['Shopping']['address'])?$appForm->data['Shopping']['address']:'0';?>
    <?php foreach($addressList as $key => $value):?>
    <?php echo $appForm->hidden('Shopping.name.'.$key, array('value' => $value['name']));?>
    <?php echo $appForm->hidden('Shopping.zip.'.$key, array('value' => $value['zip']));?>
    <?php echo $appForm->hidden('Shopping.phone.'.$key, array('value' => $value['phone']));?>
<?php /**
    <?php echo $appForm->hidden('Shopping.address1.'.$key, array('value' => $areaList[$value['address1']]));?>
    <?php echo $appForm->hidden('Shopping.address2.'.$key, array('value' => isset($areaList[$value['address2']])?$areaList[$value['address2']]:$value['address2']));?>
    <?php echo $appForm->hidden('Shopping.address3.'.$key, array('value' => isset($areaList[$value['address3']])?$areaList[$value['address3']]:$value['address3']));?>
*/?>
    <?php echo $appForm->hidden('Shopping.address1.'.$key, array('value' => $value['address1']));?>
    <?php echo $appForm->hidden('Shopping.address2.'.$key, array('value' => $value['address2']));?>
    <?php echo $appForm->hidden('Shopping.address3.'.$key, array('value' => $value['address3']));?>
    <?php echo $appForm->hidden('Shopping.address4.'.$key, array('value' => $value['address4']));?>
    <p>
        <span class="w_150"><?php echo $appForm->radio('Shopping.address', array($key => '收到人：'.$appHtml->html($value['name'])), array('class' => 'noBorder', 'legend' => false));?></span>
        <span class="p_35_l"><?php echo $value['zip'];?>&nbsp;&nbsp;<?php echo $appHtml->html($areaList[$value['address1']]).'-'.$appHtml->html((isset($areaList[$value['address2']])?$areaList[$value['address2']]:$value['address2'])).'-'.$appHtml->html((isset($areaList[$value['address3']])?$areaList[$value['address3']]:$value['address3'])) .'-'. $appHtml->html($value['address4']);?>&nbsp;&nbsp;<?php echo $value['phone'];?>
        &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="javascript:editAddress('<?php echo $key;?>');" style="color: #3F97CB;">编辑</a>
        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="javascript:deleteAddress('<?php echo $key;?>');" style="color: #3F97CB;">删除</a>
        </span>
    </p>
    <?php endforeach;?>
<?php endif;?>
    <p>
    <?php if ($appForm->error('Order.address', '')):?>
        <label class="error-message" style="padding:0px;"><?php echo $appForm->error('Order.address', '收件地址', array('wrap'=>false));?><br></label>
    <?php endif;?>
        <button type="button" class="btnImg btnAddress" onclick="javaScript:showAddressInput();"></button>
    </p>
    <?php /**
    <div id="addAddress" class="<?php echo (!empty($invalid)?'':'display-none');?>">
        <span id="closeLoginPop" class="close cursor_pointer float-right" onclick="javaScript:$('#addAddress').hide();">关闭</span>
        <span class="closeImg float-right"><a href="javaScript:void(0);" onclick="javaScript:$('#addAddress').hide();return false;"><img src="/image/front/close.gif"></a></span>
        <?php $this->set('formAction', HTTPS_HOME_PAGE_URL.'/address/ajax_update_address')?>
        <?php //echo $this->element('address/edit');?>
    </div>
    */?>
    <div id="editAddress" class="<?php echo (!empty($invalid)?'':'display-none');?>">
        <span id="closeLoginPop" class="close cursor_pointer float-right" onclick="javaScript:closeEditAddress()" style="padding-right:10px;padding-top:5px;">关闭</span>
        <span class="closeImg float-right" style="padding-right:2px;padding-top:5px;"><a href="javaScript:void(0);" onclick="javaScript:closeEditAddress();"><img src="/image/front/close.gif"></a></span>
        <div id="content">
            <?php $this->set('formAction', HTTPS_HOME_PAGE_URL.'/address/ajax_update_address');?>
            <?php echo $this->element('address/edit');?>
        </div>
    </div>
<script type="text/javascript">
function showAddressInput() {
    $.get('/address/edit_address_for_shopping_payment',{},function(rs){$("#editAddress #content").html(rs);});
    $("#editAddress").show();
}
function editAddress(id) {
    $.get('/address/edit_address_for_shopping_payment/id:'+id,{},function(rs){$("#editAddress #content").html(rs);});
    $("#editAddress").show();
}
function deleteAddress(id) {
    $("#AddressEdit").attr('action', '/address/ajax_delete/id:'+id);
    if (id != $("input[name='data[Shopping][address]']:checked").val()) {
        $("#AddressAddress").val($("input[name='data[Shopping][address]']:checked").val());
    }
    ajaxSubmit('addressList', 'hiddenForAjaxSubmit', 'AddressEdit');
}
function closeEditAddress() {
    $('#editAddress').hide();
    $('#editAddress #content').empty();
    return false;
}
function updateAddress() {
    $("#AddressAddress").val($("input[name='data[Shopping][address]']:checked").val());
    ajaxSubmit('addressList', 'hiddenForAjaxSubmit', 'AddressEdit');
}
$(function(){
    $("input[name='data[Shopping][address]']").click(function(){
        reCalcPrice();
    });
});
</script>