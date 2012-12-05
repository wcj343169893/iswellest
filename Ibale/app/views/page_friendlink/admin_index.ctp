<script src="/js/admin/admin.js" type="text/javascript"></script>
<div class="mainWrapper">
    <h2>友情链接</h2>
    <?php echo $appForm->create('PageFriendlink', array('id'=>'PageFriendlink', 'url'=>'/admin/page_friendlink/add'));?>
    <?php echo $appForm->hidden('id');?>
    <?php echo $appForm->hidden('referer', array('value' => '/'.$_GET['url']));?>
    <div class="search">
        名称：
        <?php echo $appForm->text('name', array('class'=>'input'));?>
        &nbsp;&nbsp;&nbsp;&nbsp; 链接：
        <?php echo $appForm->text('url', array('class'=>'input'));?>
        &nbsp;&nbsp;&nbsp;&nbsp; 图片URL：
        <?php echo $appForm->text('img_url', array('class'=>'input'));?>
        &nbsp;&nbsp;&nbsp;&nbsp; 说明：
        <?php echo $appForm->text('comment', array('class'=>'input'));?>
        <input name="button2" type="submit" class="btnWidth" id="button2" value="添加" />
        <?php echo $appForm->error('PageFriendlink.name', '名称');?>
        <?php echo $appForm->error('PageFriendlink.url', '链接');?>
        <?php echo $appForm->error('PageFriendlink.img_url', '图片URL');?>
        <?php echo $appForm->error('PageFriendlink.comment', '说明');?>
        <?php echo $appForm->error('PageFriendlink.order_number', '排序');?>
        <?php if ($appSession->check('Message.nameIsExists')):?>
        <?php echo $appSession->flash('nameIsExists');?>
        <?php endif;?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th><input type="checkbox" name="checkbox" id="PageFriendlink.selectedId" onclick="javaScript:checkAll(this, 'count');" />
                </th>
                <th>编号</th>
                <th>名称</th>
                <th>链接</th>
                <th>图片URL</th>
                <th>说明</th>
                <th width="102">排序</th>
                <th class="action">操作</th>
            </tr>
<?php if (!empty($friendlinkList)):?>
        <?php foreach ($friendlinkList as $key =>$value):?>
            <?php $value = $value['PageFriendlink'];?>
            <tr>
                <td><?php echo $appForm->checkBox("PageFriendlink.selectedId.{$value['id']}", array('id'=>"PageFriendlink.selectedId.{$value['id']}",'value'=>true,'onClick'=>"javaScript:checkObj2(this,'PageFriendlink.selectedId','count');"));?>
                </td>
                <td><?php echo $value['id'];?>
                </td>
                <td class="bold"><?php echo $value['name'];?>
                </td>
                <td><?php echo $value['url'];?>
                </td>
                <td><?php echo $value['img_url'];?>
                </td>
                <td><?php echo $value['comment'];?>
                </td>
                <td><?php echo $appForm->labelText('order_number', array('id'=>$value['id'],'value'=>$value['order_number'],'modelName'=>'PageFriendlink','fieldName'=>'order_number','labelName'=>'顺序','style'=>'width:60px;'));?></td>
                <td class="action"><a href="javaScript:void(0);" class="del" onClick="javaScript:delFriendlink('<?php echo $value['id'];?>');">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
<?php else:?>
        <tr><td colspan="8"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>
    <?php echo $appForm->end();?>
    <span class="btnDel" style="float:left;padding:13px;">将选中<label id="count">0</label>个对象： <input type="submit" class="btnWidth" value="删除" id="delFriendlink" name="button"></span>
    <?php echo $this->element('common/pagination', array('model'=>'PageFriendlink')); ?>
</div>
<script type="text/javascript">
$(function(){
    $("#checkAll").click(function() {
        var checked = false;
        if($(this).attr('checked') == true) {
            checked = true;
        }

        $("input[id^='PageFriendlink.selectedId.']").each(function(){
            if ($(this).attr("type") == 'checkbox') {
                $(this).attr("checked", checked);
            }
        });
    });

    $("#delFriendlink").click(function(){
        var ret = hasChecked('PageFriendlink.selectedId');
        if (!ret) {
            alert('<?php __('info.pleaseSelectForDelete');?>');
            return false;
        }

        if (confirm('<?php __('info.confirmDelete');?>')) {
            $("#PageFriendlink").attr('action', '/admin/page_friendlink/delete_selected');
            $("#PageFriendlink").submit();
        }
        return false;
    });
});

function delFriendlink(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#PageFriendlinkId").val(id);
        $("#PageFriendlink").attr('action', '/admin/page_friendlink/delete');
        $("#PageFriendlink").submit();
    }
    return false;
}
$("input[id^='PageFriendlink.selectedId.']").each(function(){
    checkObj2(this,'PageFriendlink.selectedId','count');
});
</script>
