<div class="mainWrapper">
	<h2>管理员列表 <span class="f_12"><a href="/admin/admin/edit">[添加管理员]</a></span></h2>
	<?php echo $appForm->create('Admin', array('id'=>'Admin', 'url'=>'/admin/admin/edit'));?>
	<?php echo $appForm->hidden('id');?>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>开通时间</th>
            <th>最后登录时间</th>
            <th class="action">操作</th>
        </tr>
        <?php foreach($adminList as $key => $value):?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $appHtml->html($value['Admin']['login_id']);?></td>
            <td><?php echo substr($value['Admin']['create_datetime'], 0, 19);?></td>
            <td><?php echo substr($value['Admin']['last_login_datetime'], 0, 19);?></td>
            <td class="action"><a href="javaScript:void(0);" onclick="javaScript:editAdmin('<?php echo $value['Admin']['id'];?>');" >编辑</a><a href="/admin/operator_log/index/id:<?php echo $value['Admin']['id'];?>">操作日志</a><a href="javaScript:void(0);" onclick="javaScript:delAdmin('<?php echo $value['Admin']['id'];?>');" class="del">删除</a></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php echo $appForm->end();?>
    <?php echo $this->element('common/pagination', array('model'=>'Admin')); ?>
</div>
<script type="text/javascript">
function editAdmin(id) {
    $("#AdminId").val(id);
    $("#Admin").submit();
    return false;
}
function delAdmin(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#AdminId").val(id);
        $("#Admin").attr('action', '/admin/admin/delete');
        $("#Admin").submit();
    }
    return false;
}
function viewLog(id) {
    redirect('/admin/operator_log/id:'+id);
}
</script>
