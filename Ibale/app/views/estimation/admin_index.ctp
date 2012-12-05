<link type="text/css" rel="stylesheet" href="/css/admin/box.css"/>
<script type="text/javascript" src="/js/admin/admin.js"></script>
<?php echo $appForm->create('Estimation', array('id'=>'Estimation', 'url'=>'/admin/estimation/search'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('update_status');?>
<?php echo $appForm->hidden('Search.top_order');?>
<?php echo $appForm->hidden('Search.create_datetime_order');?>
<?php echo $appForm->hidden('Search.create_user_order');?>
<?php echo $appForm->hidden('Search.product_name_order');?>
<?php echo $appForm->hidden('Search.remote_ip_address_order');?>
<div class="mainWrapper">
    <h2>用户评论</h2>
    <div class="search">
        评论内容：
        <?php echo $appForm->text('Search.content', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 商品ID：
        <?php echo $appForm->text('Search.product_cd', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 用户名：
        <?php echo $appForm->text('Search.create_user', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 评论时间：
        <?php echo $appForm->text('Search.create_datetime_start', array('id'=>'createDatetimeStart','class'=>'input_80'));?>
        -
        <?php echo $appForm->text('Search.create_datetime_end', array('id'=>'createDatetimeEnd','class'=>'input_80'));?>
        状态：
        <?php echo $appForm->select('Search.status', $msts[ESTIMATION_STATUS], null, array('empty'=>__('label.selectALL', true)));?>
        &nbsp;&nbsp; <input name="submit_button" type="button" id="search" value="查找" class="btnWidth">
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th class="w_10" width="14">
                <input type="checkbox" name="checkbox" id="Estimation.selected_id" onClick="javaScript:checkAll(this, 'count');"/>
                </th>
                <th width="60">编号</th>
                <th width="120" id="create_user_order" class="cursor_hand" onClick="javaScript:changeSort('create_user_order');">用户名<?php echo ($this->data['Search']['create_user_order']=='ASC')?'▲':'▼'?></th>
                <th width="140" id="product_name_order" class="cursor_hand" onClick="javaScript:changeSort('product_name_order');">评论商品<?php echo ($this->data['Search']['product_name_order']=='ASC')?'▲':'▼'?></th>
                <th width="110" id="remote_ip_address_order" class="cursor_hand" onClick="javaScript:changeSort('remote_ip_address_order');">IP地址<?php echo ($this->data['Search']['remote_ip_address_order']=='ASC')?'▲':'▼'?></th>
                <th>评论内容</th>
                <th width="120" id="create_datetime_order" class="cursor_hand" onClick="javaScript:changeSort('create_datetime_order');">评论时间<?php echo ($this->data['Search']['create_datetime_order']=='ASC')?'▲':'▼'?></th>
                <th width="60">状态</th>
                <th width="120">操作</th>
            </tr>
    <?php if (!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <tr>
                <td class=""><?php echo $appForm->checkBox('Estimation.selected_id.'.$value['Estimation']['id'], array('id'=>'Estimation.selected_id.'.$value['Estimation']['id'], 'value'=>$value['Estimation']['id'],'onClick'=>"javaScript:checkObj2(this,'Estimation.selected_id','count');"));?>
                </td>
                <td class=""><?php echo $value['Estimation']['id'];?></td>
                <td class=""><?php echo $value['Estimation']['create_user'];?></td>
                <td class=""><a target="_blank" href="/product/detail/product_cd:<?php echo $value['Product']['product_cd'];?>"><?php echo $appHtml->html(mb_substr($value['Product']['product_name'],0,9).'...');?></a>
                </td>
                <td class=""><?php echo $value['Estimation']['remote_ip_address'];?></td>
                <td class=" cursor_hand " onClick="javaScript:showDetail(<?php echo $value['Estimation']['id']?>);"><?php echo $appHtml->html((mb_strlen($value['Estimation']['content'])>30)?mb_substr($value['Estimation']['content'],0,30).'...':$value['Estimation']['content']);?><label id="content<?php echo $value['Estimation']['id'];?>" style="display:none"><?php echo nl2br($appHtml->html($value['Estimation']['content']));?></label></td>
                <td class=""><?php echo substr($value['Estimation']['create_datetime'], 0, 16);?></td>
                <td class=""><?php echo $msts[ESTIMATION_STATUS][$value['Estimation']['status']]?></td>
                <td class=" action2">
            <?php if ($value['Estimation']['status'] == ESTIMATION_STATUS_WAIT_PASS):?>
                <a href="javaScript:void(0);" onClick="javaScript:confirmEstimation(<?php echo $value['Estimation']['id'];?>);">通过</a>
                <a href="javaScript:void(0);" onClick="javaScript:blockEstimation(<?php echo $value['Estimation']['id'];?>);">屏蔽</a>
                <a href="javaScript:void(0);" onClick="javaScript:deleteEstimation(<?php echo $value['Estimation']['id'];?>);">删除</a>
            <?php elseif ($value['Estimation']['status'] == ESTIMATION_STATUS_PASSED):?>
                <a href="javaScript:void(0);" onClick="javaScript:blockEstimation(<?php echo $value['Estimation']['id'];?>);">屏蔽</a>
                <a href="javaScript:void(0);" onClick="javaScript:deleteEstimation(<?php echo $value['Estimation']['id'];?>);">删除</a> 
            <?php elseif ($value['Estimation']['status'] == ESTIMATION_STATUS_BLOCKED):?>
                <a href="javaScript:void(0);" onClick="javaScript:unblockEstimation(<?php echo $value['Estimation']['id'];?>);">解除屏蔽</a>
                <a href="javaScript:void(0);" onClick="javaScript:deleteEstimation(<?php echo $value['Estimation']['id'];?>);">删除</a> 
            <?php endif;?>
                </td>
            </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="9"><?php __('info.recodeNotFound');?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
    <span class="btnDel" style="float:left;padding:13px;">将选中<label id="count">0</label>个对象： <input name="submit_button" type="submit" id="submit_button" value="屏蔽" class="btnWidth" onClick="javaScript:blockSelected();"> </span>
    <?php echo $this->element('common/pagination', array('model'=>'Estimation')); ?>
</div>
<?php echo $appForm->end();?>
<?php echo $this->element('estimation/content_detail');?>
<script type="text/javascript">
$(function(){
    $("#search").click(function(){
        $("#Estimation").submit();
    });
    $("#createDatetimeStart").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $("#createDatetimeEnd").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

});
function changeStatus(id) {
    $("input[name='data[Estimation][id]']").val(id);
    $("#Estimation").attr('action', '/admin/estimation/change_status');
    $("#Estimation").submit();
}
function confirmEstimation(id) {
    $("input[id='EstimationUpdateStatus']").val('<?php echo ESTIMATION_STATUS_PASSED;?>');
    changeStatus(id);
}

function blockEstimation(id) {
    $("input[id='EstimationUpdateStatus']").val('<?php echo ESTIMATION_STATUS_BLOCKED;?>');
    changeStatus(id);
}
function unblockEstimation(id) {
    $("input[id='EstimationUpdateStatus']").val('<?php echo ESTIMATION_STATUS_WAIT_PASS;?>');
    changeStatus(id);
}
function blockSelected() {
    $("#Estimation").attr('action', '/admin/estimation/change_selected_status');
    $("#Estimation").submit();
}
function deleteEstimation(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("input[name='data[Estimation][id]']").val(id);
        $("#Estimation").attr('action', '/admin/estimation/del');
        $("#Estimation").submit();
    }
}
function changeSort(nodeId) {
    var orgSort = $("input[name='data[Search]["+nodeId+"]']").val();
    if (orgSort == 'ASC') {
        $("input[name='data[Search]["+nodeId+"]']").val('DESC');
    } else {
        $("input[name='data[Search]["+nodeId+"]']").val('ASC');
    }
    $("input[name='data[Search][top_order]']").val(nodeId);
    $("#Estimation").attr('action', '/admin/estimation/search');
    $("#Estimation").submit();
}
function showDetail(id) {
    var height     = $(window).height();
    var width      = $(window).width();
    var scrollTop  = $(window).scrollTop();
    var scrollLeft = $(window).scrollLeft();
    var left = width/6+scrollLeft/2;
    $("#tContentDetail").css('left', left);
    $("#contentDetail").html($("#content"+id).html());
    $("#tContentDetail").show();
}
$("input[id^='Estimation.selected_id.']").each(function(){
    checkObj2(this,'Estimation.selected_id','count');
});
</script>