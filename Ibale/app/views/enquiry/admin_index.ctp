<link type="text/css" rel="stylesheet" href="/css/admin/box.css"/>
<script type="text/javascript" src="/js/admin/admin.js"></script>
<?php echo $appForm->create('Enquiry', array('id'=>'Enquiry', 'url'=>'/admin/enquiry/search'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('reply_content');?>
<?php echo $appForm->hidden('update_status');?>
<?php echo $appForm->hidden('Search.top_order');?>
<?php echo $appForm->hidden('Search.create_datetime_order');?>
<?php echo $appForm->hidden('Search.create_user_order');?>
<?php echo $appForm->hidden('Search.product_name_order');?>
<?php echo $appForm->hidden('Search.remote_ip_address_order');?>
<?php echo $appForm->hidden('referer');?>
<div class="mainWrapper">
    <h2>用户咨询</h2>
    <div class="search">
        咨询内容：
        <?php echo $appForm->text('Search.content', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 商品ID：
        <?php echo $appForm->text('Search.product_cd', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 用户名：
        <?php echo $appForm->text('Search.create_user', array('class'=>'input_100'));?>
        &nbsp;&nbsp; 咨询时间：
        <?php echo $appForm->text('Search.create_datetime_start', array('id'=>'createDatetimeStart','class'=>'input_80'));?>
        -
        <?php echo $appForm->text('Search.create_datetime_end', array('id'=>'createDatetimeEnd','class'=>'input_80'));?>
        状态：
        <?php echo $appForm->select('Search.status', $msts[ENQUIRY_STATUS], null, array('empty'=>__('label.selectALL', true)));?>
        &nbsp;&nbsp; 分类：
        <?php echo $appForm->select('Search.type', $msts[ENQUIRY_TYPE], null, array('empty'=>__('label.selectALL', true)));?>
        &nbsp;&nbsp; <input name="submit_button" type="button" id="search" value="查找" class="btnWidth">
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th class="w_10" width="14">
                <input type="checkbox" name="checkbox" id="Enquiry.selected_id" onClick="javaScript:checkAll(this, 'count');"/>
                </th>
                <th width="60">编号</th>
                <th width="120" id="create_user_order" class="cursor_hand" onClick="javaScript:changeSort('create_user_order');">用户名<?php echo ($this->data['Search']['create_user_order']=='ASC')?'▲':'▼'?></th>
                <th width="140" id="product_name_order" class="cursor_hand" onClick="javaScript:changeSort('product_name_order');">咨询商品<?php echo ($this->data['Search']['product_name_order']=='ASC')?'▲':'▼'?></th>
                <th width="110" id="remote_ip_address_order" class="cursor_hand" onClick="javaScript:changeSort('remote_ip_address_order');">IP地址<?php echo ($this->data['Search']['remote_ip_address_order']=='ASC')?'▲':'▼'?></th>
                <th>咨询内容</th>
                <th width="120" id="create_datetime_order" class="cursor_hand" onClick="javaScript:changeSort('create_datetime_order');">咨询时间<?php echo ($this->data['Search']['create_datetime_order']=='ASC')?'▲':'▼'?></th>
                <th width="60">状态</th>
                <th width="120">操作</th>
            </tr>
            <?php if (!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <?php $blockedClassName = '';?>
            <?php if ($value['Enquiry']['status'] == ENQUIRY_STATUS_BLOCKED):?>
                <?php $blockedClassName = 'f';?>
            <?php endif;?>
            <tr>
                <td class=""><?php echo $appForm->checkBox('Enquiry.selected_id.'.$value['Enquiry']['id'], array('id'=>'Enquiry.selected_id.'.$value['Enquiry']['id'], 'value'=>$value['Enquiry']['id'],'onClick'=>"javaScript:checkObj(this,'Enquiry.selected_id','count');"));?>
                </td>
                <td class=""><?php echo $value['Enquiry']['id'];?></td>
                <td class=""><?php echo $value['Enquiry']['create_user'];?></td>
                <td class=""><a target="_blank" href="/product/detail/product_cd:<?php echo $value['Product']['product_cd'];?>"><?php echo $appHtml->html(mb_substr($value['Product']['product_name'],0,9).'...');?></a>
                </td>
                <td class=""><?php echo $value['Enquiry']['remote_ip_address'];?></td>
                <td class=" cursor_hand <?php echo $blockedClassName;?>" onClick="javaScript:showDetail(<?php echo $value['Enquiry']['id']?>);"><?php echo $appHtml->html((mb_strlen($value['Enquiry']['content'])>30)?mb_substr($value['Enquiry']['content'],0,30).'...':$value['Enquiry']['content']);?><label id="content<?php echo $value['Enquiry']['id'];?>" style="display:none"><?php echo nl2br($appHtml->html($value['Enquiry']['content']));?></label></td>
                <td class=""><?php echo substr($value['Enquiry']['create_datetime'], 0, 16);?></td>
                <td class=""><?php echo $msts[ENQUIRY_STATUS][$value['Enquiry']['status']]?></td>
                <td class=" action2">
            <?php if ($value['Enquiry']['status'] == ENQUIRY_STATUS_WAIT_ANSWER):?>
                <a href="javaScript:void(0);" onClick="javaScript:showReply(<?php echo $value['Enquiry']['id'];?>);">回复</a> <a href="javaScript:void(0);" onClick="javaScript:blockEnquiry(<?php echo $value['Enquiry']['id'];?>);">屏蔽</a>
            <?php elseif ($value['Enquiry']['status'] == ENQUIRY_STATUS_ANSWERED):?>
                <a href="javaScript:void(0);" onClick="javaScript:editReply(<?php echo $value['Enquiry']['id'];?>);">修改</a> <a href="javaScript:void(0);" onClick="javaScript:blockEnquiry(<?php echo $value['Enquiry']['id'];?>);">屏蔽</a>
            <?php elseif ($value['Enquiry']['status'] == ENQUIRY_STATUS_BLOCKED):?>
                <a href="javaScript:void(0);" onClick="javaScript:unblockEnquiry(<?php echo $value['Enquiry']['id'];?>);">解除屏蔽</a>
            <?php endif;?>
                </td>
            </tr>
        <?php $replyStyle="display:none;"?>
        <?php if ($value['Enquiry']['status'] != ENQUIRY_STATUS_WAIT_ANSWER && !empty($value['Enquiry']['reply_content']) || $appSession->check('Message.replyConentErrMsg'.$value['Enquiry']['id'])):?>
            <?php $replyStyle="display:table-row;"?>
        <?php endif;?>
            <tr id="reply<?php echo $value['Enquiry']['id'];?>" style="<?php echo $replyStyle;?>">
                <td colspan="2">&nbsp;</td>
            <?php if ($value['Enquiry']['status'] != ENQUIRY_STATUS_WAIT_ANSWER):?>
                <td colspan="2"><?php echo $value['Enquiry']['update_user'];?><br/><?php echo substr($value['Enquiry']['update_datetime'], 0, 16);?></td>
            <?php else:?>
                <td colspan="2">&nbsp;</td>
            <?php endif;?>
                <td colspan="4">
                <?php $value['Enquiry']['reply_content'] = !empty($value['Enquiry']['reply_content'])?$value['Enquiry']['reply_content']:'';?>
                <?php $disabled="";?>
                <?php $btnStyle="";?>
            <?php if ($appSession->check('Message.replyConentErrMsg'.$value['Enquiry']['id'])):?>
                <?php $value['Enquiry']['reply_content'] = $this->data['Enquiry']['reply_content'];?>
                <?php $btnStyle="visibility:visible;"?>
            <?php elseif ($value['Enquiry']['status'] != ENQUIRY_STATUS_WAIT_ANSWER):?>
                <?php $disabled="disabled";?>
                <?php $btnStyle="visibility:hidden;"?>
            <?php endif;?>
                <?php echo $appForm->textarea("Enquiry.{$value['Enquiry']['id']}.reply_content", array('id'=>'enquiryReply'.$value['Enquiry']['id'], 'value'=>$value['Enquiry']['reply_content'],'style'=>'width:98%;height:60px;','disabled'=>$disabled));?>
                <?php if ( $appSession->check('Message.replyConentErrMsg'.$value['Enquiry']['id'])):?>
                    <?php echo $appSession->flash('replyConentErrMsg'.$value['Enquiry']['id']);?>
                <?php endif;?>
                </td>
                <td>
                <input name="submit_button2" type="button" id="commitReply<?php echo $value['Enquiry']['id'];?>" value="提交" class="btnWidth" onClick="javaScript:commitReply(<?php echo $value['Enquiry']['id'];?>);" style="<?php echo $btnStyle;?>"/>
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
        <?php echo $this->element('common/pagination', array('model'=>'Enquiry')); ?> 
</div>
<?php echo $appForm->end();?>
<?php echo $this->element('enquiry/content_detail');?>
<script type="text/javascript">
$(function(){
    $("#search").click(function(){
        $("#Enquiry").submit();
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
function showReply(id) {
    $("#reply"+id).show();
}
function editReply(id) {
    $("textarea[id='enquiryReply"+id+"']").removeAttr('disabled');
    $("#commitReply"+id).css('visibility', 'visible');
}
function blockEnquiry(id) {
    $("input[name='data[Enquiry][id]']").val(id);
    $("input[id='EnquiryUpdateStatus']").val('<?php echo ENQUIRY_STATUS_BLOCKED;?>');
    $("#Enquiry").attr('action', '/admin/enquiry/change_status');
    $("#Enquiry").submit();
}
function blockSelected() {
    $("#Enquiry").attr('action', '/admin/enquiry/change_selected_status');
    $("#Enquiry").submit();
}
function unblockEnquiry(id) {
    $("input[name='data[Enquiry][id]']").val(id);
    var status = '<?php echo ENQUIRY_STATUS_WAIT_ANSWER;?>';
    if ($("textarea[id='enquiryReply"+id+"']").val() != '') {
        status = '<?php echo ENQUIRY_STATUS_ANSWERED;?>';
    }
    $("input[id='EnquiryUpdateStatus']").val(status);
    $("#Enquiry").attr('action', '/admin/enquiry/change_status');
    $("#Enquiry").submit();
}

function commitReply(id) {
    $("input[name='data[Enquiry][id]']").val(id);
    $("input[name='data[Enquiry][reply_content]']").val($("textarea[id='enquiryReply"+id+"']").val());
    $("#Enquiry").attr('action', '/admin/enquiry/commit_reply');
    $("#Enquiry").submit();
}
function changeSort(nodeId) {
    var orgSort = $("input[name='data[Search]["+nodeId+"]']").val();
    if (orgSort == 'ASC') {
        $("input[name='data[Search]["+nodeId+"]']").val('DESC');
    } else {
        $("input[name='data[Search]["+nodeId+"]']").val('ASC');
    }
    $("input[name='data[Search][top_order]']").val(nodeId);
    $("#Enquiry").attr('action', '/admin/enquiry/search');
    $("#Enquiry").submit();
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
</script>