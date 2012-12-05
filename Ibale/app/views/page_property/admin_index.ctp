<script type="text/javascript" src="/js/admin/trUpDown.js"></script>
<script type="text/javascript" src="/js/ajaxSave.js"></script>
<?php echo $appForm->create('PageProperty', array('id'=>'PageProperty', 'url'=>'/admin/page_property/add'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('type');?>
<?php echo $appForm->hidden('name');?>
<?php echo $appForm->hidden('url');?>
<?php echo $appForm->hidden('order_number');?>
<div class="mainWrapper">
    <h2>顶部导航管理</h2>
    <?php $this->dataList = !empty($propertyList[PAGE_PROPERTY_HEADER])?$propertyList[PAGE_PROPERTY_HEADER]:array();?>
    <?php $this->type = PAGE_PROPERTY_HEADER;?>
    <?php echo $this->element('page_property/admin_list');?>
    <p class="p_40_t"></p>
    <h2>底部导航管理</h2>
    <?php $this->dataList = !empty($propertyList[PAGE_PROPERTY_FOOTER])?$propertyList[PAGE_PROPERTY_FOOTER]:array();?>
    <?php $this->type = PAGE_PROPERTY_FOOTER;?>
    <?php echo $this->element('page_property/admin_list');?>
</div>
<?php echo $appForm->end();?>
<script type="text/javascript">
$(function() {
    $("a[id^='upBtn']").click(function(){
        var id = $(this).attr('id').substring(5);
	    var tableNodeId = $(this).parent().parent().parent().parent().attr('id');
        moveTrUp(id, tableNodeId, 'PageProperty');
    });
    $("a[id^='downBtn']").click(function(){
        var id = $(this).attr('id').substring(7);
        var tableNodeId = $(this).parent().parent().parent().parent().attr('id');
        moveTrDown(id, tableNodeId, 'PageProperty');
    });
});
function addProperty(type) {
    $("#PageProperty").attr('action', '/admin/page_property/add');
    $("#PagePropertyType").val(type);
    $("input[name='data[PageProperty][name]']").val($("input[id='PagePropertyName"+type+"']").val())
    $("input[name='data[PageProperty][url]']").val($("input[id='PagePropertyUrl"+type+"']").val())
    $("input[name='data[PageProperty][order_number]']").val($("input[id='PagePropertyOrderNumber"+type+"']").val())
    $("#PageProperty").submit();
    return false;
}
function delProperty(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#PagePropertyId").val(id);
        $("#PageProperty").attr('action', '/admin/page_property/delete');
        $("#PageProperty").submit();
    }
    return false;
}
</script>