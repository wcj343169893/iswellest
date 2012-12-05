<script type="text/javascript" src="/js/admin/trUpDown.js"></script>
<script type="text/javascript" src="/js/ajaxSave.js"></script>
<?php echo $appForm->create('CategoryTop', array('id'=>'CategoryTop', 'url'=>'/admin/category_top/add'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('name');?>
<div class="mainWrapper">
    <h2>频道管理</h2>
    <div class="search">
        <?php echo $appForm->text('name', array('class'=>'input'));?>
        <input type="submit" name="button" id="button" value="添加频道" class="btnWidth" onclick="window.location.href='categorytop.html'">
        <?php echo $appForm->error('CategoryTop.name', '名称');?>
        <?php if ( $appSession->check('Message.nameIsExists')):?>
            <?php echo $appSession->flash('nameIsExists');?>
        <?php endif;?>
    </div>
    <table id="tCategoryTop" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>排序</th>
                <th>频道名称</th>
                <th>操作</th>
            </tr>
<?php if (!empty($dataList)):?>
        <?php foreach ($dataList as $key =>$value):?>
        <?php $value = $value['CategoryTop'];?>
            <tr id="tr<?php echo $value['id'];?>">
                <td id="orderNumber<?php echo $value['id'];?>"><?php echo $key + 1;?></td>
                <td class="bold"><?php echo $value['name'];?></td>
                <td class="action2">
                            <?php if ($key != 0):?>
                    <a id="upBtn<?php echo $value['id'];?>" href="javaScript:void(0);">上移</a>
            <?php else:?>
                    <a id="upBtn<?php echo $value['id'];?>" href="javaScript:void(0);" class="disabled">上移</a>
            <?php endif;?>
            <?php if ($key < count($dataList) - 1):?>
                    <a id="downBtn<?php echo $value['id'];?>" href="javaScript:void(0);">下移</a>
            <?php else:?>
                    <a id="downBtn<?php echo $value['id'];?>" href="javaScript:void(0);" class="disabled">下移</a>
            <?php endif;?> 
                    <a href="javaScript:void(0);" class="del" onClick="javaScript:editCategoryTop('<?php echo $value['id'];?>');">修改</a>
                    <a href="javaScript:void(0);" class="del" onClick="javaScript:delCategoryTop('<?php echo $value['id'];?>');">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
<?php else:?>
        <tr><td colspan="4"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>
</div>
<?php echo $appForm->end();?>
<script type="text/javascript">
$(function() {
    $("a[id^='upBtn']").click(function(){
        var id = $(this).attr('id').substring(5);
        var tableNodeId = $(this).parent().parent().parent().parent().attr('id');
        moveTrUp(id, tableNodeId, 'CategoryTop');
    });
    $("a[id^='downBtn']").click(function(){
        var id = $(this).attr('id').substring(7);
        var tableNodeId = $(this).parent().parent().parent().parent().attr('id');
        moveTrDown(id, tableNodeId, 'CategoryTop');
    });
});
function addCategoryTop(type) {
    $("#CategoryTop").attr('action', '/admin/category_top/add');
    $("input[name='data[CategoryTop][name]']").val($("input[id='CategoryTopName']").val())
    $("#CategoryTop").submit();
    return false;
}

function editCategoryTop(id) {
    $("#CategoryTopId").val(id);
    $("#CategoryTop").attr('action', '/admin/category_top/edit');
    $("#CategoryTop").submit();
    return false;
}
function delCategoryTop(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#CategoryTopId").val(id);
        $("#CategoryTop").attr('action', '/admin/category_top/delete');
        $("#CategoryTop").submit();
    }
    return false;
}
<?php if ($appSession->check('Message.categoryTopUpdateSuccess')):?>
alert('<?php echo $appSession->flash('categoryTopUpdateSuccess', false);?>');
<?php endif;?>
</script>
