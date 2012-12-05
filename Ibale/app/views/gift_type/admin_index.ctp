<?php echo $appForm->create('GiftType', array('id'=>'GiftType', 'url'=>'/admin/gift_type/add'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('type');?>
<?php echo $appForm->hidden('change_to');?>
<?php echo $appForm->hidden('name');?>
<div class="mainWrapper">
    <!-- 送礼对象 -->
    <h2>送礼对象</h2>
    <?php $this->set('giftTypeDataList', !empty($dataList[GIFT_TYPE_SEND_TO])?$dataList[GIFT_TYPE_SEND_TO]:array());?>
    <?php $this->type = GIFT_TYPE_SEND_TO;?>
    <?php echo $this->element('gift_type/admin_list');?>
    <p class="p_40_t"></p>
    <!-- 送礼场合 -->
    <h2>送礼场合</h2>
    <?php $this->set('giftTypeDataList', !empty($dataList[GIFT_TYPE_SEND_DATE])?$dataList[GIFT_TYPE_SEND_DATE]:array());?>
    <?php $this->type = GIFT_TYPE_SEND_DATE;?>
    <?php echo $this->element('gift_type/admin_list');?>
</div>
<script type="text/javascript">
function addGiftType(type) {
    $("#GiftType").attr('action', '/admin/gift_type/add');
    $("#GiftTypeType").val(type);
    $("input[name='data[GiftType][name]']").val($("input[id='GiftTypeName"+type+"']").val())
    $("#GiftType").submit();
    return false;
}
function changeGiftType(type, id) {
    $("#GiftTypeType").val(type);
    $("#GiftTypeId").val(id);
    $("#GiftTypeChangeTo").val($("#changeTo"+id+" option:selected").val());
    $("#GiftType").attr('action', '/admin/gift_type/change_gift_type');
    $("#GiftType").submit();
}
function delGiftType(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#GiftTypeId").val(id);
        $("#GiftType").attr('action', '/admin/gift_type/delete');
        $("#GiftType").submit();
    }
    return false;
}
<?php if ($appSession->check('Message.changeGiftTypeSuccess')):?>
alert('<?php echo $appSession->flash('changeGiftTypeSuccess', false);?>');
<?php endif;?>
</script>