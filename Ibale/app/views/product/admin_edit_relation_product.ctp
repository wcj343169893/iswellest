<script type="text/javascript" src="/js/multiple_selectbox.js"></script>
<?php echo $appForm->create('Product', array('id'=>'Product', 'url'=>'/admin/product/edit_relation_product/product_cd:'.$this->data['Product']['product_cd']));?>
<?php echo $appForm->hidden('product_cd');?>
<?php echo $appForm->hidden('referer');?>
<div class="mainWrapper">
    <h2>关联商品编辑</h2>
    <h3>
        名称或编号：
        <?php echo $appForm->text('Search.product_cd', array('class'=>'input_300'));?>
        &nbsp;&nbsp; <input name="submit_button" type="submit" id="submit_button" value="查找" class="btnWidth">
    </h3>
    <div class="topContent clearfix">
        <div class="noneTable">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td width="42%">搜索结果</td>
                    <td width="8%"></td>
                    <td width="42%">显示排序</td>
                    <td width="8%"></td>
                </tr>
                <tr>
                    <td width="42%">
                        <?php echo $appForm->select('enable_relation_product_cd', $enableRelationList, null, array('id'=>'leftSelectBox', 'multiple'=>'multiple', 'size'=>'14', 'style'=>'width:100%;', 'empty'=>false));?>
                    </td>
                    <td width="8%" class="center">
                        <input name="button" type="button" class="btnWidth" id="toRight" value="&gt;" /><br /> <br /> 
                        <input name="button" type="button" class="btnWidth" id="toLeft" value="&lt;" />
                    </td>
                    <td width="42%">
                        <?php echo $appForm->select('relation_product_cd', $relationList, null, array('id'=>'rightSelectBox', 'multiple'=>'multiple','size'=>'14', 'style'=>'width:100%;', 'empty'=>false));?>
                    </td>
                    <td width="8%" class="center">
                        <input name="button" type="button" class="btnWidth" id="rightSortUp" value="∧" /><br /> <br /> 
                        <input name="button" type="button" class="btnWidth" id="rightSortDown" value="∨" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br class="clear" />
    <div class="btn clearfix">
        <input name="button3" type="button" class="btnWidth" id="button3" value="更新" onClick="javaScript:updateRelationProduct();"/>
    </div>
</div>
<?php echo $appForm->end();?>
<script type="text/javascript">
$(function(){
    $("#rightSortUp").click(function() {
        moveUp("rightSelectBox");
    });
    $("#rightSortDown").click(function() {
        moveDown("rightSelectBox");
    });
    $("#toRight").click(function() {
        moveTo("leftSelectBox", "rightSelectBox");
    });
    $("#toLeft").click(function() {
        moveTo("rightSelectBox", "leftSelectBox");
    });
});
function updateRelationProduct() {
    $("#rightSelectBox option").each(function () {
        $(this).attr('selected', true);
    });

    $("#Product").attr('action', '/admin/product/update_relation_product');
    $("#Product").submit();
}
</script>